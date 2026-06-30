@extends('layouts.app')
@section('title', 'Edit Appointment')

@section('content')

    <div class="page-header">
        <h1>Edit Appointment</h1>
    </div>

    <div class="form-card">
        <h2>Appointment Details</h2>

        <form method="POST" action="/exhibitor/appointments/update/{{ $appointment->appointment_id }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Client Name</label>
                <input type="text" name="client_name" value="{{ $appointment->client_name }}">
            </div>

            <div class="form-group">
                <label>Date</label>
                <input type="date" name="appointment_date" value="{{ $appointment->appointment_date }}">
            </div>

            <div class="form-group">
                <label>Time</label>
                <input type="time" name="appointment_time" value="{{ $appointment->appointment_time }}">
            </div>

            <div class="form-group">
                <label>Purpose</label>
                <textarea name="purpose">{{ $appointment->purpose }}</textarea>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status">
                    <option value="Confirmed" {{ $appointment->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="Completed" {{ $appointment->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="Cancelled" {{ $appointment->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn">Update Appointment</button>
                <a href="/exhibitor/appointments" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>

@endsection
