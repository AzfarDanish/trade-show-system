<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExpoTrack — Register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

<div class="auth-container">

    <div class="auth-left">
        <h1>ExpoTrack</h1>
        <p class="tagline">Join the platform and manage your trade show presence effectively.</p>
        <div class="auth-features">
            <div class="auth-feature">Manage booth assignments efficiently</div>
            <div class="auth-feature">Track business leads in one place</div>
            <div class="auth-feature">Schedule appointments seamlessly</div>
            <div class="auth-feature">Monitor exhibitor activities in real time</div>
        </div>
    </div>

    <div class="auth-right">
        <h2>Create Account</h2>
        <p class="auth-subtitle">Get started with ExpoTrack</p>

        @if($errors->any())
            <div class="flash flash-error">{{ $errors->first() }}</div>
        @endif

        <form class="auth-form" method="POST" action="/register">
            @csrf

            <div class="form-group">
                <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div class="form-group">
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
            </div>

            <button type="submit">Create Account</button>
        </form>

        <p class="auth-footer">
            Already have an account? <a href="/">Sign in</a>
        </p>
    </div>

</div>

</body>
</html>
