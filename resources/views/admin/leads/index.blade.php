<h1>All Leads</h1>

@foreach($leads as $lead)
    <p>Name: {{ $lead->lead_name }}</p>
    <p>Company: {{ $lead->company_name }}</p>
    <hr>
@endforeach