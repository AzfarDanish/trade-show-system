<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExpoTrack — @yield('title', 'Dashboard')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
            line-height: 1;
            font-size: 1.25rem;
        }
        .btn .material-symbols-outlined,
        .btn-sm .material-symbols-outlined {
            font-size: 1.1rem;
        }
    </style>
</head>
<body>

<!-- Top bar with user role label and logout button -->
<header class="topbar">
    <div class="top-right">
        <span>{{ Auth::user()->role }}</span>
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="btn-logout"><span class="material-symbols-outlined">logout</span> Logout</button>
        </form>
    </div>
</header>

<div class="main-layout">

    <!-- Sidebar navigation — links change based on user role -->
    <aside class="sidebar">
        <div class="sidebar-logo">ExpoTrack</div>
        <div class="sidebar-divider"></div>
        <div class="sidebar-label">Navigation</div>

        <!-- Admin navigation links -->
        @if(Auth::user()->role == 'admin')
            <a href="/admin/dashboard"><span class="material-symbols-outlined">dashboard</span> Dashboard</a>
            <a href="/admin/exhibitors"><span class="material-symbols-outlined">groups</span> Exhibitors</a>
            <a href="/admin/booths"><span class="material-symbols-outlined">storefront</span> Booths</a>
            <a href="/admin/leads"><span class="material-symbols-outlined">leaderboard</span> Leads</a>
            <a href="/admin/appointments"><span class="material-symbols-outlined">calendar_month</span> Appointments</a>
        @endif

        <!-- Exhibitor navigation links -->
        @if(Auth::user()->role == 'exhibitor')
            <a href="/exhibitor/dashboard"><span class="material-symbols-outlined">dashboard</span> Dashboard</a>
            <a href="/exhibitor/booth"><span class="material-symbols-outlined">storefront</span> My Booth</a>
            <a href="/exhibitor/leads"><span class="material-symbols-outlined">leaderboard</span> Leads</a>
            <a href="/exhibitor/appointments"><span class="material-symbols-outlined">calendar_month</span> Appointments</a>
            <a href="/exhibitor/profile/edit"><span class="material-symbols-outlined">person</span> Profile</a>
        @endif
    </aside>

    <!-- Main content area with flash messages and page content -->
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
