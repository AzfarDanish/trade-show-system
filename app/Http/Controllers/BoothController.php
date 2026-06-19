<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\booths;
use App\Models\exhibitors;
use Illuminate\Support\Facades\Auth;

class BoothController extends Controller
{
    public function create()
    {
        $exhibitors = exhibitors::all();

        return view('admin.booths.create', compact('exhibitors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'exhibitor_id' => 'required',
            'booth_number' => 'required|unique:booths',
            'location' => 'required'
        ]);

        booths::create([
            'exhibitor_id' => $request->exhibitor_id,
            'booth_number' => $request->booth_number,
            'location' => $request->location
        ]);

        return redirect('/admin/booths')->with('success', 'Booth assigned successfully.');
    }

    public function show()
    {
        $booth = Auth::user()->exhibitor->booth;

        return view('exhibitor.booth', compact('booth'));
    }
}
