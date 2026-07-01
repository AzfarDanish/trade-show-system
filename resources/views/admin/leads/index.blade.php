@extends('layouts.app')
@section('title', 'Leads')

@section('content')

    <!-- Page header with search bar -->
    <div class="page-header">
        <div>
            <h1>All Leads</h1>
            <p class="subtitle">{{ count($leads) }} lead(s) captured</p>
        </div>
        <form method="GET" action="/admin/leads/search" class="flex-row">
            <input type="text" name="search" placeholder="Search Lead" style="width:220px">
            <button type="submit" class="btn btn-sm"><span class="material-symbols-outlined">search</span> Search</button>
        </form>
    </div>

    @if(count($leads) > 0)
        <!-- Leads table -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Lead</th>
                        <th>Company</th>
                        <th>Contact</th>
                        <th>Exhibitor</th>
                        <th>Date Added</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leads as $lead)
                        <tr>
                            <td>{{ $lead->lead_name }}</td>
                            <td>{{ $lead->company_name }}</td>
                            <td>{{ $lead->phone ?? '—' }}<br><span class="meta-text">{{ $lead->email ?? '' }}</span></td>
                            <td>{{ $lead->exhibitor->company_name ?? '—' }}</td>
                            <td>{{ $lead->created_at ? $lead->created_at->format('M d, Y') : '—' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <!-- Empty state when no leads exist -->
        <div class="empty-state">
            <p>No leads found.</p>
        </div>
    @endif

@endsection
