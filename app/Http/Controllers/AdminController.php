<?php

namespace App\Http\Controllers;

use App\Models\appointments;
use App\Models\booths;
use App\Models\exhibitors;
use App\Models\leads;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalExhibitors = exhibitors::count();
        $totalBooths = booths::count();
        $totalLeads = leads::count();
        $totalAppointments = appointments::count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalExhibitors',
            'totalBooths',
            'totalLeads',
            'totalAppointments'
        ));
    }

    public function exhibitors()
    {
        $exhibitors = exhibitors::with('user')->get();

        return view('admin.exhibitors.index', compact('exhibitors'));
    }

    public function leads()
    {
        $leads = leads::with('exhibitor')->get();

        return view('admin.leads.index', compact('leads'));
    }

    public function appointments()
    {
        $appointments = appointments::with('exhibitor')->get();

        return view('admin.appointments.index', compact('appointments'));
    }

    public function booths()
    {
        $booths = booths::with('exhibitor')->get();

        return view('admin.booths.index', compact('booths'));
    }
}
