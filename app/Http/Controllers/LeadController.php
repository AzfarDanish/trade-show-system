<?php

namespace App\Http\Controllers;

use App\Models\leads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Auth::user()->exhibitor->leads;

        return view('exhibitor.leads.index', compact('leads'));
    }

    public function create()
    {
        return view('exhibitor.leads.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'lead_name' => 'required',
            'company_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email'
        ]);

        leads::create([
            'exhibitor_id' => Auth::user()->exhibitor->exhibitor_id,
            'lead_name' => $request->lead_name,
            'company_name' => $request->company_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'notes' => $request->notes
        ]);

        return redirect('/exhibitor/leads')->with('success', 'Lead added successfully.');
    }
    
    public function edit($id)
    {
        $lead = leads::where('lead_id', $id)
            ->where('exhibitor_id', Auth::user()->exhibitor->exhibitor_id)
            ->firstOrFail();

        return view('exhibitor.leads.edit', compact('lead'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'lead_name' => 'required',
            'company_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email'
        ]);

        $lead = leads::where('lead_id', $id)
            ->where('exhibitor_id', Auth::user()->exhibitor->exhibitor_id)
            ->firstOrFail();

        $lead->update([
            'lead_name' => $request->lead_name,
            'company_name' => $request->company_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'notes' => $request->notes
        ]);

        return redirect('/exhibitor/leads')->with('success', 'Lead updated successfully.');
    }

    public function destroy($id)
    {
        $lead = leads::where('lead_id', $id)
            ->where('exhibitor_id', Auth::user()->exhibitor->exhibitor_id)
            ->firstOrFail();

        $lead->delete();

        return redirect('/exhibitor/leads')->with('success', 'Lead deleted successfully.');
    }

    public function search(Request $request)
    {
        $keyword = $request->search;

        $leads = leads::where('exhibitor_id', Auth::user()->exhibitor->exhibitor_id)
            ->where(function ($query) use ($keyword) {
                $query->where('lead_name', 'like', "%$keyword%")
                    ->orWhere('company_name', 'like', "%$keyword%");
            })
            ->get();

        return view('exhibitor.leads.index', compact('leads'));
    }
}
