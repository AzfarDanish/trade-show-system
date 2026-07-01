@extends('layouts.app')
@section('title', 'Leads')

@section('content')

    <!-- Page header with search and add button -->
    <div class="page-header">
        <div>
            <h1>My Leads</h1>
            <p class="subtitle">{{ count($leads) }} lead(s)</p>
        </div>
        <div class="flex-group">
            <form method="GET" action="/exhibitor/leads/search" class="flex-row">
                <input type="text" name="search" placeholder="Search Lead" style="width:200px">
                <button type="submit" class="btn btn-sm"><span class="material-symbols-outlined">search</span> Search</button>
            </form>
            <a href="/exhibitor/leads/create" class="btn btn-sm"><span class="material-symbols-outlined">add</span> Add Lead</a>
        </div>
    </div>

    @if(count($leads) > 0)
        <!-- Leads table with edit/delete actions -->
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
                            <td>{{ $lead->phone ?? '—' }}<br><span class="meta-text">{{ $lead->email ?? '' }}</span></td>
                            <td>{{ $lead->created_at ? $lead->created_at->format('M d, Y') : '—' }}</td>
                            <td>
                                <div class="inline-actions">
                                    <a href="/exhibitor/leads/edit/{{ $lead->lead_id }}" class="btn btn-sm btn-outline"><span class="material-symbols-outlined">edit</span> Edit</a>
                                    <form method="POST" action="/exhibitor/leads/delete/{{ $lead->lead_id }}" onsubmit="return confirm('Delete this lead?')">
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
        <!-- Empty state when no leads exist -->
        <div class="empty-state">
            <p>No leads yet. <a href="/exhibitor/leads/create">Add your first lead</a>.</p>
        </div>
    @endif

@endsection
