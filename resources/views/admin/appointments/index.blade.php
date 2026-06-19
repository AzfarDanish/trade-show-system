@extends('layouts.app')
@section('content')
    <h1>All Appointments</h1>

    <form method="GET" action="/admin/appointments/filter">
        <select name="status">
            <option value="Pending">Pending</option>
            <option value="Confirmed">Confirmed</option>
            <option value="Completed">Completed</option>
            <option value="Cancelled">Cancelled</option>
        </select>

        <button type="submit">Filter</button>
    </form>

    @foreach($appointments as $appointment)
        <p>Client: {{ $appointment->client_name }}</p>
        <p>Date: {{ $appointment->appointment_date }}</p>
        <p>Status: {{ $appointment->status }}</p>
        <hr>
    @endforeach
@endsection