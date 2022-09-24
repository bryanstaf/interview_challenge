<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body class="container">

    <style>
        .img_scc{
            height: 5rem;
        }
    </style>

    <script>
        appendChild= document.getElementById("date");
        var textNode = document.createTextNode( 'Look mom! I\'m a text node!' );
elem.appendChild( textNode );
        document.getElementById("date").innerHTML="today";

    </script>

    <table class="table text-center">
        <tr><td><img class="img_scc" src="https://cdn-icons-png.flaticon.com/512/190/190411.png"></td></tr>
        <tr><td><h4>Order Confirmed</h4></td></tr>
        <tr><td><h4 id="date"><?php
        date_default_timezone_set('America/Lima');
        $now = new DateTime(); 
        echo $now->format("Y-m-d h:i:s A")
        ?></h4></td></tr>
        <tr><td><a class="btn btn-primary" href="http://localhost/interview/payment.html">Accept</a></td></tr>
    </table>
</body>
</html>