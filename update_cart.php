<?php
include('admin/database.php');

session_start();

$user_id = null;
if (isset($_SESSION['user_email'])) {
    $user_id = $_SESSION['user_email'];
} else {
    $user_id = session_id();
}

$cart_query = "SELECT * from temp_cart where user_id='$user_id'";
$cart_products = db::getRecords($cart_query);

if ($cart_products != NULL) {
    foreach ($cart_products as $cart_product) {
        $product_id = $cart_product['product_id'];

        $product_query = "SELECT * from product where id = '$product_id'";
        $product = db::getRecord($product_query);

        $images_query = "SELECT * FROM product_image where product_id = '$product_id'";
        $images = db::getRecord($images_query);

        echo "<div class='product'>
            <div class='product-details'>
                <h4 class='product-title'>
                    <a href='product_details.php?product_id='" . $product['id'] . "'>" . $product['name'] . "</a>
                </h4>
                <span class='cart-product-info'>
                    <span class='cart-product-qty'>1</span> : $" . $product['price'] .
            "</span>
            </div>

            <figure class='product-image-container'>
                <a href='product_details.php?product_id='" . $product['id'] . "class='product-image'>
                    <img src='admin/Images/Products/" . $images['product_images'] . "' alt='product' width='80' height='80'>
                </a>
            </figure>
            </div>";
    }
} else {
    echo "no items in the cart";
}
