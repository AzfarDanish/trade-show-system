<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="/exhibitor/profile/store">
        @csrf

        <input type="text" name="company_name" placeholder="Company Name">

        <input type="text" name="representative_name" placeholder="Representative Name">

        <input type="text" name="phone_number" placeholder="Phone Number">

        <button type="submit">Save Profile</button>
    </form>
</body>
</html>