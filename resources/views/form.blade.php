<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action={{route('form')}} method="post">
@csrf
<input type="text" name="name">
<input type="email" name="email">
<input type="password" name="password">
<input type="submit">

</form>
</body>
</html>
