@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

    <div class="welcome-banner">
        <h1>Exhibitor Dashboard</h1>
        <p>Welcome, {{ $user->name }}</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-value">{{ $totalLeads }}</div>
            <div class="stat-label">Total Leads</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ $totalAppointments }}</div>
            <div class="stat-label">Total Appointments</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ $appointmentsConfirmed }}</div>
            <div class="stat-label">Confirmed</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ $appointmentsCompleted }}</div>
            <div class="stat-label">Completed</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ $hasBooth }}</div>
            <div class="stat-label">Booth Status</div>
        </div>
    </div>

    <div class="profile-card">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;padding-bottom:12px;border-bottom:1px solid var(--neutral-100);">
            <h2 style="margin-bottom:0;padding-bottom:0;border-bottom:none;">Profile Information</h2>
            <a href="/exhibitor/profile/edit" class="btn btn-sm btn-outline">Edit Profile</a>
        </div>
        <dl class="detail-list">
            <dt>Company Name</dt>
            <dd>{{ $exhibitor->company_name ?? '—' }}</dd>
            <dt>Representative</dt>
            <dd>{{ $exhibitor->representative_name ?? '—' }}</dd>
            <dt>Phone Number</dt>
            <dd>{{ $exhibitor->phone_number ?? '—' }}</dd>
        </dl>
    </div>

@endsection
