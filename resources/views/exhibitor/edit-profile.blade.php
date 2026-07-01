@extends('layouts.app')
@section('title', 'Edit Profile')

@section('content')

    <div class="page-header">
        <h1>Edit Profile</h1>
    </div>

    <div class="form-card">
        <h2>Company Information</h2>

        <form method="POST" action="/exhibitor/profile/update">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Company Name</label>
                <input type="text" name="company_name" value="{{ $exhibitor->company_name }}">
            </div>

            <div class="form-group">
                <label>Representative Name</label>
                <input type="text" name="representative_name" value="{{ $exhibitor->representative_name }}">
            </div>

            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone_number" value="{{ $exhibitor->phone_number }}">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn"><span class="material-symbols-outlined">save</span> Update Profile</button>
                <a href="/exhibitor/dashboard" class="btn btn-outline"><span class="material-symbols-outlined">close</span> Cancel</a>
            </div>
        </form>
    </div>

@endsection
