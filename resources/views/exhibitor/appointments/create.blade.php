@extends('layouts.app')
@section('content')
    <h1>Create Appointment</h1>

    <form method="POST" action="/exhibitor/appointments/store">
        @csrf

        <input type="text" name="client_name" placeholder="Client Name">

        <input type="date" name="appointment_date">

        <input type="time" name="appointment_time">

        <textarea name="purpose" placeholder="Purpose"></textarea>

        <button type="submit">Save Appointment</button>
    </form>
@endsection