@extends('layouts.app')
@section('title', 'Add Lead')

@section('content')

    <div class="page-header">
        <h1>Add Lead</h1>
    </div>

    <div class="form-card">
        <h2>Lead Details</h2>

        <form method="POST" action="/exhibitor/leads/store">
            @csrf

            <div class="form-group">
                <label>Lead Name</label>
                <input type="text" name="lead_name" placeholder="Full name">
            </div>

            <div class="form-group">
                <label>Company Name</label>
                <input type="text" name="company_name" placeholder="Company">
            </div>

            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone" placeholder="e.g. +1 234 567 890">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="email@company.com">
            </div>

            <div class="form-group">
                <label>Notes</label>
                <textarea name="notes" placeholder="Any additional notes..."></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn">Save Lead</button>
                <a href="/exhibitor/leads" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>

@endsection
