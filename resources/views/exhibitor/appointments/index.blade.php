<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>My Appointments</h1>

    <a href="/exhibitor/appointments/create">Add Appointment</a>

    @foreach($appointments as $appointment)
        <p>Client: {{ $appointment->client_name }}</p>
        <p>Date: {{ $appointment->appointment_date }}</p>
        <p>Time: {{ $appointment->appointment_time }}</p>
        <p>Purpose: {{ $appointment->purpose }}</p>
        <p>Status: {{ $appointment->status }}</p>
        <hr>
    @endforeach
</body>
</html>