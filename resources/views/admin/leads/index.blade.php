@extends('layouts.app')
@section('content')
    <h1>All Leads</h1>

    <form method="GET" action="/admin/leads/search">
        <input type="text" name="search" placeholder="Search Lead">
        <button type="submit">Search</button>
    </form>

    @foreach($leads as $lead)
        <p>Name: {{ $lead->lead_name }}</p>
        <p>Company: {{ $lead->company_name }}</p>
        <hr>
    @endforeach
@endsection