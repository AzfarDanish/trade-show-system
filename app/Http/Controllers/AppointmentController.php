<?php

namespace App\Http\Controllers;

use App\Models\appointments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'status' => 'Pending'
        ]);

        return redirect('/exhibitor/appointments');
    }
}
