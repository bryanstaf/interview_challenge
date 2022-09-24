<?php

if(isset($_POST['search']))
{
$code=$_POST['code'];

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>transactions</title>
</head>
<body class="container">

    <style>
        .overflow{
            overflow-x: scroll;
        }
    </style>

    <div class="row">
    <form class="col mt-2 text-center" action="./transactions.php" method='post'> 
        <h2 class="">Search Transactions</h2>
        <input name="code" class="w-100" type="text" placeholder="Type the session id"> 
        <button name='search' class="btn btn-primary mt-1" type="submit">Search</button>
    </form>
    </div>
    <div class="col">
        <?php
            include "./db_conn.php";
            $sess_id= $code;
            $pdo= conexion();
            
            $row = $pdo->query('SELECT * FROM transactions WHERE sess_id="'.$sess_id.'"')->fetchAll();  
            $len= sizeof($row);
            if($len==0) echo "<div class='row'><div class='col mb-2 mt-2 '>No se encontraron resultados</div></div>";
            else{
                foreach ($row as $r){
                    echo "<div class='row'><div class='col mb-2 mt-2 '><b> Transaction ID: ".$r[0]."</b></div></div>
                    <div class='row'><div class='col overflow'>$r[1]</div></div>";
                    echo "<div class='row'><div class='col mb-2 mt-2'><b> Price ID: ".$r[2]."</b></div></div>
                    <div class='row'><div class='col overflow'>$r[3]</div></div>";
                    echo "<div class='row'><div class='col mb-2 mt-2'><b> Product ID: ".$r[4]."</b></div></div>
                    <div class='row'><div class='col overflow'>$r[5]</div></div>";
                    echo "<div class='row'><div class='col mb-2 mt-2'><b> Time: ".$r[6]."</b></div></div>";
                }
            }
        ?>
    </div>
    </div>
</body>
</html>