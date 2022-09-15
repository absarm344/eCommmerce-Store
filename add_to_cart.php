<?php
include("admin/database.php");
session_start();

$product_id = $_POST['product_id'];

if (isset($_SESSION['user_email'])) {
    $user_id = $_SESSION['user_email'];
} else {
    $user_id = session_id();
}

$product_query = "SELECT * from product where id = '$product_id'";
$rec = db::getRecord($product_query);
$price = $rec['price'];

$query = "INSERT into temp_cart (user_id,product_id,price) VALUES ('$user_id','$product_id','$price')";
$rec2 = db::insertRecord($query);
if ($rec2 != NULL) {

    echo "Product has been added to cart";
}
