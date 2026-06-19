<h1>All Exhibitors</h1>

@foreach($exhibitors as $exhibitor)
    <p>Company: {{ $exhibitor->company_name }}</p>
    <p>Representative: {{ $exhibitor->representative_name }}</p>
    <p>Phone: {{ $exhibitor->phone_number }}</p>
    <hr>
@endforeach