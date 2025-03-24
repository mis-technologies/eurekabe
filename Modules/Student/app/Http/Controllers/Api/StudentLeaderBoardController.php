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
        $weekNumber = Carbon::now()->weekOfYear;
        $year = Carbon::now()->year;


        $leaderboard = StudentLeaderBoard::with('user')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->selectRaw('user_id, SUM(points) as total_points')
            ->groupBy('user_id')
            ->orderByDesc('total_points')
            ->take(10)
            ->get();

        return response()->json([
            'success' => true,
            'leaderboard' => $leaderboard,
            'week_number' => $weekNumber,
            'year' => $year,
            'week_start' => $startOfWeek->toDateString(),
            'week_end' => $endOfWeek->toDateString(),
            'description' => "Week $weekNumber, $year leaderboard as of " . Carbon::now()->toFormattedDateString(),
            
        ]);
    }

    /**
     * Get the leaderboard for the current month.
     */
    public function monthlyLeaderboard()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $monthName = Carbon::now()->format('F');
        $year = Carbon::now()->year;

        $leaderboard = StudentLeaderBoard::with('user')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->selectRaw('user_id, SUM(points) as total_points')
            ->groupBy('user_id')
            ->orderByDesc('total_points')
            ->take(10)
            ->get();

            return response()->json([
                'success' => true,
                'leaderboard' => $leaderboard,
                'month' => $monthName,
                'year' => $year,
                'month_start' => $startOfMonth->toDateString(),
                'month_end' => $endOfMonth->toDateString(),
                'description' => "$monthName, $year leaderboard as of " . Carbon::now()->toFormattedDateString(),
            ]);
    }

    /**
     * Get the leaderboard for the current year.
     */
    public function yearlyLeaderboard()
    {
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();
        $year = Carbon::now()->year;

        $leaderboard = StudentLeaderBoard::with('user')
            ->whereBetween('created_at', [$startOfYear, $endOfYear])
            ->selectRaw('user_id, SUM(points) as total_points')
            ->groupBy('user_id')
            ->orderByDesc('total_points')
            ->take(10)
            ->get();


            
        return response()->json([
            'success' => true,
            'leaderboard' => $leaderboard,
            'year' => $year,
            'year_start' => $startOfYear->toDateString(),
            'year_end' => $endOfYear->toDateString(),
            'description' => "Year $year leaderboard as of " . Carbon::now()->toFormattedDateString(),

        ]);
    }
}
