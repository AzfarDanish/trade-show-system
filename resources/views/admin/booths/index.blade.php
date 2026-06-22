@extends('layouts.app')
@section('title', 'Booths')

@section('content')

    <div class="page-header">
        <div>
            <h1>All Booths</h1>
            <p class="subtitle">{{ count($booths) }} booth(s) assigned</p>
        </div>
        <div style="display:flex; gap:12px;">
            <form method="GET" action="/admin/booths/search">
                <input type="text" name="search" placeholder="Search Booth" style="width:200px">
                <button type="submit" class="btn btn-sm">Search</button>
            </form>
            <a href="/admin/booths/create" class="btn btn-sm">+ New Booth</a>
        </div>
    </div>

    @if(count($booths) > 0)
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Booth Number</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($booths as $booth)
                        <tr>
                            <td>{{ $booth->booth_number }}</td>
                            <td>{{ $booth->location }}</td>
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

@endsection
