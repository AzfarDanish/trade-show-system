@extends('layouts.app')
@section('title', 'Leads')

@section('content')

    <div class="page-header">
        <div>
            <h1>My Leads</h1>
            <p class="subtitle">{{ count($leads) }} lead(s)</p>
        </div>
        <div style="display:flex; gap:12px; align-items:center;">
            <form method="GET" action="/exhibitor/leads/search" style="display:flex; gap:8px; align-items:center;">
                <input type="text" name="search" placeholder="Search Lead" style="width:200px">
                <button type="submit" class="btn btn-sm">Search</button>
            </form>
            <a href="/exhibitor/leads/create" class="btn btn-sm">+ Add Lead</a>
        </div>
    </div>

    @if(count($leads) > 0)
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Lead</th>
                        <th>Company</th>
                        <th>Contact</th>
                        <th>Date Added</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leads as $lead)
                        <tr>
                            <td>{{ $lead->lead_name }}</td>
                            <td>{{ $lead->company_name }}</td>
                            <td>{{ $lead->phone ?? '—' }}<br><span style="color:var(--neutral-400);font-size:.78rem;">{{ $lead->email ?? '' }}</span></td>
                            <td>{{ $lead->created_at ? $lead->created_at->format('M d, Y') : '—' }}</td>
                            <td>
                                <div class="inline-actions">
                                    <a href="/exhibitor/leads/edit/{{ $lead->lead_id }}" class="btn btn-sm btn-outline">Edit</a>
                                    <form method="POST" action="/exhibitor/leads/delete/{{ $lead->lead_id }}" onsubmit="return confirm('Delete this lead?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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
            <p>No leads yet. <a href="/exhibitor/leads/create">Add your first lead</a>.</p>
        </div>
    @endif

@endsection
