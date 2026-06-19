<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Exhibitor Dashboard</h1>

<p>Welcome, {{ $user->name }}</p>

<p>Company Name: {{ $exhibitor->company_name }}</p>

<p>Representative: {{ $exhibitor->representative_name }}</p>

<p>Phone Number: {{ $exhibitor->phone_number }}</p>

<a href="/exhibitor/profile/edit">Edit Profile</a>
<a href="/exhibitor/booth">View Booth</a>
<a href="/exhibitor/leads">Manage Leads</a>
<a href="/exhibitor/appointments">Manage Appointments</a>

<form method="POST" action="/logout">
    @csrf
    <button type="submit">Logout</button>
</form>
</body>
</html>