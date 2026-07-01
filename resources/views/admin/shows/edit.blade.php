@extends('layouts.app')
@section('title', 'Edit Show')

@section('content')

    <div class="page-header">
        <h1>Edit Show</h1>
    </div>

    <div class="form-card">
        <h2>Show Details</h2>

        <form method="POST" action="/admin/shows/update/{{ $show->show_id }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Show Name</label>
                <input type="text" name="name" value="{{ $show->name }}" required>
            </div>

            <div class="form-group">
                <label>Start Date (optional)</label>
                <input type="date" name="start_date" value="{{ $show->start_date }}">
            </div>

            <div class="form-group">
                <label>End Date (optional)</label>
                <input type="date" name="end_date" value="{{ $show->end_date }}">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn"><span class="material-symbols-outlined">save</span> Update Show</button>
                <a href="/admin/dashboard" class="btn btn-outline"><span class="material-symbols-outlined">close</span> Cancel</a>
            </div>
        </form>
    </div>

@endsection