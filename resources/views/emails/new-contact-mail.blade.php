<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact</title>
</head>
<body>
    <h3>{{$lead->name}}</h3>
    <span>{{$lead->address}}</span>
    <p>Ti ha inviato un messaggio:</p>
    <p>{{$lead->mailContent}}</p>
</body>
</html>