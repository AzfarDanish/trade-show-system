<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\booths;
use App\Models\exhibitors;
use App\Models\shows;
use Illuminate\Support\Facades\Auth;

class BoothController extends Controller
{
    public function create()
    {
        $activeShow = shows::activeShow();
        $exhibitors = exhibitors::active()->whereDoesntHave('booth')->get();

        return view('admin.booths.create', compact('exhibitors', 'activeShow'));
    }

    public function store(Request $request)
    {
        $activeShow = shows::activeShow();

        if (!$activeShow) {
            return back()->with('error', 'No active show. Cannot assign booth.');
        }

        $request->validate([
            'exhibitor_id' => 'required|exists:exhibitors,exhibitor_id|unique:booths,exhibitor_id',
            'booth_number' => 'required|unique:booths',
            'location' => 'required'
        ]);

        booths::create([
            'exhibitor_id' => $request->exhibitor_id,
            'booth_number' => $request->booth_number,
            'location' => $request->location,
            'show_id' => $activeShow->show_id,
        ]);

        return redirect('/admin/booths')->with('success', 'Booth assigned successfully.');
    }

    public function edit($id)
    {
        $booth = booths::findOrFail($id);
        $exhibitors = exhibitors::active()
            ->whereDoesntHave('booth')
            ->orWhere('exhibitor_id', $booth->exhibitor_id)
            ->get();

        return view('admin.booths.edit', compact('booth', 'exhibitors'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'exhibitor_id' => 'required|exists:exhibitors,exhibitor_id|unique:booths,exhibitor_id,' . $id . ',booth_id',
            'booth_number' => 'required|unique:booths,booth_number,' . $id . ',booth_id',
            'location' => 'required'
        ]);

        $booth = booths::findOrFail($id);
        $booth->update([
            'exhibitor_id' => $request->exhibitor_id,
            'booth_number' => $request->booth_number,
            'location' => $request->location
        ]);

        return redirect('/admin/booths')->with('success', 'Booth updated successfully.');
    }

    public function destroy($id)
    {
        $booth = booths::findOrFail($id);
        $booth->delete();

        return redirect('/admin/booths')->with('success', 'Booth deleted successfully.');
    }

    public function show()
    {
        $booth = Auth::user()->exhibitor->booth;

        return view('exhibitor.booth', compact('booth'));
    }
}
