<h1>Admin Dashboard</h1>

<p>Total Users: {{ $totalUsers }}</p>
<p>Total Exhibitors: {{ $totalExhibitors }}</p>
<p>Total Booths: {{ $totalBooths }}</p>
<p>Total Leads: {{ $totalLeads }}</p>
<p>Total Appointments: {{ $totalAppointments }}</p>

<a href="/admin/exhibitors">View Exhibitors</a>
<a href="/admin/booths">View Booths</a>
<a href="/admin/leads">View Leads</a>
<a href="/admin/appointments">View Appointments</a>

<form method="POST" action="/logout">
    @csrf
    <button type="submit">Logout</button>
</form>