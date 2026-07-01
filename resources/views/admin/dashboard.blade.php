@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="page-header">
        <div>
            <h1>Dashboard Overview</h1>
            <p class="subtitle">Welcome back, {{ Auth::user()->name ?? 'Admin' }}</p>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-value">{{ $totalUsers }}</div>
            <div class="stat-label">Total Users</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ $totalExhibitors }}</div>
            <div class="stat-label">Total Exhibitors</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ $totalBooths }}</div>
            <div class="stat-label">Total Booths</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ $totalLeads }}</div>
            <div class="stat-label">Total Leads</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ $totalAppointments }}</div>
            <div class="stat-label">Total Appointments</div>
        </div>
    </div>

@endsection
