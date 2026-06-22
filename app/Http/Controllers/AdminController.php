<?php

namespace App\Http\Controllers;

use App\Models\appointments;
use App\Models\booths;
use App\Models\exhibitors;
use App\Models\leads;
use App\Models\User;
use Illuminate\Http\Request;

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

    public function searchExhibitors(Request $request)
    {
        $keyword = $request->search;

        $exhibitors = exhibitors::where('company_name', 'like', "%$keyword%")
            ->orWhere('representative_name', 'like', "%$keyword%")
            ->get();

        return view('admin.exhibitors.index', compact('exhibitors'));
    }

    public function searchLeads(Request $request)
    {
        $keyword = $request->search;

        $leads = leads::where('lead_name', 'like', "%$keyword%")
            ->orWhere('company_name', 'like', "%$keyword%")
            ->get();

        return view('admin.leads.index', compact('leads'));
    }

    public function searchBooths(Request $request)
    {
        $keyword = $request->search;

        $booths = booths::where('booth_number', 'like', "%$keyword%")
            ->orWhere('location', 'like', "%$keyword%")
            ->get();

        return view('admin.booths.index', compact('booths'));
    }

    public function filterAppointments(Request $request)
    {
        $status = $request->status;

        if ($status) {
            $appointments = appointments::where('status', $status)->get();
        } else {
            $appointments = appointments::all();
        }

        return view('admin.appointments.index', compact('appointments'));
    }
}
