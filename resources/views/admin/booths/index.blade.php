<h1>All Booths</h1>

<form method="GET" action="/admin/booths/search">
    <input type="text" name="search" placeholder="Search Booth">
    <button type="submit">Search</button>
</form>

@foreach($booths as $booth)
    <p>Booth Number: {{ $booth->booth_number }}</p>
    <p>Location: {{ $booth->location }}</p>
    <hr>
@endforeach