@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

    <!-- Show status banner: ended, can join, or active -->
    @if($showEnded)
        <div class="banner banner-ended">
            This show has ended.
        </div>
    @elseif($canJoin)
        <div class="banner banner-join">
            <span>This show has ended. A new show is coming up—click here to join!</span>
            <form method="POST" action="/exhibitor/join" onsubmit="return confirm('Join the new show? Your existing profile and past data will carry over automatically.')">
                @csrf
                <button type="submit" class="banner-btn"><span class="material-symbols-outlined">login</span> Join</button>
            </form>
        </div>
    @endif

    <!-- Page header -->
    <div class="page-header">
        <div>
            <h1>Exhibitor Dashboard</h1>
            <p class="subtitle">Welcome, {{ $user->name }}</p>
        </div>
    </div>

    <!-- Show info, poster, and statistics grid -->
    @if($activeShow)
        <div class="poster-flex">
            @if($activeShow->poster)
                <div class="poster-side">
                    <img src="{{ asset('storage/' . $activeShow->poster) }}" class="poster-img">
                </div>
            @endif
            <div class="poster-content">
                <div class="show-info">
                    <div class="show-info-title">{{ $activeShow->name }}</div>
                    @if($activeShow->start_date || $activeShow->end_date)
                        <div class="show-info-date">
                            {{ $activeShow->start_date ? \Carbon\Carbon::parse($activeShow->start_date)->format('M d, Y') : '' }}
                            @if($activeShow->start_date && $activeShow->end_date) - @endif
                            {{ $activeShow->end_date ? \Carbon\Carbon::parse($activeShow->end_date)->format('M d, Y') : '' }}
                        </div>
                    @endif
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
                    @if($booth)
                        <div class="stat-card">
                            <div class="stat-value">{{ $booth->booth_number }}</div>
                            <div class="booth-stat">{{ $booth->location }}</div>
                        </div>
                    @else
                        <div class="stat-card">
                            <div class="stat-value">—</div>
                            <div class="stat-label">Booth</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @else
        <!-- Stats grid when no active show -->
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
            @if($booth)
                <div class="stat-card">
                    <div class="stat-value">{{ $booth->booth_number }}</div>
                    <div class="booth-stat">{{ $booth->location }}</div>
                </div>
            @else
                <div class="stat-card">
                    <div class="stat-value">—</div>
                    <div class="stat-label">Booth</div>
                </div>
            @endif
        </div>
    @endif

    <!-- Profile information card -->
    <div class="profile-card">
        <div class="flex-group" style="margin-bottom:20px;padding-bottom:12px;border-bottom:1px solid var(--neutral-100);">
            <h2 style="margin-bottom:0;padding-bottom:0;border-bottom:none;">Profile Information</h2>
            <a href="/exhibitor/profile/edit" class="btn btn-sm btn-outline"><span class="material-symbols-outlined">edit</span> Edit Profile</a>
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
