<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExpoTrack — @yield('title', 'Dashboard')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

<header class="topbar">
    <div class="top-right">
        <span>{{ Auth::user()->role }}</span>
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>
</header>

<div class="main-layout">

    <aside class="sidebar">
        <div class="sidebar-logo">ExpoTrack</div>
        <div class="sidebar-divider"></div>
        <div class="sidebar-label">Navigation</div>

        @if(Auth::user()->role == 'admin')
            <a href="/admin/dashboard">Dashboard</a>
            <a href="/admin/exhibitors">Exhibitors</a>
            <a href="/admin/booths">Booths</a>
            <a href="/admin/leads">Leads</a>
            <a href="/admin/appointments">Appointments</a>
        @endif

        @if(Auth::user()->role == 'exhibitor')
            <a href="/exhibitor/dashboard">Dashboard</a>
            <a href="/exhibitor/booth">My Booth</a>
            <a href="/exhibitor/leads">Leads</a>
            <a href="/exhibitor/appointments">Appointments</a>
            <a href="/exhibitor/profile/edit">Profile</a>
        @endif
    </aside>

    <main class="content">
        @if(session('success'))
            <div class="flash flash-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="flash flash-error">{{ session('error') }}</div>
        @endif
        @yield('content')
    </main>

</div>

</body>
</html>
