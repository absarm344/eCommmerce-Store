<?php
include("header.php");

$product_id = $_GET['product_id'];
$product_query = "SELECT * FROM product where id = $product_id  ";
$product = db::getRecord($product_query);

$category_name = $product['category_id'];
$query2 = "SELECT * FROM category where id = '$category_name'";
$rec = db::getRecord($query2);
$category_name = $rec['category'];

$subcategory_name = $product['subcategory_id'];
if ($subcategory_name != 0) {
    $query = "SELECT * FROM sub_category where id = '$subcategory_name'";
    $rec2 = db::getRecord($query);
    $subcategory_name = $rec2['subcategory'];
} else {
    $subcategory_name = "None";
}

$images_query = "SELECT * FROM product_image where product_id = $product_id ";
$images = db::getRecords($images_query);

$user_query = "SELECT * from user_login where email = '$user_id'";
$user = db::getRecord($user_query);

?>
<script>
    function add_cart(id) {
        var product_id = id;
        $.ajax({
            url: "add_to_cart.php",
            type: "POST",
            data: "product_id=" + product_id,
            success: function(response) {
                // $("#product_detail").html(response);
                swal("Product has been added!", "Browse for more!", "success");
                update_cart();
            },
        });
    }
</script>

<section>
    <main class="main bg-gray">
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
            <div class="container-fluid">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href=index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="demo18-shop.html">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                </ol>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 main-content product-sidebar-right mb-0">
                    <div class="product-single-container product-single-default">
                        <div class="cart-message d-none">
                            <strong class="single-cart-notice">“<?php echo $product['name']; ?>"</strong>
                            <span>has been added to your cart.</span>
                        </div>

                        <div class="row">
                            <div class="col-md-6 product-single-gallery">
                                <div class="product-slider-container">
                                    <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                                        <?php
                                        if ($images != NULL) {
                                            foreach ($images as $image) {
                                        ?>
                                                <div class="product-item">
                                                    <img class="product-single-image" src=" <?php echo "admin/Images/Products/" . $image['product_images']; ?>" data-zoom-image="<?php echo "admin/Images/Products/" . $image['product_images']; ?>" width="468" height="468" alt="product" />
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <!-- End .product-single-carousel -->
                                    <span class="prod-full-screen">
                                        <i class="icon-plus"></i>
                                    </span>
                                </div>

                                <div class="prod-thumbnail owl-dots">
                                    <?php
                                    if ($images != NULL) {
                                        foreach ($images as $image) {
                                    ?>
                                            <div class="owl-dot">
                                                <img src="<?php echo "admin/Images/Products/" . $image['product_images']; ?>" width="110" height="110" alt="product-thumbnail" />
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-- End .product-single-gallery -->

                            <div id="product_detail" class="col-md-6 product-single-details">
                                <h1 class="product-title"><?php echo $product['name']; ?></h1>

                                <div class="product-nav">
                                    <div class="product-prev">
                                        <a href="#">
                                            <span class="product-link"></span>

                                            <span class="product-popup">
                                                <span class="box-content">
                                                    <img alt="product" width="150" height="150" src="<?php echo "admin/Images/Products/" . $product['product_image']; ?>" style="padding-top: 0px;">

                                                    <span>Hot Black Suits</span>
                                                </span>
                                            </span>
                                        </a>
                                    </div>

                                    <div class="product-next">
                                        <a href="#">
                                            <span class="product-link"></span>

                                            <span class="product-popup">
                                                <span class="box-content">
                                                    <img alt="product" width="150" height="150" src="assets/images/demoes/demo18/products/product-3.jpg" style="padding-top: 0px;">

                                                    <span>Long-Length 2.0</span>
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                </div>

                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:60%"></span>
                                        <!-- End .ratings -->
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                    <!-- End .product-ratings -->

                                    <a href="#" class="rating-link">( <?php echo $product['review']; ?> Reviews )</a>
                                </div>
                                <!-- End .ratings-container -->

                                <hr class="short-divider">

                                <div class="price-box">
                                    <span class="old-price">$<?php echo $product['price']; ?></span>
                                    <span class="new-price">$<?php echo $product['price']; ?></span>
                                </div>
                                <!-- End .price-box -->

                                <div class="product-desc">
                                    <p>
                                        Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris
                                        placerat eleifend leo.
                                    </p>
                                </div>
                                <!-- End .product-desc -->

                                <ul class="single-info-list">
                                    <!---->
                                    <li>
                                        SKU:
                                        <strong><?php echo $product['sku']; ?></strong>
                                    </li>

                                    <li>
                                        CATEGORY:
                                        <strong>
                                            <a href="#" class="product-category"><?php echo $category_name; ?></a>
                                        </strong>
                                    </li>

                                    <li>
                                        TAGs:
                                        <strong><a href="#" class="product-category"><?php echo $subcategory_name; ?></a></strong>,
                                    </li>

                                </ul>

                                <div class="">
                                    <div class="product-single-qty">
                                        <input class="horizontal-quantity form-control" type="text">
                                    </div>
                                    <!-- End .product-single-qty -->

                                    <a style="color: white;" id="cart_btn" onclick="add_cart(id = <?php echo $product_id; ?>)" class="btn btn-dark icon-shopping-cart mr-2" title="Add to Cart"> Add to Cart</a>



                                    <a href="#" class="btn btn-gray view-cart d-none">View cart</a>
                                </div>
                                <!-- End .product-action -->

                                <hr class="divider mb-0 mt-0">

                                <div class="product-single-share mb-2">
                                    <label class="sr-only">Share:</label>

                                    <div class="social-icons mr-2">
                                        <a href="#" class="social-icon social-facebook icon-facebook" target="_blank" title="Facebook"></a>
                                        <a href="#" class="social-icon social-twitter icon-twitter" target="_blank" title="Twitter"></a>
                                        <a href="#" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank" title="Linkedin"></a>
                                        <a href="#" class="social-icon social-gplus fab fa-google-plus-g" target="_blank" title="Google +"></a>
                                        <a href="#" class="social-icon social-mail icon-mail-alt" target="_blank" title="Mail"></a>
                                    </div>
                                    <!-- End .social-icons -->

                                    <a href="wishlist.html" class="btn-icon-wish add-wishlist" title="Add to Wishlist"><i class="icon-wishlist-2"></i><span>Add to
                                            Wishlist</span></a>
                                </div>
                                <!-- End .product single-share -->
                            </div>
                            <!-- End .product-single-details -->
                        </div>
                        <!-- End .row -->
                    </div>
                    <!-- End .product-single-container -->

                    <div class="product-single-tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="true">Description</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="product-tab-size" data-toggle="tab" href="#product-size-content" role="tab" aria-controls="product-size-content" aria-selected="true">Size Guide</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="product-tab-tags" data-toggle="tab" href="#product-tags-content" role="tab" aria-controls="product-tags-content" aria-selected="false">Additional
                                    Information</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content" role="tab" aria-controls="product-reviews-content" aria-selected="false">Reviews (<?php echo $product['review']; ?>)</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
                                <div class="product-desc-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, nostrud ipsum consectetur sed do, quis nostrud exercitation ullamco
                                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.</p>
                                    <ul>
                                        <li>Any Product types that You want - Simple, Configurable
                                        </li>
                                        <li>Downloadable/Digital Products, Virtual Products
                                        </li>
                                        <li>Inventory Management with Backordered items
                                        </li>
                                    </ul>
                                    <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                                </div>
                                <!-- End .product-desc-content -->
                            </div>
                            <!-- End .tab-pane -->

                            <div class="tab-pane fade" id="product-size-content" role="tabpanel" aria-labelledby="product-tab-size">
                                <div class="product-size-content">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="assets/images/products/single/body-shape.png" alt="body shape">
                                        </div>
                                        <!-- End .col-md-4 -->

                                        <div class="col-md-8">
                                            <table class="table table-size">
                                                <thead>
                                                    <tr>
                                                        <th>SIZE</th>
                                                        <th>CHEST (in.)</th>
                                                        <th>WAIST (in.)</th>
                                                        <th>HIPS (in.)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>XS</td>
                                                        <td>34-36</td>
                                                        <td>27-29</td>
                                                        <td>34.5-36.5</td>
                                                    </tr>
                                                    <tr>
                                                        <td>S</td>
                                                        <td>36-38</td>
                                                        <td>29-31</td>
                                                        <td>36.5-38.5</td>
                                                    </tr>
                                                    <tr>
                                                        <td>M</td>
                                                        <td>38-40</td>
                                                        <td>31-33</td>
                                                        <td>38.5-40.5</td>
                                                    </tr>
                                                    <tr>
                                                        <td>L</td>
                                                        <td>40-42</td>
                                                        <td>33-36</td>
                                                        <td>40.5-43.5</td>
                                                    </tr>
                                                    <tr>
                                                        <td>XL</td>
                                                        <td>42-45</td>
                                                        <td>36-40</td>
                                                        <td>43.5-47.5</td>
                                                    </tr>
                                                    <tr>
                                                        <td>XLL</td>
                                                        <td>45-48</td>
                                                        <td>40-44</td>
                                                        <td>47.5-51.5</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- End .row -->
                                </div>
                                <!-- End .product-size-content -->
                            </div>
                            <!-- End .tab-pane -->

                            <div class="tab-pane fade" id="product-tags-content" role="tabpanel" aria-labelledby="product-tab-tags">
                                <table class="table table-striped mt-2">
                                    <tbody>
                                        <tr>
                                            <th>Weight</th>
                                            <td>23 kg</td>
                                        </tr>

                                        <tr>
                                            <th>Dimensions</th>
                                            <td>12 × 24 × 35 cm</td>
                                        </tr>

                                        <tr>
                                            <th>Color</th>
                                            <td>Black, Green, Indigo</td>
                                        </tr>

                                        <tr>
                                            <th>Size</th>
                                            <td>Large, Medium, Small</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End .tab-pane -->

                            <div class="tab-pane fade" id="product-reviews-content" role="tabpanel" aria-labelledby="product-tab-reviews">
                                <div class="product-reviews-content">
                                    <h3 class="reviews-title">1 review for Men Black Sports Shoes</h3>

                                    <div class="comment-list">
                                        <div class="comments">
                                            <figure class="img-thumbnail">
                                                <img src="assets/images/blog/author.jpg" alt="author" width="80" height="80">
                                            </figure>

                                            <div class="comment-block">
                                                <div class="comment-header">
                                                    <div class="comment-arrow"></div>

                                                    <div class="ratings-container float-sm-right">
                                                        <div class="product-ratings">
                                                            <span class="ratings" style="width:60%"></span>
                                                            <!-- End .ratings -->
                                                            <span class="tooltiptext tooltip-top"></span>
                                                        </div>
                                                        <!-- End .product-ratings -->
                                                    </div>

                                                    <span class="comment-by">
                                                        <strong>Joe Doe</strong> – April 12, 2018
                                                    </span>
                                                </div>

                                                <div class="comment-content">
                                                    <p>Excellent.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="divider"></div>

                                    <div class="add-product-review">
                                        <h3 class="review-title">Add a review</h3>

                                        <form action="#" class="comment-form m-0">
                                            <div class="rating-form">
                                                <label for="rating">Your rating <span class="required">*</span></label>
                                                <span class="rating-stars">
                                                    <a class="star-1" href="#">1</a>
                                                    <a class="star-2" href="#">2</a>
                                                    <a class="star-3" href="#">3</a>
                                                    <a class="star-4" href="#">4</a>
                                                    <a class="star-5" href="#">5</a>
                                                </span>

                                                <select name="rating" id="rating" required="" style="display: none;">
                                                    <option value="">Rate…</option>
                                                    <option value="5">Perfect</option>
                                                    <option value="4">Good</option>
                                                    <option value="3">Average</option>
                                                    <option value="2">Not that bad</option>
                                                    <option value="1">Very poor</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Your review <span class="required">*</span></label>
                                                <textarea cols="5" rows="6" class="form-control form-control-sm"></textarea>
                                            </div>
                                            <!-- End .form-group -->


                                            <div class="row">
                                                <div class="col-md-6 col-xl-12">
                                                    <div class="form-group">
                                                        <label>Name <span class="required">*</span></label>
                                                        <input type="text" class="form-control form-control-sm" required>
                                                    </div>
                                                    <!-- End .form-group -->
                                                </div>

                                                <div class="col-md-6 col-xl-12">
                                                    <div class="form-group">
                                                        <label>Email <span class="required">*</span></label>
                                                        <input type="text" class="form-control form-control-sm" required>
                                                    </div>
                                                    <!-- End .form-group -->
                                                </div>

                                                <div class="col-12">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="save-name" />
                                                        <label class="custom-control-label mb-0" for="save-name">Save my
                                                            name, email, and website in this browser for the next
                                                            time I
                                                            comment.</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="submit" class="btn btn-primary" value="Submit">
                                        </form>
                                    </div>
                                    <!-- End .add-product-review -->
                                </div>
                                <!-- End .product-reviews-content -->
                            </div>
                            <!-- End .tab-pane -->
                        </div>
                        <!-- End .tab-content -->
                    </div>
                    <!-- End .product-single-tabs -->
                    <!-- End .product-single-tabs -->
                </div>
                <!-- End .col-lg-9 -->

                <div class="sidebar-overlay"></div>
                <div class="sidebar-toggle custom-sidebar-toggle"><i class="fas fa-sliders-h"></i></div>
                <aside class="sidebar-product col-lg-3 mobile-sidebar">
                    <div class="sidebar-wrapper">
                        <div class="widget widget-info">
                            <ul>
                                <li>
                                    <i class="icon-shipped"></i>
                                    <h4>FREE<br />SHIPPING</h4>
                                </li>
                                <li>
                                    <i class="icon-us-dollar"></i>
                                    <h4>100% MONEY<br />BACK GUARANTEE</h4>
                                </li>
                                <li>
                                    <i class="icon-online-support"></i>
                                    <h4>ONLINE<br />SUPPORT 24/7</h4>
                                </li>
                            </ul>
                        </div>

                        <div class="widget">
                            <div class="maga-sale-container custom-maga-sale-container">
                                <figure class="mega-image">
                                    <img src="assets/images/demoes/demo18/banners/banner-sidebar.jpg" class="w-100" alt="Banner Desc">
                                </figure>

                                <div class="mega-content">
                                    <div class="mega-price-box">
                                        <span class="price-big">50</span>
                                        <span class="price-desc"><em>%</em>OFF</span>
                                    </div>

                                    <div class="mega-desc">
                                        <h3 class="mega-title line-height-1 mb-1 ls-n-10">MEGA SALE</h3>
                                        <span class="mega-subtitle line-height-1">HURRY UP!</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End .widget -->

                        <div class="widget widget-featured">
                            <h3 class="widget-title">FEATURED</h3>

                            <div class="widget-body">
                                <div class="featured-col">
                                    <div class="product-default left-details product-widget">
                                        <figure>
                                            <a href="demo18-product.html">
                                                <img src="assets/images/demoes/demo18/products/small/product-1.jpg" width="75" height="75" alt="product" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h3 class="product-title"> <a href="demo18-product.html">Backpack Sfs
                                                    Responder</a> </h3>
                                            <div class="ratings-container">
                                                <div class="product-ratings">
                                                    <span class="ratings" style="width:100%"></span>
                                                    <!-- End .ratings -->
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                                <!-- End .product-ratings -->
                                            </div>
                                            <!-- End .product-container -->
                                            <div class="price-box">
                                                <span class="product-price">$185.00</span>
                                            </div>
                                            <!-- End .price-box -->
                                        </div>
                                        <!-- End .product-details -->
                                    </div>
                                    <div class="product-default left-details product-widget">
                                        <figure>
                                            <a href="demo18-product.html">
                                                <img src="assets/images/demoes/demo18/products/small/product-2.jpg" width="75" height="75" alt="product" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h3 class="product-title"> <a href="demo18-product.html">Hot Black
                                                    Suits</a> </h3>
                                            <div class="ratings-container">
                                                <div class="product-ratings">
                                                    <span class="ratings" style="width:80%"></span>
                                                    <!-- End .ratings -->
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                                <!-- End .product-ratings -->
                                            </div>
                                            <!-- End .product-container -->
                                            <div class="price-box">
                                                <span class="product-price">$30.00</span>
                                            </div>
                                            <!-- End .price-box -->
                                        </div>
                                        <!-- End .product-details -->
                                    </div>
                                    <div class="product-default left-details product-widget">
                                        <figure>
                                            <a href="demo18-product.html">
                                                <img src="assets/images/demoes/demo18/products/small/product-3.jpg" width="75" height="75" alt="product" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h3 class="product-title"> <a href="demo18-product.html">Long-Length
                                                    2.0</a> </h3>
                                            <div class="ratings-container">
                                                <div class="product-ratings">
                                                    <span class="ratings" style="width:75%"></span>
                                                    <!-- End .ratings -->
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                                <!-- End .product-ratings -->
                                            </div>
                                            <!-- End .product-container -->
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div>
                                            <!-- End .price-box -->
                                        </div>
                                        <!-- End .product-details -->
                                    </div>
                                </div>
                                <!-- End .featured-col -->
                            </div>
                            <!-- End .widget-body -->
                        </div>
                        <!-- End .widget -->
                    </div>
                </aside>
                <!-- End .col-md-3 -->
            </div>
            <!-- End .row -->

            <div class="products-section pt-0">
                <h2 class="section-title">Related Products</h2>

                <div class="products-slider owl-carousel owl-theme dots-top dots-small" data-owl-options="{ 
                        'responsive': {
                            '1200': {
                                'items': 5
                            }
                        } }">
                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="demo18-product.html">
                                <img src="assets/images/demoes/demo18/products/product-7.jpg" width="205" height="205" alt="product">
                            </a>
                            <div class="btn-icon-group">
                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i class="icon-shopping-cart"></i></a>
                            </div>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick
                                View</a>
                        </figure>
                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="demo18-shop.html" class="product-category">category</a>
                                </div>
                                <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i class="icon-heart"></i></a>
                            </div>
                            <h3 class="product-title">
                                <a href="demo18-product.html">Backpack Sfs Responder</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:100%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            <div class="price-box">
                                <span class="product-price">$185.00</span>
                            </div>
                            <!-- End .price-box -->
                        </div>
                        <!-- End .product-details -->
                    </div>
                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="demo18-product.html">
                                <img src="assets/images/demoes/demo18/products/product-15.jpg" width="205" height="205" alt="product">
                            </a>
                            <div class="btn-icon-group">
                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i class="icon-shopping-cart"></i></a>
                            </div>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick
                                View</a>
                        </figure>
                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="demo18-shop.html" class="product-category">category</a>
                                </div>
                                <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i class="icon-heart"></i></a>
                            </div>
                            <h3 class="product-title">
                                <a href="demo18-product.html">Converse Chuck Quarter</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            <div class="price-box">
                                <span class="product-price">$14.00</span>
                            </div>
                            <!-- End .price-box -->
                        </div>
                        <!-- End .product-details -->
                    </div>
                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="demo18-product.html">
                                <img src="assets/images/demoes/demo18/products/product-13.jpg" width="205" height="205" alt="product">
                            </a>
                            <div class="btn-icon-group">
                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i class="icon-shopping-cart"></i></a>
                            </div>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick
                                View</a>
                        </figure>
                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="demo18-shop.html" class="product-category">category</a>
                                </div>
                                <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i class="icon-heart"></i></a>
                            </div>
                            <h3 class="product-title">
                                <a href="demo18-product.html">Football Vapor 24/7</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            <div class="price-box">
                                <span class="product-price">$25.00</span>
                            </div>
                            <!-- End .price-box -->
                        </div>
                        <!-- End .product-details -->
                    </div>
                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="demo18-product.html">
                                <img src="assets/images/demoes/demo18/products/product-8.jpg" width="205" height="205" alt="product">
                            </a>
                            <div class="btn-icon-group">
                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i class="icon-shopping-cart"></i></a>
                            </div>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick
                                View</a>
                        </figure>
                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="demo18-shop.html" class="product-category">category</a>
                                </div>
                                <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i class="icon-heart"></i></a>
                            </div>
                            <h3 class="product-title">
                                <a href="demo18-product.html">Hot Black Suits</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            <div class="price-box">
                                <span class="product-price">$30.00</span>
                            </div>
                            <!-- End .price-box -->
                        </div>
                        <!-- End .product-details -->
                    </div>
                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="demo18-product.html">
                                <img src="assets/images/demoes/demo18/products/product-4.jpg" width="205" height="205" alt="product">
                            </a>
                            <div class="btn-icon-group">
                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i class="icon-shopping-cart"></i></a>
                            </div>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick
                                View</a>
                        </figure>
                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="demo18-shop.html" class="product-category">category</a>
                                </div>
                                <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i class="icon-heart"></i></a>
                            </div>
                            <h3 class="product-title">
                                <a href="demo18-product.html">Hyperadapt Shield Lite Half-Zip</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:100%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            <div class="price-box">
                                <span class="product-price">$299.00</span>
                            </div>
                            <!-- End .price-box -->
                        </div>
                        <!-- End .product-details -->
                    </div>
                    <div class="product-default inner-quickview inner-icon">
                        <figure>
                            <a href="demo18-product.html">
                                <img src="assets/images/demoes/demo18/products/product-19.jpg" width="205" height="205" alt="product">
                                <img src="assets/images/demoes/demo18/products/product-10.jpg" width="205" height="205" alt="product">
                            </a>
                            <div class="btn-icon-group">
                                <a href="demo18-product.html" class="btn-icon btn-add-cart"><i class="fa fa-arrow-right"></i></a>
                            </div>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick
                                View</a>
                        </figure>
                        <div class="product-details">
                            <div class="category-wrap">
                                <div class="category-list">
                                    <a href="demo18-shop.html" class="product-category">category</a>
                                </div>
                                <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i class="icon-heart"></i></a>
                            </div>
                            <h3 class="product-title">
                                <a href="demo18-product.html">Jordan Flight</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            <div class="price-box">
                                <span class="product-price">$99.00 - $109.00</span>
                            </div>
                            <!-- End .price-box -->
                        </div>
                        <!-- End .product-details -->
                    </div>
                </div>
                <!-- End .products-slider -->
            </div>
            <!-- End .products-section -->
        </div>
    </main>
    <!-- End .main -->
</section>

<?php
include("footer.php");

?>