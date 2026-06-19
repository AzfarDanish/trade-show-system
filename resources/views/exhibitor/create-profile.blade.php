@extends('layouts.app')
@section('content')
    <form method="POST" action="/exhibitor/profile/store">
        @csrf

        <input type="text" name="company_name" placeholder="Company Name">

        <input type="text" name="representative_name" placeholder="Representative Name">

        <input type="text" name="phone_number" placeholder="Phone Number">

        <button type="submit">Save Profile</button>
    </form>
@endsection
