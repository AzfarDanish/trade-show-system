<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\exhibitors;
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

        exhibitors::create([
            'user_id' => Auth::id(),
            'company_name' => $request->company_name,
            'representative_name' => $request->representative_name,
            'phone_number' => $request->phone_number
        ]);

        return redirect('/exhibitor/dashboard');
    }
}
