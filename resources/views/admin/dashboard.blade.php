@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <!-- Page header with show management actions (end show or create new) -->
    <div class="page-header">
        <div>
            <h1>Dashboard Overview</h1>
            <p class="subtitle">Welcome back, {{ Auth::user()->name ?? 'Admin' }}</p>
        </div>
        <div class="flex-group">
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
        <!-- Active show info, poster, and statistics grid -->
        <div class="poster-flex">
            @if($activeShow->poster)
                <div class="poster-side">
                    <img src="{{ asset('storage/' . $activeShow->poster) }}" class="poster-img">
                </div>
            @endif
            <div class="poster-content">
                <div class="show-info-row">
                    <div>
                        <div class="show-info-title">{{ $activeShow->name }}</div>
                        @if($activeShow->start_date || $activeShow->end_date)
                            <div class="show-info-date">
                                {{ $activeShow->start_date ? \Carbon\Carbon::parse($activeShow->start_date)->format('M d, Y') : '' }}
                                @if($activeShow->start_date && $activeShow->end_date) - @endif
                                {{ $activeShow->end_date ? \Carbon\Carbon::parse($activeShow->end_date)->format('M d, Y') : '' }}
                            </div>
                        @endif
                    </div>
                    <a href="/admin/shows/edit/{{ $activeShow->show_id }}" class="btn btn-sm btn-outline"><span class="material-symbols-outlined">edit</span> Edit</a>
                </div>
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
            </div>
        </div>
    @else
        <!-- Empty state when no show is active -->
        <div class="empty-card">
            <p>No active show running.</p>
        </div>
    @endif

@endsection
