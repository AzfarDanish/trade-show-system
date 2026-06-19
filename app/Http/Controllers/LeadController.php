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

        return redirect('/exhibitor/leads');
    }
}
