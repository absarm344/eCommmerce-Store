<?php
include("header.php");


$cart_query = "SELECT * from temp_cart";
$cart_products = db::getRecords($cart_query);

$user_query = "SELECT * from user_login where email = '$user_id'";
$user = db::getRecord($user_query);

$total_price = 0;


?>

<script>
    function delete_cart_product(id) {
        var product_id = id;
        $.ajax({
            url: "delete_cart.php",
            type: "POST",
            data: "product_id=" + product_id,
            success: function(response) {
                //alert(response);
                // $("#product_detail").html(response);
                update_cart();
                location.reload(true);
            },
        });
    }
</script>

<section>
    <main class="main">
        <div class="container">
            <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
                <li class="active">
                    <a href="cart.html">Shopping Cart</a>
                </li>
                <li>
                    <a href="checkout.php">Checkout</a>
                </li>
                <li class="disabled">
                    <a href="cart.php">Order Complete</a>
                </li>
            </ul>

            <div class="row">
                <div class="col-lg-8">
                    <div class="cart-table-container">
                        <table class="table table-cart">
                            <thead>
                                <tr>
                                    <th class="thumbnail-col"></th>
                                    <th class="product-col">Product</th>
                                    <th class="price-col">Price</th>
                                    <th class="qty-col">Quantity</th>
                                    <th class="text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="product-row">
                                    <?php
                                    if ($cart_products != NULL) {
                                        foreach ($cart_products as $cart_product) {
                                            if ($cart_product['product_id'] != NULL) {

                                                $cart_id = $cart_product['product_id'];
                                                $product_query = "SELECT * from product where id = '$cart_id'";
                                                $product = db::getRecord($product_query);

                                                $temp = $product['id'];
                                                $images_query = "SELECT * FROM product_image where product_id = $temp";
                                                $image = db::getRecord($images_query);

                                                $product_id = $cart_product['product_id'];

                                                $total_price = $total_price + $product['price'];
                                    ?>
                                                <td>
                                                    <figure class="product-image-container">
                                                        <a href=<?php echo "product_details.php?product_id=" . $product['id'] ?>>
                                                            <img src="<?php echo "admin/Images/Products/" . $image['product_images']; ?>" width="205" height="205" alt="product" />
                                                        </a>

                                                        <a onclick="delete_cart_product(id = <?php echo $product_id; ?>)" class="btn-remove icon-cancel" title="Remove Product"></a>
                                                    </figure>
                                                </td>
                                                <td class="product-col">
                                                    <h5 class="product-title">
                                                        <a href="<?php echo "product_details.php?product_id=" . $product['id'] ?>"><?php echo $product['name']; ?></a>
                                                    </h5>
                                                </td>
                                                <td>$<?php echo $product['price']; ?></td>
                                                <td>
                                                    <div class="product-single-qty">
                                                        <input class="horizontal-quantity form-control" type="text">
                                                    </div><!-- End .product-single-qty -->
                                                </td>
                                                <td class="text-right"><span class="subtotal-price">$<?php echo $product['price']; ?></span></td>
                                </tr>
                    <?php
                                            }
                                        }
                                    }
                    ?>

                            </tbody>


                            <tfoot>
                                <tr>
                                    <td colspan="5" class="clearfix">
                                        <div class="float-left">
                                            <div class="cart-discount">
                                                <form action="#">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control form-control-sm" placeholder="Coupon Code" required>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-sm" type="submit">Apply
                                                                Coupon</button>
                                                        </div>
                                                    </div><!-- End .input-group -->
                                                </form>
                                            </div>
                                        </div><!-- End .float-left -->

                                        <div class="float-right">
                                            <button type="submit" class="btn btn-shop btn-update-cart">
                                                Update Cart
                                            </button>
                                        </div><!-- End .float-right -->
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- End .cart-table-container -->
                </div><!-- End .col-lg-8 -->

                <div class="col-lg-4">
                    <div class="cart-summary">
                        <h3>CART TOTALS</h3>

                        <table class="table table-totals">
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>$<?php echo $total_price; ?></td>
                                </tr>

                                <tr>
                                    <td colspan="2" class="text-left">
                                        <h4>Shipping</h4>

                                        <div class="form-group form-group-custom-control">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="radio" checked>
                                                <label class="custom-control-label">Local pickup</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .form-group -->

                                        <div class="form-group form-group-custom-control mb-0">
                                            <div class="custom-control custom-radio mb-0">
                                                <input type="radio" name="radio" class="custom-control-input">
                                                <label class="custom-control-label">Flat rate</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .form-group -->
                                    </td>
                                </tr>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td>Total</td>
                                    <td>$<?php echo $total_price;
                                            $_SESSION['total_price'] =  $total_price;
                                            ?></td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="checkout-methods">
                            <a href="checkout.php" class="btn btn-block btn-dark">Proceed to Checkout
                                <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div><!-- End .cart-summary -->
                </div><!-- End .col-lg-4 -->
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-6"></div><!-- margin -->
    </main><!-- End .main -->

</section>


<?php
include("footer.php");

?>