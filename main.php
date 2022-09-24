<?php
include "./db_conn.php";
require_once('vendor/autoload.php');
$stripe = new \Stripe\StripeClient("sk_test_51LjwkyE3Usx2gslgAa8tCL7G8qaoWtIPN75WwYaTTq1eDkQ4nqANhUe3knFxAgKkePMraUrYpwEVvgMht4veuEUx008YpcP0oX");

# retrieve the data from frontend
if(isset($_POST["pay_button"])){
    #Product details
    $prod_price= (int)$_REQUEST["prod_price"];
    $prod_price*=100;
    $prod_quantity= (int)$_REQUEST["prod_quantity"];
    $prod_name= $_REQUEST["prod_name"];
    $amount = $prod_price*$prod_quantity;

    $currency= $_REQUEST["currency"];
    $method= $_REQUEST["method"];
    $card_number= $_REQUEST["card_number"];
    $expiration= $_REQUEST["expiration"];
    $cvc= $_REQUEST["cvc"];
}
echo "unit ".$prod_price."monto: ";
echo "prod_quantity ".$prod_quantity;
echo "amount ".$amount;
echo "currency ".$currency;
echo "prod_name".$prod_name;

$product=null;
$prod_exist=FALSE;
#list all the products
$list_prods=$stripe->products->all([]);

foreach($list_prods as $l){
    if($l->name==$prod_name){
        $product= $l;
        $prod_exist=TRUE;
        break;
    }
}
if($prod_exist==FALSE){
    #Create a new product if doesn't exist
    $product = $stripe->products->create([
        'name' => $prod_name,
        'description' => $prod_name,
    ]);
} 


$price=null;
$price_exist=FALSE;
#list all the prices
$list_prices=$stripe->prices->all([]);
foreach($list_prices as $l){
    if($l->product==$product->id && $l->unit_amount == $prod_price){
        $price= $l;
        $price_exist= TRUE;
        break;
    }
}

if($price_exist==FALSE){
    #create the price object
    $price = $stripe->prices->create([
        'unit_amount' => $prod_price,
        'currency' => $currency,
        'product' => $product->id,
    ]);
}

echo ' price '.$price->id;

//create a session object
try{
    $session = $stripe->checkout->sessions->create([
        'success_url' => 'http://localhost/interview/success.php',
        'cancel_url' => 'http://localhost/interview/cancel.html',
        'line_items' => [
            [
                'price' => $price->id,
                'quantity' => $prod_quantity,
            ],
        ],
        'mode' => 'payment',
    ]);

#storage the transaction code in a mysql database
date_default_timezone_set('America/Lima');
$dt = new DateTime(); 
$now= $dt->format("Y-m-d h:i:s A");

$pdo= conexion();

$query= " INSERT INTO transactions (prod_id, prod_json, price_id, 
    price_json, sess_id, sess_json, date) VALUES (?,?,?,?,?,?,?)";

$stmt= $pdo->prepare($query)->execute([ 
    $product->id, $product, $price->id, $price, $session->id, $session, $now
]);

}catch(Exception $e) {  
    #$api_error = $e->getMessage();
    echo 'Errorrr',$e->getMessage();
}


header("Location: success.php")

?>