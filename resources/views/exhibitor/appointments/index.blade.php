@extends('layouts.app')
@section('title', 'Appointments')

@section('content')

    <!-- Page header with add button -->
    <div class="page-header">
        <div>
            <h1>My Appointments</h1>
            <p class="subtitle">{{ count($appointments) }} appointment(s)</p>
        </div>
        <a href="/exhibitor/appointments/create" class="btn"><span class="material-symbols-outlined">add</span> Add Appointment</a>
    </div>

    @if(count($appointments) > 0)
        <!-- Appointments table with edit/delete actions -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Date & Time</th>
                        <th>Purpose</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->client_name }}</td>
                            <td>{{ $appointment->appointment_date }}<br>
                                <span class="meta-text">{{ $appointment->appointment_time }}</span>
                            </td>
                            <td>{{ $appointment->purpose }}</td>
                            <td>
                                <span class="status-badge status-badge-{{ strtolower($appointment->status) }}">
                                    {{ $appointment->status }}
                                </span>
                            </td>
                            <td>
                                <div class="inline-actions">
                                    <a href="/exhibitor/appointments/edit/{{ $appointment->appointment_id }}" class="btn btn-sm btn-outline"><span class="material-symbols-outlined">edit</span> Edit</a>
                                    <form method="POST" action="/exhibitor/appointments/delete/{{ $appointment->appointment_id }}" onsubmit="return confirm('Delete this appointment?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><span class="material-symbols-outlined">delete</span> Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <!-- Empty state when no appointments exist -->
        <div class="empty-state">
            <p>No appointments yet. <a href="/exhibitor/appointments/create">Schedule one</a>.</p>
        </div>
    @endif

@endsection
