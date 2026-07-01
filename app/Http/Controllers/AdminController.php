<?php

namespace App\Http\Controllers;

use App\Models\appointments;
use App\Models\booths;
use App\Models\exhibitors;
use App\Models\leads;
use App\Models\shows;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// Handles admin dashboard and all administrative management.
class AdminController extends Controller
{
    // Show the admin dashboard with aggregate counts for all resources.
    public function dashboard()
    {
        $activeShow = shows::activeShow();
        $totalUsers = users::where('role', 'exhibitor')->count();
        $totalExhibitors = exhibitors::count();
        $totalActiveExhibitors = exhibitors::active()->count();
        $totalBooths = booths::count();
        $unassignedBooths = exhibitors::active()->whereDoesntHave('booth')->count();
        $totalLeads = leads::count();
        $totalAppointments = appointments::count();

        return view('admin.dashboard', compact(
            'activeShow',
            'totalUsers',
            'totalExhibitors',
            'totalActiveExhibitors',
            'totalBooths',
            'unassignedBooths',
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

    // List booths with optional filter — 'unassigned' shows exhibitors without a booth.
    public function booths(Request $request)
    {
        $filter = $request->filter ?? 'assigned';

        if ($filter === 'unassigned') {
            $unassignedExhibitors = exhibitors::active()->whereDoesntHave('booth')->with('user')->get();
            return view('admin.booths.index', compact('filter', 'unassignedExhibitors'));
        }

        $booths = booths::with('exhibitor')->get();

        return view('admin.booths.index', compact('booths', 'filter'));
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
        $filter = 'assigned';

        $booths = booths::where('booth_number', 'like', "%$keyword%")
            ->orWhere('location', 'like', "%$keyword%")
            ->get();

        return view('admin.booths.index', compact('booths', 'filter'));
    }

    // Filter appointments by status, or return all if no status is specified.
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

    // End the active show: delete its booths, deactivate exhibitors, close the show.
    public function endShow(Request $request)
    {
        $show = shows::activeShow();

        if (!$show) {
            return back()->with('error', 'No active show to end.');
        }

        booths::where('show_id', $show->show_id)->delete();

        exhibitors::active()->update(['status' => 'inactive']);

        $show->end();

        return redirect('/admin/dashboard')->with('success', 'Show ended successfully.');
    }

    public function createShow()
    {
        return view('admin.shows.create');
    }

    // Store a new show with optional poster image upload.
    public function storeShow(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'poster' => 'nullable|image|max:2048',
        ]);

        $posterPath = $request->hasFile('poster')
            ? $request->file('poster')->store('posters', 'public')
            : null;

        shows::create([
            'name' => $request->name,
            'status' => 'active',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'poster' => $posterPath,
        ]);

        return redirect('/admin/dashboard')->with('success', 'New show created successfully.');
    }

    public function editShow($id)
    {
        $show = shows::findOrFail($id);

        return view('admin.shows.edit', compact('show'));
    }

    // Update show details. Deletes old poster and stores new one if uploaded.
    public function updateShow(Request $request, $id)
    {
        $show = shows::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'poster' => 'nullable|image|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ];

        if ($request->hasFile('poster')) {
            if ($show->poster) {
                Storage::disk('public')->delete($show->poster);
            }
            $data['poster'] = $request->file('poster')->store('posters', 'public');
        }

        $show->update($data);

        return redirect('/admin/dashboard')->with('success', 'Show details updated successfully.');
    }
}
