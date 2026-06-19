@extends('layouts.app')
@section('content')
    <h1>Edit Appointment</h1>

    <form method="POST" action="/exhibitor/appointments/update/{{ $appointment->appointment_id }}">
        @csrf
        @method('PUT')

        <input type="text" name="client_name" value="{{ $appointment->client_name }}">

        <input type="date" name="appointment_date" value="{{ $appointment->appointment_date }}">

        <input type="time" name="appointment_time" value="{{ $appointment->appointment_time }}">

        <textarea name="purpose">{{ $appointment->purpose }}</textarea>

        <select name="status">
            <option value="Pending">Pending</option>
            <option value="Confirmed">Confirmed</option>
            <option value="Completed">Completed</option>
            <option value="Cancelled">Cancelled</option>
        </select>

        <button type="submit">Update Appointment</button>
    </form>
@endsection