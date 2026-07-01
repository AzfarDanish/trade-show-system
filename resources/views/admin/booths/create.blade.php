@extends('layouts.app')
@section('title', 'Create Booth')

@section('content')

    <!-- Page header -->
    <div class="page-header">
        <h1>Assign Booth</h1>
    </div>

    <!-- Booth assignment form -->
    <div class="form-card">
        <h2>Booth Details</h2>

        <form method="POST" action="/admin/booths/store">
            @csrf

            <div class="form-group">
                <label>Exhibitor</label>
                <select name="exhibitor_id">
                    <option value="">Select exhibitor...</option>
                    @foreach($exhibitors as $exhibitor)
                        <option value="{{ $exhibitor->exhibitor_id }}">
                            {{ $exhibitor->company_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Booth Number</label>
                <input type="text" name="booth_number" placeholder="e.g. A-101">
            </div>

            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location" placeholder="e.g. Hall A, Ground Floor">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn"><span class="material-symbols-outlined">assignment_add</span> Assign Booth</button>
                <a href="/admin/booths" class="btn btn-outline"><span class="material-symbols-outlined">close</span> Cancel</a>
            </div>
        </form>
    </div>

@endsection
