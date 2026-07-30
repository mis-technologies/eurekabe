# Competition Features Testing Guide

## Overview
This guide covers end-to-end testing for the new competition pricing, timing windows, and notification features.

---

## Pre-Test Setup

### Backend Setup
```bash
cd /Users/aaron/dev/www/eurekabe

# Run migrations
php artisan migrate

# Optional: Seed test data
php artisan tinker
> $school = \Modules\Common\Models\School::first() ?? \Modules\Common\Models\School::create(['name' => 'Test School']);
> $exam = \Modules\Common\Models\Exam::first() ?? \Modules\Common\Models\Exam::create(['title' => 'Test Exam']);
```

### Mobile Setup
```bash
cd /Users/aaron/dev/www/eurekamo
npm install
npm start  # or: npx expo run:android
```

---

## Test Scenarios

### Scenario 1: Free Competition (End-to-End Join → Exam → Submit)

**Setup:** Create a free competition via admin
1. Admin → Competitions → New Competition
2. Fill form:
   - Name: "Free Quiz Challenge"
   - Entry Fee: `0`
   - Timezone: `Africa/Lagos`
   - Window Start Hour: `8` (8:00 AM)
   - Window End Hour: `18` (6:00 PM)
   - Status: `ongoing`
   - Visibility: `public`
   - Attach an exam
3. Save competition

**Test Flow:**
1. Mobile → Explore → See "Free Quiz Challenge"
   - ✅ Price badge should show "Free"
   - ✅ Window status should show 🟢 Open (if within 8:00–18:00 WAT)
2. Tap competition → CompetitionDetail
   - ✅ Meta pills show price "Free" + window status
   - ✅ Button says "Join Competition"
3. Tap "Join Competition"
   - ✅ No payment flow → joins directly
   - ✅ Notification: "You've joined competition"
4. Tap "Start Exam"
   - ✅ Questions load
   - ✅ Timer shown
5. Answer questions and tap "Submit"
   - ✅ Within window: ✅ Submission accepted
   - ✅ After window closes: ❌ Shows "Window has closed" error (403)

**Expected Results:**
- ✅ Free join without payment
- ✅ Exam starts only within window hours
- ✅ Late submissions blocked
- ✅ Results page shows score

---

### Scenario 2: Paid Competition (Payment Flow)

**Setup:** Create a paid competition
1. Admin → Competitions → New
2. Fill form:
   - Name: "Premium Math Competition"
   - Entry Fee: `5000` (₦5,000)
   - Timezone: `Africa/Lagos`
   - Window Start Hour: `9`
   - Window End Hour: `17`
   - Status: `ongoing`
   - Visibility: `public`
3. Save competition

**Test Flow:**
1. Mobile → Explore
   - ✅ Price badge shows "₦5000.00" with red highlight
2. Tap competition
   - ✅ Button says "Pay ₦5000.00 to Join"
3. Tap button → PaymentScreen
   - ✅ Paystack checkout opens in WebView
4. Use Paystack test card:
   - Card: `5555555555554444`
   - Exp: `05/25`
   - CVV: `123`
   - Amount: Confirm ₦5,000
5. Complete payment
   - ✅ Redirects back to CompetitionDetail
   - ✅ Alert: "Payment confirmed! You have joined."
6. Tap "Start Exam"
   - ✅ Exam starts (participant is paid)
7. Submit exam
   - ✅ Results show + leaderboard updates

**Expected Results:**
- ✅ Payment required before join
- ✅ Paystack integration works
- ✅ Participant marked as `isPaid=true`
- ✅ Exam only accessible after payment

---

### Scenario 3: School-Scoped Competition Visibility

**Setup:** Create school-scoped competition
1. Admin → Competitions → New
2. Fill:
   - Name: "Riverine High Quiz"
   - Visibility: `school`
   - Schools: Select "Riverine High School"
   - Price: `0`
   - Timezone: `Africa/Lagos`
   - Window: `10` to `20`
3. Save

**Test Flow (Student NOT in school):**
1. Mobile → Explore
   - ❌ Competition should NOT appear in list

**Test Flow (Student in Riverine High):**
1. Mobile → Explore
   - ✅ "Riverine High Quiz" appears
2. Tap it → can join

**Expected Results:**
- ✅ Only students in scoped schools see the competition
- ✅ Public competitions appear for all students
- ✅ Private competitions only visible to admins

---

### Scenario 4: Timing Window Enforcement

**Setup:** Competition with tight window (e.g., 14:00–15:00 WAT)
1. Admin → Create competition with `window_start_hour: 14`, `window_end_hour: 15`
2. Set status to `ongoing`

**Test 1: Outside Window (Before 14:00)**
1. Mobile → Join competition
   - ✅ Can join (participant created)
2. Tap "Start Exam"
   - ❌ Error: "Competition window is not open. Upcoming."
3. Button disabled with warning

**Test 2: During Window (14:00–14:59)**
1. Same participant from Test 1
2. Tap "Start Exam"
   - ✅ Exam loads
3. Answer and "Submit"
   - ✅ Submission accepted
   - ✅ Results shown

**Test 3: After Window (15:01+)**
1. Another participant joins but waits until 15:01
2. Tap "Start Exam"
   - ❌ Error: "Competition window is not open. Closed."
3. Tap "Submit" if already started (within 5 min)
   - ❌ Error: "Competition window has closed. Submissions are no longer accepted."

**Expected Results:**
- ✅ Join always allowed (if participant paid)
- ✅ Start/Submit blocked outside window
- ✅ Timezone respected (`window_start_hour` in competition's timezone)

---

### Scenario 5: Admin Broadcast Notifications

**Setup:** Competition with 3 participants
1. Admin → Competition → Show page
2. Scroll to "Send Broadcast Message"

**Test 1: Broadcast to All Participants**
1. Fill form:
   - Title: "Last Hour Reminder"
   - Message: "The competition ends in 1 hour. Finish your submission!"
   - Segment: "All Participants"
2. Tap "Send Message"
   - ✅ Success: "Notification broadcast to 3 recipients"
3. Mobile → Notifications
   - ✅ All 3 participants see the notification

**Test 2: Broadcast to Schools**
1. Same form, Segment: "Students in Competition Schools"
   - ✅ Sends to ALL students in those schools (not just participants)

**Test 3: Broadcast to Eligible**
1. Segment: "All Eligible Students"
   - ✅ Public: sends to all students
   - ✅ School-scoped: sends to students in scoped schools only

**Expected Results:**
- ✅ Notifications delivered to correct recipients
- ✅ Notifications appear in mobile Notifications screen
- ✅ Admin can send custom messages mid-competition

---

### Scenario 6: Lifecycle Notifications (Future Enhancement)

These require scheduled jobs. When implemented:
- ✅ `created` → All eligible students notified
- ✅ `opened` → Participants notified at `window_start_hour`
- ✅ `closing_soon` → 15 min before `window_end_hour`
- ✅ `closed` → Participants notified at `window_end_hour`
- ✅ `results_ready` → Winner + all participants notified

---

## Edge Cases

### Edge Case 1: Window Spanning Midnight
**Setup:** `window_start_hour: 22`, `window_end_hour: 2` (10 PM to 2 AM)
- ✅ Should handle wraparound (22:00–23:59, then 00:00–02:00)
- Code: `if ($startHour < $endHour)` check in `Competition::isWithinWindow()`

### Edge Case 2: Timezone Daylight Saving
- Setup with timezone that observes DST (e.g., `Europe/London`)
- Laravel's `now()->setTimezone($tz)` handles DST automatically
- ✅ Window times adjust with DST

### Edge Case 3: Payment Failure
1. Start Paystack flow but cancel checkout
   - ✅ Returns to CompetitionDetail
   - ✅ Button still shows "Pay ₦X to Join"
2. Try payment again
   - ✅ Works (no duplicate participant)

### Edge Case 4: Concurrent Submissions
- Two tabs/devices submit near deadline (58 sec vs 59 sec in window)
- ✅ Both should pass if within window (race condition acceptable)
- Backend checks: `$competition->isWithinWindow()` before accepting

---

## Manual Checklist

### Backend Validations
- [ ] Pricing field stored and retrieved correctly
- [ ] Timezone field stored (not just start/end hours)
- [ ] `window_start_hour` and `window_end_hour` are 0–23 and validated
- [ ] `isWithinWindow()` method works for various timezones
- [ ] Free competitions skip `initiatePayment()`
- [ ] Paid competitions require payment before participant creation
- [ ] `startExam()` checks `isWithinWindow()` → 403 if closed
- [ ] `submitCompetitionExam()` checks `isWithinWindow()` → 403 if closed

### Mobile UI Validations
- [ ] CompetitionsListScreen shows price badges + window status
- [ ] CompetitionDetail shows full timing window + timezone
- [ ] "Pay ₦X to Join" button appears for paid competitions
- [ ] PaymentScreen opens Paystack link without errors
- [ ] Notification on payment success
- [ ] "Window closed" warning when outside hours
- [ ] Exam button disabled if window closed

### Admin Panel Validations
- [ ] Pricing/window fields appear in create/edit forms
- [ ] Broadcast form sends notifications to correct segment
- [ ] Competition index shows price badge column
- [ ] Admin can edit pricing/window on existing competitions

---

## Performance Considerations

- **Window checking:** `isWithinWindow()` is called on every exam start/submit → lightweight check (no DB)
- **Notification bulk send:** Chunked into 100 per iteration to avoid memory issues
- **Payment verification:** Called on app resume → minimal overhead (one API call)

---

## Debugging

### Common Issues

**Issue: "Competition window is not open" even though current time is within window**
- [ ] Check timezone setting on competition
- [ ] Verify server time matches user time (NTP sync)
- [ ] Check user's device timezone vs competition timezone
- **Fix:** Admin can adjust timezone or window hours

**Issue: Payment doesn't confirm**
- [ ] Check Paystack API key in `.env`
- [ ] Verify webhook signature secret is correct
- [ ] Check Paystack test mode vs live mode
- **Fix:** Review `PaystackService::verify()` response

**Issue: Broadcast notifications don't arrive**
- [ ] Check push token registration
- [ ] Verify notification permission granted on device
- [ ] Check recipient is in correct segment
- **Fix:** Test via Notifications screen (database channel is always available)

---

## Sign-Off Checklist

- [ ] Free competition join + exam + submit works
- [ ] Paid competition payment flow works
- [ ] Payment confirmed → participant marked `isPaid`
- [ ] Exam start blocked outside window
- [ ] Submission blocked outside window
- [ ] Window status shown correctly in UI
- [ ] Admin can broadcast messages
- [ ] School-scoped competitions hidden from other students
- [ ] Timezone respected in window calculations
- [ ] No runtime errors in logs

**Status:** Ready for production when all checkboxes pass ✅
