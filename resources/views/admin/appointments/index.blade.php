@extends('layouts.app')
@section('title', 'Appointments')

@section('content')

    <div class="page-header">
        <div>
            <h1>All Appointments</h1>
            <p class="subtitle">{{ count($appointments) }} appointment(s)</p>
        </div>
        <form method="GET" action="/admin/appointments/filter" style="display:flex; gap:8px; align-items:center;">
            <select name="status" style="width:160px">
                <option value="">All Statuses</option>
                <option value="Confirmed">Confirmed</option>
                <option value="Completed">Completed</option>
                <option value="Cancelled">Cancelled</option>
            </select>
            <button type="submit" class="btn btn-sm">Filter</button>
        </form>
    </div>

    @if(count($appointments) > 0)
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Date & Time</th>
                        <th>Purpose</th>
                        <th>Exhibitor</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->client_name }}</td>
                            <td>{{ $appointment->appointment_date }}<br><span style="color:var(--neutral-400);font-size:.78rem;">{{ $appointment->appointment_time }}</span></td>
                            <td>{{ $appointment->purpose }}</td>
                            <td>{{ $appointment->exhibitor->company_name ?? '—' }}</td>
                            <td>
                                <span class="status-badge status-badge-{{ strtolower($appointment->status) }}">
                                    {{ $appointment->status }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state">
            <p>No appointments found.</p>
        </div>
    @endif

@endsection
