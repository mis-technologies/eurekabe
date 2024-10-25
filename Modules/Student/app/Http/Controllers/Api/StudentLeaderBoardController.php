<?php

namespace Modules\Student\Http\Controllers\Api;

use Carbon\Carbon;
use Modules\Student\Models\StudentLeaderBoard;
use App\Http\Controllers\Controller;

class StudentLeaderBoardController extends Controller
{
    /**
     * Get the leaderboard for the current week.
     */
    public function weeklyLeaderboard()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $leaderboard = StudentLeaderBoard::with('user')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->selectRaw('user_id, SUM(points) as total_points')
            ->groupBy('user_id')
            ->orderByDesc('total_points')
            ->take(10)
            ->get();

        return response()->json([
            'success' => true,
            'leaderboard' => $leaderboard
        ]);
    }

    /**
     * Get the leaderboard for the current month.
     */
    public function monthlyLeaderboard()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $leaderboard = StudentLeaderBoard::with('user')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->selectRaw('user_id, SUM(points) as total_points')
            ->groupBy('user_id')
            ->orderByDesc('total_points')
            ->take(10)
            ->get();

        return response()->json([
            'success' => true,
            'leaderboard' => $leaderboard
        ]);
    }

    /**
     * Get the leaderboard for the current year.
     */
    public function yearlyLeaderboard()
    {
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();

        $leaderboard = StudentLeaderBoard::with('user')
            ->whereBetween('created_at', [$startOfYear, $endOfYear])
            ->selectRaw('user_id, SUM(points) as total_points')
            ->groupBy('user_id')
            ->orderByDesc('total_points')
            ->take(10)
            ->get();


            
        return response()->json([
            'success' => true,
            'leaderboard' => $leaderboard
        ]);
    }
}
