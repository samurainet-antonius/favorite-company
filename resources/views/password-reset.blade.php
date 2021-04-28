<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Register Account</title>
</head>
<body>
    <h1>Welcome, {{ $users->name }}!</h1>
    <p>Thanks so much for joining Favorite Company we're thrilled to have you!</p>
    <p>Please click on the link below to complete your registration and set up your favorite company.</p>
    <a href="{{ url('/').'/change-password/'.$users->remember_token }}">Change Password</a>
    <p>Thank you.</p>
</body>
</html>