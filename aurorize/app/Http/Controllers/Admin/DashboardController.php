<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;

/**
 * DashboardController
 * @author Anand Parikh
 */
class DashboardController extends Controller
{
    /**
     * Dashboard
     *
     * @return void
     * @author Anand Parikh
     */
    public function dashboard()
    {
        $userCount = User::whereNotNull('password')->count();
        $enquiryCount = Contact::count();
        return view('admin.dashboard', compact('userCount', 'enquiryCount'));
    }
}
