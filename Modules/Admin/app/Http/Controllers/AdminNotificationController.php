<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Common\Notifications\Notification as EurekaNotification;

class AdminNotificationController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $studentCount = User::where('role', 'student')->count();
        $advocateCount = User::where('role', 'advocate')->count();

        return view('admin::notifications.send', compact('totalUsers', 'studentCount', 'advocateCount'));
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'message' => 'required|string',
            'target'  => 'required|in:all,students,advocates',
        ]);

        $query = User::query();

        if ($validated['target'] === 'students') {
            $query->where('role', 'student');
        } elseif ($validated['target'] === 'advocates') {
            $query->where('role', 'advocate');
        }

        $users = $query->get();

        $dbContent = [
            'title'     => $validated['title'],
            'text'      => $validated['message'],
            'entity'    => User::class,
            'entity_id' => auth()->id(),
        ];

        $count = 0;
        foreach ($users as $user) {
            try {
                $user->notify(new EurekaNotification($dbContent, $dbContent, ['database', 'push']));
                $count++;
            } catch (\Exception $e) {
                // Continue sending to remaining users if one fails
            }
        }

        session()->flash('success', "Notification sent to {$count} user(s) successfully.");
        return redirect()->back();
    }
}
