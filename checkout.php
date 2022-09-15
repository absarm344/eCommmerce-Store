<?php
include('header.php');
$is_page_refreshed = (isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] == 'max-age=0');

$cart_query = "SELECT * from temp_cart";
$carts = db::getRecords($cart_query);


$user_query = "SELECT * from user_login where email = '$user_id'";
$user = db::getRecord($user_query);

if ($user == NULL) {
    $user['fname'] = null;
    $user['lname'] = null;
    $user['email'] = null;
    $user['city'] = null;
    $user['phone_no'] = null;
} else if (isset($_SESSION['user_email'])) {
    $user_id = $_SESSION['user_email'];
} else {
    $user_id = session_id();
}


$_SESSION['user_id'] = $user_id;

//generating order id

$order_id = rand(10, 100000);

$query = "SELECT * from orders WHERE order_id='$order_id'";
$order = db::getRecord($query);

$_SESSION["order_id"] = $order_id;

if ($order != NULL) {
    while ($order != NULL) {
        $order_id = rand(10, 100000);

        $query = "SELECT * from orders WHERE order_id='$order_id'";
        $order = db::getRecord($query);
    }
}

echo $_SESSION['total_price'];
$total_price = 0;

?>

<section>
    <main class="main main-test">
        <div class="container checkout-container">
            <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
                <li>
                    <a href="cart.php">Shopping Cart</a>
                </li>
                <li class="active">
                    <a href="checkout.php">Checkout</a>
                </li>
                <li class="disabled">
                    <a href="#">Order Complete</a>
                </li>
            </ul>

            <div class="login-form-container">
                <h4>Returning customer?
                    <button data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="btn btn-link btn-toggle">Login</button>
                </h4>

                <div id="collapseOne" class="collapse">
                    <div class="login-section feature-box">
                        <div class="feature-box-content">
                            <form action="" method="post" id="login-form">
                                <p>
                                    If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing & Shipping section.
                                </p>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mb-0 pb-1">Username or email <span class="required">*</span></label>
                                            <input name="user_email" type="email" class="form-control" required />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="mb-0 pb-1">Password <span class="required">*</span></label>
                                            <input name="user_password" type="password" class="form-control" required />
                                        </div>
                                    </div>
                                </div>

                                <button name="user_login" type="submit" class="btn">LOGIN</button>

                                <div class="form-footer mb-1">
                                    <div class="custom-control custom-checkbox mb-0 mt-0">
                                        <input type="checkbox" class="custom-control-input" id="lost-password" />
                                        <label class="custom-control-label mb-0" for="lost-password">Remember
                                            me</label>
                                    </div>

                                    <a href="forgot_password.php" class="forget-password">Lost your password?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="checkout-discount">
                <h4>Have a coupon?
                    <button data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne" class="btn btn-link btn-toggle">ENTER YOUR CODE</button>
                </h4>

                <div id="collapseTwo" class="collapse">
                    <div class="feature-box">
                        <div class="feature-box-content">
                            <p>If you have a coupon code, please apply it below.</p>

                            <form action="#">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm w-auto" placeholder="Coupon code" required="" />
                                    <div class="input-group-append">
                                        <button class="btn btn-sm mt-0" type="submit">
                                            Apply Coupon
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-7">
                    <ul class="checkout-step">
                        <li>
                            <h2 class="step-title">Billing details</h2>

                            <form action="" id="form" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First name
                                                <abbr class="required" title="required">*</abbr>
                                            </label>

                                            <input require name="fname" type="text" class="form-control" value="<?php echo $user['fname']; ?>" placeholder="First Name" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last name
                                                <abbr class="required" title="required">*</abbr></label>
                                            <input require name="lname" type="text" class="form-control" value="<?php echo $user['lname']; ?>" placeholder="Last Name" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Countries dropown  -->
                                <div class="form-group mb-1 pb-2">
                                    <label>Country / Region
                                        <select name="country" class="form-control" id="country">
                                            <option value="0" label="Select a country ... " selected="selected">Select a country ... </option>
                                            <optgroup id="country-optgroup-Asia" label="Asia">
                                                <option value="AF" label="Afghanistan">Afghanistan</option>
                                                <option value="AM" label="Armenia">Armenia</option>
                                                <option value="AZ" label="Azerbaijan">Azerbaijan</option>
                                                <option value="BH" label="Bahrain">Bahrain</option>
                                                <option value="BD" label="Bangladesh">Bangladesh</option>
                                                <option value="BT" label="Bhutan">Bhutan</option>
                                                <option value="BN" label="Brunei">Brunei</option>
                                                <option value="KH" label="Cambodia">Cambodia</option>
                                                <option value="CN" label="China">China</option>
                                                <option value="GE" label="Georgia">Georgia</option>
                                                <option value="HK" label="Hong Kong SAR China">Hong Kong SAR China</option>
                                                <option value="IN" label="India">India</option>
                                                <option value="ID" label="Indonesia">Indonesia</option>
                                                <option value="IR" label="Iran">Iran</option>
                                                <option value="IQ" label="Iraq">Iraq</option>
                                                <option value="IL" label="Israel">Israel</option>
                                                <option value="JP" label="Japan">Japan</option>
                                                <option value="JO" label="Jordan">Jordan</option>
                                                <option value="KZ" label="Kazakhstan">Kazakhstan</option>
                                                <option value="KW" label="Kuwait">Kuwait</option>
                                                <option value="KG" label="Kyrgyzstan">Kyrgyzstan</option>
                                                <option value="LA" label="Laos">Laos</option>
                                                <option value="LB" label="Lebanon">Lebanon</option>
                                                <option value="MO" label="Macau SAR China">Macau SAR China</option>
                                                <option value="MY" label="Malaysia">Malaysia</option>
                                                <option value="MV" label="Maldives">Maldives</option>
                                                <option value="MN" label="Mongolia">Mongolia</option>
                                                <option value="MM" label="Myanmar [Burma]">Myanmar [Burma]</option>
                                                <option value="NP" label="Nepal">Nepal</option>
                                                <option value="NT" label="Neutral Zone">Neutral Zone</option>
                                                <option value="KP" label="North Korea">North Korea</option>
                                                <option value="OM" label="Oman">Oman</option>
                                                <option value="PK" label="Pakistan">Pakistan</option>
                                                <option value="PS" label="Palestinian Territories">Palestinian Territories</option>
                                                <option value="YD" label="People's Democratic Republic of Yemen">People's Democratic Republic of Yemen</option>
                                                <option value="PH" label="Philippines">Philippines</option>
                                                <option value="QA" label="Qatar">Qatar</option>
                                                <option value="SA" label="Saudi Arabia">Saudi Arabia</option>
                                                <option value="SG" label="Singapore">Singapore</option>
                                                <option value="KR" label="South Korea">South Korea</option>
                                                <option value="LK" label="Sri Lanka">Sri Lanka</option>
                                                <option value="SY" label="Syria">Syria</option>
                                                <option value="TW" label="Taiwan">Taiwan</option>
                                                <option value="TJ" label="Tajikistan">Tajikistan</option>
                                                <option value="TH" label="Thailand">Thailand</option>
                                                <option value="TL" label="Timor-Leste">Timor-Leste</option>
                                                <option value="TR" label="Turkey">Turkey</option>
                                                <option value="TM" label="Turkmenistan">Turkmenistan</option>
                                                <option value="AE" label="United Arab Emirates">United Arab Emirates</option>
                                                <option value="UZ" label="Uzbekistan">Uzbekistan</option>
                                                <option value="VN" label="Vietnam">Vietnam</option>
                                                <option value="YE" label="Yemen">Yemen</option>
                                            </optgroup>
                                        </select>

                                </div>

                                <div class="form-group mb-1 pb-2">
                                    <label>Street address
                                        <abbr class="required" title="required">*</abbr></label>
                                    <input require name="address1" type="text" class="form-control" placeholder="House number and street name" />
                                </div>

                                <div class="form-group">
                                    <input name="address2" type="text" class="form-control" placeholder="Apartment, suite, unite, etc. (optional)" />
                                </div>

                                <div class="form-group">
                                    <label>Town / City
                                        <abbr class="required" title="required">*</abbr></label>
                                    <input require name="city" type="text" class="form-control" value="<?php echo $user['city']; ?>" placeholder="City Name" />
                                </div>

                                <div class="form-group">
                                    <label>Postcode / Zip
                                        <abbr class="required" title="required">*</abbr></label>
                                    <input require name="zip" type="text" class="form-control" placeholder="Area's ZIP code" />
                                </div>

                                <div class="form-group">
                                    <label>Phone <abbr class="required" title="required">*</abbr></label>
                                    <input name="phone_no" type="tel" class="form-control" value="<?php echo $user['phone_no']; ?>" placeholder="Phone Number" />
                                </div>

                                <div class="form-group">
                                    <label>Email address
                                        <abbr class="required" title="required">*</abbr></label>
                                    <input require name="user_email" type="email" class="form-control" value="<?php echo $user['email']; ?>" placeholder="Email Address" />
                                </div>

                                <div class="form-group">
                                    <label class="order-comments">Order notes (optional)</label>
                                    <textarea name="description" class="form-control" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                </div>

                                <input type="hidden" name="order_id" class="custom-control-input" value="<?php echo $order_id; ?>" />
                                <!------------------------------------------------For paypal-------------------------------------------------->
                                <input type="hidden" name="cmd" value="_xclick" />
                                <input type="hidden" name="no_note" value="1" />
                                <input type="hidden" name="lc" value="USD" />
                                <input type="hidden" name="currency_code" value="USD" />
                                <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
                                <input type="hidden" name="first_name" value="Customer's First Name" />
                                <input type="hidden" name="last_name" value="Customer's Last Name" />
                                <input type="hidden" name="payer_email" value="customer@example.com" />
                                <input type="hidden" name="item_number" value="123456" />
                                <!------------------------------------------------For paypal-------------------------------------------------->


                        </li>
                    </ul>
                </div>
                <!-- End .col-lg-8 -->

                <div class="col-lg-5">
                    <div class="order-summary">
                        <h3>YOUR ORDER</h3>

                        <table class="table table-mini-cart">
                            <thead>
                                <tr>
                                    <th colspan="2">Product</th>
                                </tr>
                            </thead>
                            <?php
                            if ($carts != NULL) {
                                foreach ($carts as $cart) {
                                    $product_id = $cart['product_id'];
                                    $query1 = "SELECT * from product where id = '$product_id'";
                                    $product = db::getRecord($query1);
                                    $total_price = $total_price + $product['price'];
                                    $_SESSION['total_price'] = $total_price;
                            ?>
                                    <tbody>

                                        <tr>
                                            <td class="product-col">
                                                <h3 class="product-title">
                                                    <?php echo $product['name']; ?> ×
                                                    <span class="product-qty">1</span>
                                                </h3>
                                            </td>

                                            <td class="price-col">
                                                <span>$<?php echo $product['price']; ?></span>
                                            </td>
                                        </tr>
                                    </tbody>

                            <?php
                                }
                            }
                            ?>
                            <tfoot>
                                <tr class="cart-subtotal">
                                    <td>
                                        <h4>Subtotal</h4>
                                    </td>

                                    <td class="price-col">
                                        <span>$<?php echo $total_price; ?></span>
                                    </td>
                                </tr>
                                <tr class="order-shipping">
                                    <td class="text-left" colspan="2">
                                        <h4 class="m-b-sm">Shipping</h4>

                                        <div class="form-group form-group-custom-control">
                                            <div class="custom-control custom-radio d-flex">
                                                <input type="radio" class="custom-control-input" name="radio" checked />
                                                <label class="custom-control-label">Local Pickup</label>
                                            </div>
                                            <!-- End .custom-checkbox -->
                                        </div>
                                        <!-- End .form-group -->

                                        <div class="form-group form-group-custom-control mb-0">
                                            <div class="custom-control custom-radio d-flex mb-0">
                                                <input type="radio" name="radio" class="custom-control-input">
                                                <label class="custom-control-label">Flat Rate</label>
                                            </div>
                                            <!-- End .custom-checkbox -->
                                        </div>
                                        <!-- End .form-group -->
                                    </td>

                                </tr>

                                <tr class="order-total">
                                    <td>
                                        <h4>Total</h4>
                                    </td>
                                    <td>
                                        <b class="total-price"><span>$<?php echo $total_price; ?></span></b>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="payment-methods">
                            <h4 class="">Payment methods</h4>

                            <label>Payment Method <span class="required">*</span></label>
                            <select class="form-control" name="payment_method" id="payment_method" required>
                                <option value="1" selected>PayPal</option>
                                <option value="2">Credit / Debit Card</option>
                            </select>
                        </div>

                    </div>

                    <button type="submit" onclick="payment_type()" name="order_submit" class=" btn btn-dark btn-md w-100 mr-0">
                        Place Order
                    </button>
                    <?php

                    if ($is_page_refreshed) {
                        echo "<script>location='checkout.php'</script>";
                    } else {
                        if (isset($_GET["status"])) {
                            $status = $_GET["status"];
                            if ($status == 2) {


                    ?>
                                <script>
                                    swal("Invalid Information!", "Try Again!", "error");
                                </script>
                            <?php
                            } elseif ($status == 3) {

                            ?>
                                <script>
                                    swal("Your order has been placed!", "Thanks for shopping with us!", "success");
                                </script>

                    <?php
                            }
                        }
                    }
                    ?>

                </div>
                <!-- End .cart-summary -->
            </div>
            <!-- End .col-lg-4 -->
        </div>
        </form>
        <!-- End .row -->
        </div>
        <!-- End .container -->
    </main>
    <!-- End .main -->
</section>


<?php
include('footer.php');
?>
<script>
    function payment_type() {
        var test = $('#payment_method').val();

        if (test == 2) {

            $("#form").submit(function(e) {
                this.action = "Stripe/index.php";
            });
        }

        if (test == 1) {
            $("#form").submit(function(e) {
                this.action = "Paypal/payments.php";
            });
        }

    }
</script>