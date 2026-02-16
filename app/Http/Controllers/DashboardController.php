<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalAdmin = User::where('role', 'admin')->count();
        $totalStaff = User::where('role', 'staff')->count();
        $totalPending = User::whereNull('email_verified_at')->count();

        return view('dashboard', compact(
            'totalUsers',
            'totalAdmin',
            'totalStaff',
            'totalPending'
        ));
    }

}
