<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\exhibitors;
use App\Models\shows;
use Illuminate\Support\Facades\Auth;

class ExhibitorController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'representative_name' => 'required',
            'phone_number' => 'required'
        ]);

        $activeShow = shows::activeShow();

        exhibitors::create([
            'user_id' => Auth::id(),
            'company_name' => $request->company_name,
            'representative_name' => $request->representative_name,
            'phone_number' => $request->phone_number,
            'status' => $activeShow ? 'active' : 'inactive',
        ]);

        return redirect('/exhibitor/dashboard')->with('success', 'Profile created successfully.');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $exhibitor = $user->exhibitor;
        $activeShow = shows::activeShow();

        if (!$exhibitor) {
            return redirect('/exhibitor/profile/create');
        }

        $totalLeads = $exhibitor->leads()->count();
        $totalAppointments = $exhibitor->appointments()->count();
        $appointmentsConfirmed = $exhibitor->appointments()->where('status', 'Confirmed')->count();
        $appointmentsCompleted = $exhibitor->appointments()->where('status', 'Completed')->count();
        $booth = $exhibitor->booth;

        $showEnded = is_null($activeShow);
        $showActive = !is_null($activeShow) && $exhibitor->status === 'active';
        $canJoin = !is_null($activeShow) && $exhibitor->status === 'inactive';

        return view('exhibitor.dashboard', compact(
            'user',
            'exhibitor',
            'totalLeads',
            'totalAppointments',
            'appointmentsConfirmed',
            'appointmentsCompleted',
            'booth',
            'showEnded',
            'showActive',
            'canJoin',
            'activeShow',
        ));
    }

    public function joinShow(Request $request)
    {
        $exhibitor = Auth::user()->exhibitor;
        $activeShow = shows::activeShow();

        if (!$activeShow) {
            return back()->with('error', 'No active show to join.');
        }

        if (!$exhibitor) {
            return redirect('/exhibitor/profile/create');
        }

        $exhibitor->joinShow();

        return redirect('/exhibitor/dashboard')->with('success', 'You have joined the show successfully.');
    }

    public function edit()
    {
        $exhibitor = Auth::user()->exhibitor;
        return view('exhibitor.edit-profile', compact('exhibitor'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'representative_name' => 'required',
            'phone_number' => 'required'
        ]);

        $exhibitor = Auth::user()->exhibitor;

        $exhibitor->update([
            'company_name' => $request->company_name,
            'representative_name' => $request->representative_name,
            'phone_number' => $request->phone_number
        ]);

        return redirect('/exhibitor/dashboard')->with('success', 'Profile updated successfully.');
    }
}
