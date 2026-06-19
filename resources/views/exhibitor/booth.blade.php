<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>My Booth</h1>

    @if($booth)
        <p>Booth Number: {{ $booth->booth_number }}</p>
        <p>Location: {{ $booth->location }}</p>
    @else
        <p>No booth assigned yet.</p>
    @endif
</body>
</html>