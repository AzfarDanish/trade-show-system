@extends('layouts.app')
@section('title', 'Leads')

@section('content')

    <div class="page-header">
        <div>
            <h1>All Leads</h1>
            <p class="subtitle">{{ count($leads) }} lead(s) captured</p>
        </div>
        <form method="GET" action="/admin/leads/search">
            <input type="text" name="search" placeholder="Search Lead" style="width:220px">
            <button type="submit" class="btn btn-sm">Search</button>
        </form>
    </div>

    @if(count($leads) > 0)
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Company</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leads as $lead)
                        <tr>
                            <td>{{ $lead->lead_name }}</td>
                            <td>{{ $lead->company_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state">
            <p>No leads found.</p>
        </div>
    @endif

@endsection
