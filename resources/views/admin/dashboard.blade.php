@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="page-header">
        <div>
            <h1>Dashboard Overview</h1>
            <p class="subtitle">Welcome back, {{ Auth::user()->name ?? 'Admin' }}</p>
        </div>
        <div style="display:flex;gap:12px;">
            @if($activeShow)
                <form method="POST" action="/admin/shows/end" onsubmit="return confirm('End the current show? This will remove all booth assignments and mark exhibitors as inactive. All exhibitor profiles, leads, and appointments will be preserved.')">
                    @csrf
                    <button type="submit" class="btn btn-danger"><span class="material-symbols-outlined">close</span> End Show</button>
                </form>
            @else
                <a href="/admin/shows/create" class="btn"><span class="material-symbols-outlined">add_circle</span> New Show</a>
            @endif
        </div>
    </div>

    @if($activeShow)
        <div style="margin-bottom:24px;padding:16px;background:var(--neutral-50);border:1px solid var(--neutral-100);border-radius:8px;display:flex;justify-content:space-between;align-items:center;">
            <div>
                <strong>Current Show:</strong> {{ $activeShow->name }}
                @if($activeShow->start_date)
                    &mdash; Start: {{ \Carbon\Carbon::parse($activeShow->start_date)->format('M d, Y') }}
                @endif
                @if($activeShow->end_date)
                    &mdash; End: {{ \Carbon\Carbon::parse($activeShow->end_date)->format('M d, Y') }}
                @endif
                &mdash; <strong>Active</strong>
            </div>
            <a href="/admin/shows/edit/{{ $activeShow->show_id }}" class="btn btn-sm btn-outline"><span class="material-symbols-outlined">edit</span> Edit</a>
        </div>
    @endif

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-value">{{ $totalUsers }}</div>
            <div class="stat-label">Total Exhibitors</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ $totalActiveExhibitors }}</div>
            <div class="stat-label">Active Exhibitors</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ $totalBooths }}</div>
            <div class="stat-label">Assigned Booths</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ $unassignedBooths }}</div>
            <div class="stat-label">Unassigned</div>
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
