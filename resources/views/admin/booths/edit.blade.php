@extends('layouts.app')
@section('title', 'Edit Booth')

@section('content')

    <div class="page-header">
        <h1>Edit Booth</h1>
    </div>

    <div class="form-card">
        <h2>Booth Details</h2>

        <form method="POST" action="/admin/booths/update/{{ $booth->booth_id }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Exhibitor</label>
                <select name="exhibitor_id">
                    <option value="">Select exhibitor...</option>
                    @foreach($exhibitors as $exhibitor)
                        <option value="{{ $exhibitor->exhibitor_id }}" {{ $booth->exhibitor_id == $exhibitor->exhibitor_id ? 'selected' : '' }}>
                            {{ $exhibitor->company_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Booth Number</label>
                <input type="text" name="booth_number" value="{{ $booth->booth_number }}">
            </div>

            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location" value="{{ $booth->location }}">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn">Update Booth</button>
                <a href="/admin/booths" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>

@endsection
