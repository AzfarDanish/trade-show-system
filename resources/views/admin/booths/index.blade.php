@extends('layouts.app')
@section('title', 'Booths')

@section('content')

    <div class="page-header">
        <div>
            <h1>All Booths</h1>
            @if($filter === 'assigned')
                <p class="subtitle">{{ count($booths) }} booth(s) assigned</p>
            @else
                <p class="subtitle">{{ count($unassignedExhibitors) }} active exhibitor(s) without a booth</p>
            @endif
        </div>
        <div style="display:flex; gap:12px; align-items:center;">
            <form method="GET" action="/admin/booths" style="display:flex; gap:8px; align-items:center;">
                <select name="filter" style="width:160px">
                    <option value="assigned" {{ $filter === 'assigned' ? 'selected' : '' }}>Assigned</option>
                    <option value="unassigned" {{ $filter === 'unassigned' ? 'selected' : '' }}>Not Assigned</option>
                </select>
                <button type="submit" class="btn btn-sm"><span class="material-symbols-outlined">filter_alt</span> Filter</button>
            </form>
            <form method="GET" action="/admin/booths/search" style="display:flex; gap:8px; align-items:center;">
                <input type="text" name="search" placeholder="Search Booth" style="width:200px">
                <button type="submit" class="btn btn-sm"><span class="material-symbols-outlined">search</span> Search</button>
            </form>
            <a href="/admin/booths/create" class="btn btn-sm"><span class="material-symbols-outlined">add</span> New Booth</a>
        </div>
    </div>

    @if($filter === 'assigned')
        @if(count($booths) > 0)
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Booth Number</th>
                            <th>Exhibitor</th>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($booths as $booth)
                            <tr>
                                <td>{{ $booth->booth_number }}</td>
                                <td>{{ $booth->exhibitor->company_name ?? '—' }}</td>
                                <td>{{ $booth->location }}</td>
                                <td>
                                    <div class="inline-actions">
                                        <a href="/admin/booths/edit/{{ $booth->booth_id }}" class="btn btn-sm btn-outline"><span class="material-symbols-outlined">edit</span> Edit</a>
                                        <form method="POST" action="/admin/booths/delete/{{ $booth->booth_id }}" onsubmit="return confirm('Delete this booth?')">
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
            <div class="empty-state">
                <p>No booths found.</p>
            </div>
        @endif
    @else
        @if(count($unassignedExhibitors) > 0)
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Company</th>
                            <th>Representative</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($unassignedExhibitors as $exhibitor)
                            <tr>
                                <td>{{ $exhibitor->company_name }}</td>
                                <td>{{ $exhibitor->representative_name }}</td>
                                <td>{{ $exhibitor->user->email ?? '—' }}</td>
                                <td>
                                    <a href="/admin/booths/create" class="btn btn-sm btn-outline"><span class="material-symbols-outlined">assignment_add</span> Assign Booth</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <p>All active exhibitors have been assigned a booth.</p>
            </div>
        @endif
    @endif

@endsection
