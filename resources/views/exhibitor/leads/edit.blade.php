@extends('layouts.app')
@section('title', 'Edit Lead')

@section('content')

    <div class="page-header">
        <h1>Edit Lead</h1>
    </div>

    <div class="form-card">
        <h2>Lead Details</h2>

        <form method="POST" action="/exhibitor/leads/update/{{ $lead->lead_id }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Lead Name</label>
                <input type="text" name="lead_name" value="{{ $lead->lead_name }}">
            </div>

            <div class="form-group">
                <label>Company Name</label>
                <input type="text" name="company_name" value="{{ $lead->company_name }}">
            </div>

            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone" value="{{ $lead->phone }}">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ $lead->email }}">
            </div>

            <div class="form-group">
                <label>Notes</label>
                <textarea name="notes">{{ $lead->notes }}</textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn">Update Lead</button>
                <a href="/exhibitor/leads" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>

@endsection
