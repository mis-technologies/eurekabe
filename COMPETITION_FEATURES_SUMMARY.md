# Competition Features Implementation Summary

## Project Overview
Complete implementation of visibility rules, pricing (free/paid), fixed-hour timing windows, and lifecycle notifications for competitions. Spans 4 weeks: schema design, backend API, mobile UI, and admin panel.

---

## 1. VISIBILITY & ACCESS CONTROL

### Feature: Public vs. School-Scoped Competitions
- **Public:** All students see and can join
- **School-Scoped:** Only students in those schools see/join
- **Private:** Likely admin-only (not yet fully implemented)

### Implementation
**Backend:**
- `Competition::visibleTo($user)` scope in model
- `StudentCompetitionController::index()` filters by visibility + school membership
- `StudentCompetitionController::show()` returns `can_join` flag

**Mobile:**
- CompetitionsListScreen automatically respects visibility (handled by API response)
- Students from different schools never see each other's school-scoped competitions

### API Endpoints
```
GET /api/v1/student/competitions?search=...&status=...&type=...
  Returns only visible competitions for authenticated user

GET /api/v1/student/competitions/{id}
  Returns competition details + my_status + can_join
```

---

## 2. PRICING (Free & Paid)

### Feature: Entry Fees
- **Free Competitions:** `price = 0` → instant join
- **Paid Competitions:** `price > 0` → must pay via Paystack before joining

### Schema
```sql
competitions.price (decimal 10,2) -- Entry fee in NGN
competition_participants.isPaid (boolean)
competition_participants.paid_at (timestamp)
competition_participants.payment_method (string) -- 'paystack' or 'free'
competition_participants.paystack_reference (string)
```

### Payment Flow

**Free Competition:**
1. Student taps "Join Competition"
2. Backend creates participant with `isPaid=true`, `payment_method='free'`
3. Notification sent
4. Student can immediately start exam

**Paid Competition:**
1. Student taps "Pay ₦X to Join"
2. Mobile calls `POST /api/v1/student/competitions/{id}/initiate-payment`
3. Backend returns Paystack auth URL + reference
4. Mobile opens PaymentScreen (WebView)
5. Student enters card details on Paystack
6. On success, Paystack redirects to `closepaystack` callback
7. Mobile calls `POST /api/v1/student/competitions/confirm-payment` with reference
8. Backend verifies payment via Paystack API
9. If successful: creates participant with `isPaid=true`, `payment_method='paystack'`
10. Notification sent
11. Student can now start exam

### API Endpoints
```
POST /api/v1/student/competitions/{id}/join
  → If free: creates participant directly
  → If paid: calls initiatePayment()

POST /api/v1/student/competitions/{id}/initiate-payment
  Returns: { authorization_url, reference, competition_id }

POST /api/v1/student/competitions/confirm-payment
  Input: { reference }
  Returns: { status, message, data: CompetitionParticipant }
```

### Admin Features
- Set price when creating/editing competition
- Price displayed in admin index + detail views
- Can't refund payments (outside scope)

---

## 3. TIMING WINDOWS (Fixed Hours)

### Feature: Hour-Based Entry Window
Competition available to take exams only during a fixed hour window (e.g., 2:00–3:00 PM).

### Schema
```sql
competitions.timezone (string) -- e.g., 'Africa/Lagos', 'UTC'
competitions.window_start_hour (tinyint 0-23) -- 2 = 2:00 AM
competitions.window_end_hour (tinyint 0-23) -- 15 = 3:00 PM

-- Example: 2:00 PM to 3:00 PM Lagos time
timezone: 'Africa/Lagos'
window_start_hour: 14
window_end_hour: 15
```

### How It Works
1. **Join:** No window check (always allowed if not completed)
2. **Start Exam:** Must be within window
   - `isWithinWindow()` checks: `now().setTimezone($tz)` hour between start/end
   - If outside: returns 403 "Competition window is not open"
3. **Submit Exam:** Must be within window
   - Late submissions rejected with 403 error
   - No grace period (strict enforcement)

### Wraparound Windows
If `window_start_hour > window_end_hour` (e.g., 22 to 2):
- Open: 22:00–23:59 and 00:00–02:00
- Code handles: `if ($startHour < $endHour)` check

### Code
```php
// Competition.php
public function isWithinWindow(): bool {
    $now = now()->setTimezone($this->timezone);
    $currentHour = (int) $now->format('H');
    $startHour = $this->window_start_hour;
    $endHour = $this->window_end_hour;

    if ($startHour < $endHour) {
        return $currentHour >= $startHour && $currentHour < $endHour;
    }
    return $currentHour >= $startHour || $currentHour < $endHour;
}

// StudentCompetitionController
public function startExam(...) {
    if (!$competition->isWithinWindow()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Competition window is not open. ' . ucfirst($competition->window_status) . '.',
        ], 403);
    }
    // ... start exam
}

public function submitCompetitionExam(...) {
    if (!$competition->isWithinWindow()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Competition window has closed. Submissions are no longer accepted.',
        ], 403);
    }
    // ... submit exam
}
```

### Mobile UI
**CompetitionDetailScreen:**
- Shows timing window section: "Available from 14:00 to 15:00 (Africa/Lagos)"
- Shows current window status: 🟢 Open / 🟡 Upcoming / 🔴 Closed
- Button disabled if window closed
- Warning message: "Competition window has closed"

**CompetitionsListScreen:**
- Window status badge on each card: 🟢 Open / 🟡 Upcoming / 🔴 Closed

### Admin UI
- Timezone dropdown (UTC, Africa/Lagos, Europe/London, etc.)
- Window start/end hour inputs (0–23)
- Displayed in competition show page

---

## 4. NOTIFICATIONS

### Feature: Competition Lifecycle Notifications
Notify students about competitions and key events.

### Notification Types

| Event | Trigger | Recipients | Message |
|-------|---------|------------|---------|
| **Created** | New competition created | All eligible students | "New Competition Available: [Name]" |
| **Opened** | Window start time | Participants only | "Window is now open. Start competing!" |
| **Closing Soon** | 15 min before end | Participants only | "Window closes in 15 minutes. Hurry up!" |
| **Closed** | Window end time | Participants only | "Window has closed. Check leaderboard." |
| **Results Ready** | All submit or deadline | All participants | Winner: "Congratulations! You won." Others: "[Name] won." |
| **Broadcast** | Admin sends custom msg | Specified segment | Admin-defined title + message |

### Implementation

**Backend Job:**
```php
// Modules/Common/app/Jobs/SendCompetitionNotifications.php
public function handle() {
    match ($this->eventType) {
        'created' => $this->notifyCreated(),
        'opened' => $this->notifyOpened(),
        'closing_soon' => $this->notifyClosingSoon(),
        'closed' => $this->notifyClosed(),
        'results_ready' => $this->notifyResultsReady(),
    };
}

// Dispatched via:
// dispatch(new SendCompetitionNotifications($competition, 'created'));
```

**Recipient Logic:**
- **Public competition:** All students
- **School-scoped:** Students in those schools
- **Participants only:** Only CompetitionParticipant rows

**Channels:** Database + Push notification (via Expo)

### Admin Broadcast
**Feature:** Admin can send custom notification to competition segments
- **All Participants:** Only students who joined
- **Schools:** All students in the school(s)
- **All Eligible:** Public or school-scoped students

**Endpoint:**
```
POST /api/v1/competitions/{id}/broadcast
Body: {
  title: string,
  message: string,
  segment: 'all_participants' | 'schools' | 'all_eligible'
}
Response: { status: 'success', message: 'Broadcast to X recipients' }
```

**UI:** Admin competition show page has "Send Broadcast Message" section
- Form: Title, Message, Segment radio buttons
- Click "Send Message" → notifications queued

### Mobile Notifications UI
- Notifications screen shows all received notifications
- Notifications have title, body, competition link
- Tapping notification navigates to competition detail

---

## 5. DATABASE SCHEMA

### Migrations Created
1. `2026_07_30_000001_add_pricing_and_window_to_competitions.php`
   - Adds: `price`, `timezone`, `window_start_hour`, `window_end_hour`

2. `2026_07_30_000002_add_payment_tracking_to_competition_participants.php`
   - Adds: `started_at`, `paid_at`, `payment_method`, `paystack_reference`

### Current Schema
```sql
-- competitions
id, user_id, school_id, winner_id
name, description, instruction
visibility, type, status
price (NEW), timezone (NEW)
window_start_hour (NEW), window_end_hour (NEW)
start_date, end_date
created_at, updated_at, deleted_at

-- competition_participants
id, competition_id, user_id
status, score, submitted_at
isPaid, payment_id
started_at (NEW), paid_at (NEW)
payment_method (NEW), paystack_reference (NEW)
created_at, updated_at

-- competition_schools (existing)
id, competition_id, school_id

-- competition_exams (existing)
id, competition_id, exam_id
duration, total_questions
```

---

## 6. API ENDPOINTS

### Student API (v1)
```
# Listing & Details
GET /student/competitions?search=...&status=...&type=...
  Returns visible competitions with pricing + window info

GET /student/competitions/{id}
  Returns competition detail + my_status + is_paid + can_join

# Join Flow
POST /student/competitions/{id}/join
  → If free: creates participant, returns participant
  → If paid: calls initiatePayment (redirects to payment)

POST /student/competitions/{id}/initiate-payment
  Returns: { authorization_url, reference, competition_id }

POST /student/competitions/confirm-payment
  Input: { reference }
  Returns: { status, message, data: CompetitionParticipant }

# Exam Flow
POST /student/competitions/{id}/exams/{examId}/start
  Enforces: window check, payment check
  Returns: { status, data: { id, questions } }

POST /student/competitions/{id}/submit
  Enforces: window check, exam check
  Input: { student_exam_id, submissions }
  Returns: { status, data: { result, points_earned, review } }

# Results
GET /student/competitions/{id}/submission
  Returns participant submission data

GET /student/competitions/{id}/leaderboard
  Returns ranked participants by score
```

### Admin API (v1)
```
POST /competitions/{id}/broadcast
  Input: { title, message, segment: 'all_participants'|'schools'|'all_eligible' }
  Returns: { status, message: 'Broadcast to X recipients' }
```

---

## 7. MOBILE SCREENS

### CompetitionsListScreen
- **Changes:**
  - Price badge on each card (₦X or "Free")
  - Window status indicator (🟢 Open / 🟡 Upcoming / 🔴 Closed)
  - Uses API response fields: `price_display`, `window_status`, `is_within_window`

### CompetitionDetailScreen
- **New Sections:**
  - Pricing info pill (if price > 0)
  - Competition Window section showing:
    - Hour window (14:00 to 15:00)
    - Timezone (Africa/Lagos)
    - Current status with icon
  - Payment button (for paid competitions)
  - Window closed warning (if outside window)

- **Button Logic:**
  - Free: "Join Competition"
  - Paid (not joined): "Pay ₦X to Join"
  - Paid (joined, not paid): "Complete Payment"
  - Joined: "Start Exam"
  - Outside window: Button disabled + warning

### PaymentScreen (NEW)
- WebView displaying Paystack checkout
- Loading spinner while page loads
- Detects payment completion (`closepaystack` callback)
- Calls `confirmPayment()` API
- On success: navigates back to CompetitionDetail
- On failure: shows error with retry option

### Navigation
- Added `PaymentScreen` to RootStackParamList
- Added route in AppNavigator

---

## 8. ADMIN PANEL CHANGES

### Competition Create/Edit Forms
- **New Fields:**
  - Entry Fee (₦) — numeric input, 0 for free
  - Timezone — dropdown (UTC, Africa/Lagos, Europe/London, etc.)
  - Window Start Hour — input 0–23
  - Window End Hour — input 0–23

### Competition Show Page
- **New Section:** "Send Broadcast Message"
  - Title input
  - Message textarea
  - Segment radio buttons (all_participants, schools, all_eligible)
  - Send button
  - Success message shows recipient count

- **Enhanced Participants Table:**
  - Shows `isPaid` status (Yes/No)
  - Shows `payment_method`

### Competition Index
- **New Column:** Price
  - Free: green badge "Free"
  - Paid: red badge "₦X"

---

## 9. PAYSTACK INTEGRATION

### PaystackService
```php
// Existing method
public function initiate(User $user, CreditPlan $plan, Payment $payment): array
  → Used for credit subscriptions

// NEW: Competition-specific method
public function initializeCompetitionTransaction($user, $competition, $amount, $email): array
  Returns: { authorization_url, reference }
  
public function verify(string $reference): array
  Returns: Verified transaction data { status, amount, reference, metadata }
```

### Test Card
- Card: `5555555555554444`
- Exp: `05/25`
- CVV: `123`
- OTP: Any 6 digits (in test mode)

### Env Config
```
PAYSTACK_PUBLIC_KEY=pk_test_...
PAYSTACK_SECRET_KEY=sk_test_...
PAYSTACK_WEBHOOK_SECRET=whs_...
```

---

## 10. FILES MODIFIED

### Backend (eurekabe/v2)
**Models:**
- `Modules/Common/app/Models/Competition.php` (+60 lines)
- `Modules/Common/app/Models/CompetitionParticipant.php` (+8 lines)

**Controllers:**
- `Modules/Student/app/Http/Controllers/Api/StudentCompetitionController.php` (+150 lines)
- `Modules/Admin/app/Http/Controllers/AdminCompetitionController.php` (+60 lines)

**Services:**
- `Modules/Common/app/Services/PaystackService.php` (+30 lines)

**Jobs:**
- `Modules/Common/app/Jobs/SendCompetitionNotifications.php` (+160 lines, new)

**Routes:**
- `Modules/Student/routes/api.php` (+1 route)
- `Modules/Admin/routes/api.php` (+1 route)

**Migrations:**
- `2026_07_30_000001_*.php` (new)
- `2026_07_30_000002_*.php` (new)

**Blade Templates:**
- `Modules/Admin/resources/views/competitions/create.blade.php` (+40 lines)
- `Modules/Admin/resources/views/competitions/edit.blade.php` (+40 lines)
- `Modules/Admin/resources/views/competitions/show.blade.php` (+60 lines)
- `Modules/Admin/resources/views/competitions/index.blade.php` (+12 lines)

### Mobile (eurekamo/main)
**Services:**
- `src/services/competitionService.ts` (+20 lines)

**Screens:**
- `src/screens/CompetitionsListScreen.tsx` (+40 lines, updated)
- `src/screens/CompetitionDetailScreen.tsx` (+120 lines, updated)
- `src/screens/PaymentScreen.tsx` (+70 lines, new)

**Navigation:**
- `src/types/navigation.ts` (+1 type)
- `src/navigation/AppNavigator.tsx` (+2 lines)

---

## 11. GIT COMMITS

### Backend Commits (eurekabe/v2)
1. **07e3ab4** — "feat: implement competition pricing, timing windows, and payment integration"
   - Schema migrations, models, payment endpoints, timing enforcement

2. **70f4dc7** — "feat: add competition lifecycle notifications and admin broadcast"
   - Notification job, admin broadcast endpoint, broadcast UI

3. **bc86331** — "feat: add admin panel UI for pricing, timing, and broadcast"
   - Admin forms, broadcast form, index enhancements

### Mobile Commits (eurekamo/main)
1. **11596a3** — "feat: implement mobile UI for competition pricing, timing, and payments"
   - Service updates, list/detail screens, payment screen, navigation

---

## 12. TESTING

See `COMPETITION_TESTING_GUIDE.md` for comprehensive test scenarios:
- Free competition E2E
- Paid competition payment flow
- School-scoped visibility
- Timing window enforcement
- Admin broadcast
- Edge cases (timezone DST, wraparound windows, concurrent submissions)

---

## 13. KNOWN LIMITATIONS & FUTURE WORK

### Current (Implemented)
- ✅ Free + Paid competitions
- ✅ Fixed-hour timing windows
- ✅ Payment via Paystack
- ✅ Admin broadcast messages
- ✅ Visibility rules (public + school-scoped)

### Not Yet Implemented
- ❌ Scheduled notifications (requires Laravel Queue + cron)
- ❌ Refund flow (outside scope)
- ❌ Private competitions (schema ready, UI not done)
- ❌ Multiple payment gateways (only Paystack)
- ❌ Price exceptions (VIP discounts, etc.)
- ❌ Affiliate/revenue tracking

### Recommended Next Steps
1. Set up Laravel scheduler + queue for lifecycle notifications
2. Add admin dashboard with competition analytics
3. Implement refund flow if needed
4. Add more payment gateways (Flutterwave, Stripe)
5. Create competition templates for quick setup

---

## 14. DEPLOYMENT CHECKLIST

- [ ] Run migrations: `php artisan migrate`
- [ ] Clear cache: `php artisan cache:clear`
- [ ] Set Paystack keys in `.env`
- [ ] Test payment in sandbox mode
- [ ] Configure push notification service (Expo)
- [ ] Set up scheduled jobs for lifecycle notifications
- [ ] Test all scenarios from COMPETITION_TESTING_GUIDE.md
- [ ] Brief admin on new broadcast feature
- [ ] Brief students on payment flow
- [ ] Monitor logs for errors

---

**Implementation Status:** ✅ Complete (Weeks 1–4)
**Testing Status:** Ready for QA
**Production Status:** Pending sign-off on test scenarios
