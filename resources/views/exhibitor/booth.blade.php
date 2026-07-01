@extends('layouts.app')
@section('title', 'My Booth')

@section('content')

    <!-- Page header -->
    <div class="page-header">
        <h1>My Booth</h1>
    </div>

    @if($booth)
        <!-- Booth details card -->
        <div class="stat-card" style="max-width:450px;">
            <div class="stat-value">{{ $booth->booth_number }}</div>
            <div class="stat-label">Booth Number</div>
            <div style="display:flex; gap:48px; margin-top:16px; padding-top:16px; border-top:1px solid var(--neutral-100);">
                <div>
                    <div style="font-size:.7rem; font-weight:600; color:var(--neutral-400); text-transform:uppercase; letter-spacing:.06em;">Location</div>
                    <div style="font-size:.9rem; color:var(--neutral-800); margin-top:2px;">{{ $booth->location }}</div>
                </div>
            </div>
        </div>
    @else
        <!-- Empty state when no booth is assigned -->
        <div class="stat-card" style="max-width:450px;">
            <div class="empty-state" style="padding:24px 0;">
                <p>No booth assigned yet.</p>
            </div>
        </div>
    @endif

@endsection
