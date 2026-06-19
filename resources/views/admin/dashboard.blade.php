@extends('layouts.app')
@section('content')

    <h1>Admin Dashboard</h1>

    <h2>System Overview</h2>

    <p>Total Users: {{ $totalUsers }}</p>
    <p>Total Exhibitors: {{ $totalExhibitors }}</p>
    <p>Total Booths: {{ $totalBooths }}</p>
    <p>Total Leads: {{ $totalLeads }}</p>
    <p>Total Appointments: {{ $totalAppointments }}</p>

@endsection