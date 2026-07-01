<?php

namespace App\Http\Controllers;

use App\Models\appointments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Manages appointments for the logged-in exhibitor.
class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Auth::user()->exhibitor->appointments;

        return view('exhibitor.appointments.index', compact('appointments'));
    }

    public function create()
    {
        return view('exhibitor.appointments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required',
            'appointment_date' => 'required',
            'appointment_time' => 'required',
            'purpose' => 'required'
        ]);

        appointments::create([
            'exhibitor_id' => Auth::user()->exhibitor->exhibitor_id,
            'client_name' => $request->client_name,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'purpose' => $request->purpose,
            'status' => 'Confirmed'
        ]);

        return redirect('/exhibitor/appointments')->with('success', 'Appointment created successfully.');
    }

    // Scoped to the logged-in exhibitor — returns 404 if not owned by them.
    public function edit($id)
    {
        $appointment = appointments::where('appointment_id', $id)
            ->where('exhibitor_id', Auth::user()->exhibitor->exhibitor_id)
            ->firstOrFail();

        return view('exhibitor.appointments.edit', compact('appointment'));
    }

    // Scoped to the logged-in exhibitor — returns 404 if not owned by them.
    public function update(Request $request, $id)
    {
        $request->validate([
            'client_name' => 'required',
            'appointment_date' => 'required',
            'appointment_time' => 'required',
            'purpose' => 'required',
            'status' => 'required'
        ]);

        $appointment = appointments::where('appointment_id', $id)
            ->where('exhibitor_id', Auth::user()->exhibitor->exhibitor_id)
            ->firstOrFail();

        $appointment->update([
            'client_name' => $request->client_name,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'purpose' => $request->purpose,
            'status' => $request->status
        ]);

        return redirect('/exhibitor/appointments')->with('success', 'Appointment updated successfully.');
    }

    // Scoped to the logged-in exhibitor — returns 404 if not owned by them.
    public function destroy($id)
    {
        $appointment = appointments::where('appointment_id', $id)
            ->where('exhibitor_id', Auth::user()->exhibitor->exhibitor_id)
            ->firstOrFail();

        $appointment->delete();

        return redirect('/exhibitor/appointments')->with('success', 'Appointment deleted successfully.');
    }
}
