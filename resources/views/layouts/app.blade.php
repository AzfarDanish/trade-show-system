<!DOCTYPE html>
<html>
<head>
    <title>Trade Show System</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <header>
        <h1>Trade Show Management System</h1>
    </header>

    <nav>
        @if(Auth::check())

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
                <a href="/exhibitor/leads">My Leads</a>
                <a href="/exhibitor/appointments">My Appointments</a>
            @endif

            <form method="POST" action="/logout" style="display:inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>

        @else
            <a href="/login">Login</a>
            <a href="/register">Register</a>
        @endif
    </nav>

    <hr>

    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        @yield('content')
    </div>

    <hr>

    <footer>
        <p>© 2026 Trade Show System</p>
    </footer>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this record?');
        }
    </script>

</body>
</html>
