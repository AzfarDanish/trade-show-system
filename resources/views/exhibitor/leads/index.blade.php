@extends('layouts.app')
@section('content')
    <h1>My Leads</h1>

    <a href="/exhibitor/leads/create">Add New Lead</a>

    <form method="GET" action="/exhibitor/leads/search">
        <input type="text" name="search" placeholder="Search Lead">
        <button type="submit">Search</button>
    </form>

    @foreach($leads as $lead)
        <a href="/exhibitor/leads/edit/{{ $lead->lead_id }}">
            Edit
        </a>

        <form method="POST" action="/exhibitor/leads/delete/{{ $lead->lead_id }}" onsubmit="return confirmDelete()">
            @csrf
            @method('DELETE')

            <button type="submit">Delete</button>
        </form>

        <p>Name: {{ $lead->lead_name }}</p>
        <p>Company: {{ $lead->company_name }}</p>
        <p>Phone: {{ $lead->phone }}</p>
        <p>Email: {{ $lead->email }}</p>
        <hr>
    @endforeach
@endsection
