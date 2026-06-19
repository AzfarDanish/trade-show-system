@extends('layouts.app')
@section('content')

    <h1>My Appointments</h1>

    <a href="/exhibitor/appointments/create">Add Appointment</a>

    @foreach($appointments as $appointment)

        <a href="/exhibitor/appointments/edit/{{ $appointment->appointment_id }}">
            Edit
        </a>

        <form method="POST" action="/exhibitor/appointments/delete/{{ $appointment->appointment_id }}" onsubmit="return confirmDelete()">
            @csrf
            @method('DELETE')

            <button type="submit">Delete</button>
        </form>

        <p>Client: {{ $appointment->client_name }}</p>
        <p>Date: {{ $appointment->appointment_date }}</p>
        <p>Time: {{ $appointment->appointment_time }}</p>
        <p>Purpose: {{ $appointment->purpose }}</p>
        <p>Status: {{ $appointment->status }}</p>
        <hr>
    @endforeach

@endsection
