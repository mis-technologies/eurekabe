<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Common\Models\School;
use Modules\Common\Models\UserCreditAccount;
use Modules\Student\Models\StudentExam;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::latest();

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('firstname', 'like', "%{$search}%")
                  ->orWhere('lastname', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(20)->withQueryString();

        return view('admin::users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::with(['school', 'schools'])->findOrFail($id);
        $creditAccount = UserCreditAccount::with('plan')->where('user_id', $id)->first();
        $recentExams = StudentExam::with('exam')
            ->where('user_id', $id)
            ->latest()
            ->limit(10)
            ->get();

        return view('admin::users.show', compact('user', 'creditAccount', 'recentExams'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'role'      => 'nullable|string|in:student,advocate,admin',
            'status'    => 'nullable|integer|in:0,1',
            'school_id' => 'nullable|exists:schools,id',
        ]);

        $user->update($validated);

        session()->flash('success', 'User updated successfully.');
        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            session()->flash('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Unable to delete user: ' . $e->getMessage());
        }

        return redirect()->route('admin.users.index');
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => $user->status ? 0 : 1]);

        session()->flash('success', 'User status updated.');
        return redirect()->back();
    }
}
