@extends('layouts.app')
@section('content')
    <h1>My Booth</h1>

    @if($booth)
        <p>Booth Number: {{ $booth->booth_number }}</p>
        <p>Location: {{ $booth->location }}</p>
    @else
        <p>No booth assigned yet.</p>
    @endif
@endsection
