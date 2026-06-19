<h1>All Exhibitors</h1>

<form method="GET" action="/admin/exhibitors/search">
    <input type="text" name="search" placeholder="Search Exhibitor">
    <button type="submit">Search</button>
</form>

@foreach($exhibitors as $exhibitor)
    <p>Company: {{ $exhibitor->company_name }}</p>
    <p>Representative: {{ $exhibitor->representative_name }}</p>
    <p>Phone: {{ $exhibitor->phone_number }}</p>
    <hr>
@endforeach