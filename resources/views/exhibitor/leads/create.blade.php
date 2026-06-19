<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Add Lead</h1>

    <form method="POST" action="/exhibitor/leads/store">
        @csrf

        <input type="text" name="lead_name" placeholder="Lead Name">

        <input type="text" name="company_name" placeholder="Company Name">

        <input type="text" name="phone" placeholder="Phone Number">

        <input type="email" name="email" placeholder="Email">

        <textarea name="notes" placeholder="Notes"></textarea>

        <button type="submit">Save Lead</button>
    </form>
</body>
</html>