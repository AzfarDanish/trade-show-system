@extends('layouts.app')
@section('title', 'Create Appointment')

@section('content')

    <div class="page-header">
        <h1>Create Appointment</h1>
    </div>

    <div class="form-card">
        <h2>Appointment Details</h2>

        <form method="POST" action="/exhibitor/appointments/store">
            @csrf

            <div class="form-group">
                <label>Client Name</label>
                <input type="text" name="client_name" placeholder="Full name">
            </div>

            <div class="form-group">
                <label>Date</label>
                <input type="date" name="appointment_date">
            </div>

            <div class="form-group">
                <label>Time</label>
                <input type="time" name="appointment_time">
            </div>

            <div class="form-group">
                <label>Purpose</label>
                <textarea name="purpose" placeholder="Brief description..."></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn"><span class="material-symbols-outlined">save</span> Save Appointment</button>
                <a href="/exhibitor/appointments" class="btn btn-outline"><span class="material-symbols-outlined">close</span> Cancel</a>
            </div>
        </form>
    </div>

@endsection
