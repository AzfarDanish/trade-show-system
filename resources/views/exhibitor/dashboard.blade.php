@extends('layouts.app')
@section('content')

    <h1>Exhibitor Dashboard</h1>

    <p>Welcome, {{ $user->name }}</p>

    <p>Company Name: {{ $exhibitor->company_name }}</p>
    <p>Representative: {{ $exhibitor->representative_name }}</p>
    <p>Phone Number: {{ $exhibitor->phone_number }}</p>

@endsection
