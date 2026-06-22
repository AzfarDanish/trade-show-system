@extends('layouts.app')
@section('title', 'My Booth')

@section('content')

    <div class="page-header">
        <h1>My Booth</h1>
    </div>

    <div class="profile-card">
        <h2>Booth Details</h2>

        @if($booth)
            <dl class="detail-list">
                <dt>Booth Number</dt>
                <dd>{{ $booth->booth_number }}</dd>
                <dt>Location</dt>
                <dd>{{ $booth->location }}</dd>
            </dl>
        @else
            <div class="empty-state" style="padding: 24px 0;">
                <p>No booth assigned yet.</p>
            </div>
        @endif
    </div>

@endsection
