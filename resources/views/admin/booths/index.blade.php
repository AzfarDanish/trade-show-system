<h1>All Booths</h1>

@foreach($booths as $booth)
    <p>Booth Number: {{ $booth->booth_number }}</p>
    <p>Location: {{ $booth->location }}</p>
    <hr>
@endforeach