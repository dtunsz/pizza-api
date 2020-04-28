<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Customer Form</h1>
    <form action="http://localhost:8000/api/orders/confirm/v1587882614O" method="post" id="form">
        name<input type="text" name="name">
        <br />
        email<input type="text" name="email">
        <br />
        phone<input type="text" name="phone">
        <br />
        house<input type="text" name="house">
        <br />
        street<input type="text" name="street">
        <br />
        city<input type="text" name="city">
        <button type="submit">submit</button>
    </form>
</body>
</html>