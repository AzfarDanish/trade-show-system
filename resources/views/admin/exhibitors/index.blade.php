@extends('layouts.app')
@section('title', 'Exhibitors')

@section('content')

    <div class="page-header">
        <div>
            <h1>All Exhibitors</h1>
            <p class="subtitle">{{ count($exhibitors) }} exhibitor(s) registered</p>
        </div>
        <form method="GET" action="/admin/exhibitors/search">
            <input type="text" name="search" placeholder="Search Exhibitor" style="width:220px">
            <button type="submit" class="btn btn-sm">Search</button>
        </form>
    </div>

    @if(count($exhibitors) > 0)
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Company</th>
                        <th>Representative</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($exhibitors as $exhibitor)
                        <tr>
                            <td>{{ $exhibitor->company_name }}</td>
                            <td>{{ $exhibitor->representative_name }}</td>
                            <td>{{ $exhibitor->phone_number }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state">
            <p>No exhibitors found.</p>
        </div>
    @endif

@endsection
