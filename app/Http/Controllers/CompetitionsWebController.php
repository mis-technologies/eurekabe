<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Student\Http\Controllers\Api\StudentCompetitionController;

/**
 * Web landing page Paystack redirects to after a competition entry payment
 * initiated via the emailed link (iOS entry path — see
 * StudentCompetitionController::requestEntryPaymentEmail()). Reuses
 * confirmPayment() directly rather than duplicating fulfillment logic; that
 * method identifies the user/competition from Paystack's own verified
 * metadata, so no authentication is needed here.
 */
class CompetitionsWebController extends Controller
{
    public function callback(Request $request, StudentCompetitionController $competitions)
    {
        $request->merge(['reference' => $request->query('reference')]);

        $response = $competitions->confirmPayment($request);
        $data     = json_decode($response->getContent(), true);
        $success  = ($data['status'] ?? null) === 'success';

        return view('pages.competition-entry-result', [
            'success' => $success,
            'message' => $data['message'] ?? null,
        ]);
    }
}
