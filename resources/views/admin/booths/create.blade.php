<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="/admin/booths/store">
        @csrf

        <select name="exhibitor_id">
            @foreach($exhibitors as $exhibitor)
                <option value="{{ $exhibitor->exhibitor_id }}">
                    {{ $exhibitor->company_name }}
                </option>
            @endforeach
        </select>

        <input type="text" name="booth_number" placeholder="Booth Number">

        <input type="text" name="location" placeholder="Location">

        <button type="submit">Assign Booth</button>
    </form>
</body>
</html>