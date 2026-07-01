@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

    @if($showEnded)
        <div style="background:#dc2626;color:#fff;padding:16px 24px;border-radius:8px;margin-bottom:24px;font-weight:600;text-align:center;">
            This show has ended.
        </div>
    @elseif($canJoin)
        <div style="background:#dc2626;color:#fff;padding:16px 24px;border-radius:8px;margin-bottom:24px;display:flex;justify-content:space-between;align-items:center;">
            <span style="font-weight:600;">This show has ended. A new show is coming up—click here to join!</span>
            <form method="POST" action="/exhibitor/join" onsubmit="return confirm('Join the new show? Your existing profile and past data will carry over automatically.')">
                @csrf
                <button type="submit" style="background:#fff;color:#dc2626;border:none;padding:8px 20px;border-radius:6px;font-weight:600;cursor:pointer;display:flex;align-items:center;gap:6px;"><span class="material-symbols-outlined" style="font-size:1.1rem;">login</span> Join</button>
            </form>
        </div>
    @endif

    <div class="page-header">
        <div>
            <h1>Exhibitor Dashboard</h1>
            <p class="subtitle">Welcome, {{ $user->name }}</p>
        </div>
    </div>

    @if($activeShow)
        <div style="margin-bottom:24px;padding:16px;background:var(--neutral-50);border:1px solid var(--neutral-100);border-radius:8px;">
            <strong>Current Show:</strong> {{ $activeShow->name }}
            @if($activeShow->start_date)
                &mdash; Start: {{ \Carbon\Carbon::parse($activeShow->start_date)->format('M d, Y') }}
            @endif
            @if($activeShow->end_date)
                &mdash; End: {{ \Carbon\Carbon::parse($activeShow->end_date)->format('M d, Y') }}
            @endif
            &mdash; <strong>Active</strong>
        </div>
    @endif

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
                <div style="font-size:.82rem;color:var(--neutral-400);margin-top:6px;">{{ $booth->location }}</div>
            </div>
        @else
            <div class="stat-card">
                <div class="stat-value">—</div>
                <div class="stat-label">Booth</div>
            </div>
        @endif
    </div>

    <div class="profile-card">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;padding-bottom:12px;border-bottom:1px solid var(--neutral-100);">
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
