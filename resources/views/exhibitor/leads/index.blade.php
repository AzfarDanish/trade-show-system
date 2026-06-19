<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>My Leads</h1>

    <a href="/exhibitor/leads/create">Add New Lead</a>

    @foreach($leads as $lead)
        <p>Name: {{ $lead->lead_name }}</p>
        <p>Company: {{ $lead->company_name }}</p>
        <p>Phone: {{ $lead->phone }}</p>
        <p>Email: {{ $lead->email }}</p>
        <hr>
    @endforeach
</body>
</html>