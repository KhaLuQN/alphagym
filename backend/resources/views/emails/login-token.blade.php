<!DOCTYPE html>
<html>
<head>
    <title>Login Token</title>
</head>
<body>
    <p>Click the link below to log in:</p>
    <a href="{{ route('login.callback', ['token' => $token]) }}">Log In</a>
</body>
</html>
