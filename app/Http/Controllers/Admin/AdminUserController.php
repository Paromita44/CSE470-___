<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $r) {
        $q = User::query()->withCount('incidentReports');
        if ($r->filled('search')) {
            $q->where(fn($w) => $w->where('name', 'like', "%{$r->get('search')}%")->orWhere('email', 'like', "%{$r->get('search')}%"));
        }
        if ($r->filled('role')) {
            $q->where('role', $r->get('role'));
        }
        if ($r->filled('status')) {
            $q->where('is_active', $r->status === 'active');
        }
        $users = $q->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function toggleAdmin(User $user) {
        $user->update(['is_admin' => !$user->is_admin]);
        return back();
    }
}