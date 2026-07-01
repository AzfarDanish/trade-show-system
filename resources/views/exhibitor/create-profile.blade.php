@extends('layouts.app')
@section('title', 'Create Profile')

@section('content')

    <div class="page-header">
        <h1>Create Profile</h1>
    </div>

    <div class="form-card">
        <h2>Company Information</h2>

        <form method="POST" action="/exhibitor/profile/store">
            @csrf

            <div class="form-group">
                <label>Company Name</label>
                <input type="text" name="company_name" placeholder="Enter your company name">
            </div>

            <div class="form-group">
                <label>Representative Name</label>
                <input type="text" name="representative_name" placeholder="Full name">
            </div>

            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone_number" placeholder="e.g. +1 234 567 890">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn"><span class="material-symbols-outlined">save</span> Save Profile</button>
                <a href="/" class="btn btn-outline"><span class="material-symbols-outlined">close</span> Cancel</a>
            </div>
        </form>
    </div>

@endsection
