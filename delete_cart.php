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


$query = "DELETE FROM temp_cart WHERE product_id = '$product_id'";
$rec2 = db::query($query);

if ($rec2 == NULL) {
    echo "Hi";
}
