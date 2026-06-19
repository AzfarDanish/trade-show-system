<h1>All Appointments</h1>

@foreach($appointments as $appointment)
    <p>Client: {{ $appointment->client_name }}</p>
    <p>Date: {{ $appointment->appointment_date }}</p>
    <p>Status: {{ $appointment->status }}</p>
    <hr>
@endforeach