<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExpoTrack — Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
            line-height: 1;
        }
    </style>
</head>
<body>

<!-- Login page layout with branded left panel and form on the right -->
<div class="auth-container">

    <!-- Left: branding and feature highlights -->
    <div class="auth-left">
        <h1>ExpoTrack</h1>
        <p class="tagline">Smart trade show management for exhibitors and organizers.</p>
        <div class="auth-features">
            <div class="auth-feature">Manage booth assignments efficiently</div>
            <div class="auth-feature">Track business leads in one place</div>
            <div class="auth-feature">Schedule appointments seamlessly</div>
            <div class="auth-feature">Monitor exhibitor activities in real time</div>
        </div>
    </div>

    <!-- Right: sign-in form -->
    <div class="auth-right">
        <h2>Welcome Back</h2>
        <p class="auth-subtitle">Sign in to your account</p>

        <form class="auth-form" method="POST" action="/">
            @csrf

            <div class="form-group">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit"><span class="material-symbols-outlined">login</span> Sign In</button>
        </form>

        <p class="auth-footer">
            No account? <a href="/register">Create one</a>
        </p>
    </div>

</div>

</body>
</html>
