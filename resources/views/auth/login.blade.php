<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExpoTrack — Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

<div class="auth-container">

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

    <div class="auth-right">
        <h2>Welcome Back</h2>
        <p class="auth-subtitle">Sign in to your account</p>

        @if(session('success'))
            <div class="flash flash-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="flash flash-error">{{ $errors->first() }}</div>
        @endif

        <form class="auth-form" method="POST" action="/">
            @csrf

            <div class="form-group">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit">Sign In</button>
        </form>

        <p class="auth-footer">
            No account? <a href="/register">Create one</a>
        </p>
    </div>

</div>

</body>
</html>
