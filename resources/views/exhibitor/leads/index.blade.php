@extends('layouts.app')
@section('title', 'Leads')

@section('content')

    <div class="page-header">
        <div>
            <h1>My Leads</h1>
            <p class="subtitle">{{ count($leads) }} lead(s)</p>
        </div>
        <div style="display:flex; gap:12px;">
            <form method="GET" action="/exhibitor/leads/search">
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
                        <th>Name</th>
                        <th>Company</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leads as $lead)
                        <tr>
                            <td>{{ $lead->lead_name }}</td>
                            <td>{{ $lead->company_name }}</td>
                            <td>{{ $lead->phone }}</td>
                            <td>{{ $lead->email }}</td>
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
