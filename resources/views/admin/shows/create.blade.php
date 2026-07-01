@extends('layouts.app')
@section('title', 'New Show')

@section('content')

    <!-- Page header -->
    <div class="page-header">
        <h1>Create New Show</h1>
    </div>

    <!-- Show creation form with file upload for poster -->
    <div class="form-card">
        <h2>Show Details</h2>

        <form method="POST" action="/admin/shows/store" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Show Name</label>
                <input type="text" name="name" placeholder="e.g. Tech Expo 2027" required>
            </div>

            <div class="form-group">
                <label>Start Date (optional)</label>
                <input type="date" name="start_date">
            </div>

            <div class="form-group">
                <label>End Date (optional)</label>
                <input type="date" name="end_date">
            </div>

            <div class="form-group">
                <label>Poster Image (optional)</label>
                <input type="file" name="poster" accept="image/*">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn"><span class="material-symbols-outlined">add_circle</span> Create Show</button>
                <a href="/admin/dashboard" class="btn btn-outline"><span class="material-symbols-outlined">close</span> Cancel</a>
            </div>
        </form>
    </div>

@endsection