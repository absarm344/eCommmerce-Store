<?php
include('header.php');

$banner_query = "SELECT * FROM add_banner";
$banners = db::getRecords($banner_query);

$product_query = "SELECT * FROM product";
$products = db::getRecords($product_query);
?>

<!-- Home Slider/Banner Start -->
<section class="home-slider-container">
    <div class="home-slider owl-carousel with-dots-container" data-owl-options="{'nav': false}">
        <div class="home-slide home-slide1 banner" style="background-color: #111">
            <?php
            if ($banners != null) {
                foreach ($banners as $banner) {
            ?>
                    <div class="slide-bg" src="assets/images/demoes/demo18/slider/home-slide-back.jpg"></div>
                    <!-- End .slide-bg !-->
                    <ul class="slide-bg scene" style="width: 100%; height: 100%;">
                        <li class="layer" data-depth="0.05"><img src="assets/images/demoes/demo18/slider/white-shoes.png" alt="" /></li>
                        <li class="layer" data-depth="0.06"><img style="position: absolute; top: 31%; left: 46.5%;" src="assets/images/demoes/demo18/slider/blurflake1.png" alt="" /></li>
                        <li class="layer" data-depth="0.07"><img class="animation-spin" style="position: absolute; top: 25%; left: 66%;" src="assets/images/demoes/demo18/slider/blurflake2.png" alt="" /></li>
                        <li class="layer" data-depth="0.10"><img class="animation-wave" style="position: absolute; top: 50%; left: 80%;" src="assets/images/demoes/demo18/slider/blurflake3.png" alt="" /></li>
                        <li class="layer" data-depth="0.15"><img style="position: absolute; top: 70%; left: 55%;" src="assets/images/demoes/demo18/slider/blurflake4.png" alt="" /></li>
                    </ul>
                    <div class="home-slide-content">
                        <h2 class="text-white text-transform-uppercase line-height-1"><?php echo $banner['subtitle']; ?></h2>
                        <h3 class="text-white d-inline-block line-height-1 ls-0 text-center"><?php echo $banner['title']; ?>
                        </h3>
                        <h4 class="text-white text-uppercase line-height-1 d-inline-block">50% off</h4>
                        <div></div>
                        <h5 class="float-left text-white text-uppercase line-height-1 ls-n-20"><?php echo $banner['description']; ?></h5>
                        <h6 class="float-left coupon-sale-text line-height-1 ls-n-20 font-weight-bold text-secondary"><?php echo $banner['highlighted']; ?>
                        </h6>
                        <a href="demo18-shop.html" class="btn btn-light d-inline-block">Shop Now</a>
                    </div>
                    <!-- End .home-slide-content -->
            <?php
                }
            }
            ?>
        </div>
        <!-- End .home-slide -->

    </div>
    <!-- End .home-slider -->

    <div class="home-slider-thumbs owl-dots">
        <a href="#" class="owl-dot">
            <img src="assets/images/demoes/demo18/slider/slide-1-thumb.jpg" alt="Slide Thumb">
        </a>
        <a href="#" class="owl-dot">
            <img src="assets/images/demoes/demo18/slider/slide-2-thumb.jpg" alt="Slide Thumb">
        </a>
    </div>
    <!-- End .home-slide-thumbs -->
</section>
<!-- End .home-slider-container -->

<section>
    <div class="products-filter-container bg-gray">
        <div class="container-fluid">
            <div class="row align-items-lg-stretch">
                <aside class="filter-sidebar col-lg-2">
                    <div class="sidebar-wrapper">
                        <h3 class="ls-n-10 text-uppercase text-primary">Sort By</h3>

                        <ul class="check-filter-list">
                            <li><a href="index.php">All</a></li>
                            <li><a href="lifestyle.php" class="active">Lifestyle</a></li>
                            <li><a href="daily.php">Daily Use</a></li>
                            <li><a href="sportswear.php">Sportswear</a></li>
                            <li><a href="fitness.php">Fitness</a></li>
                        </ul>
                    </div>
                    <!-- End .sidebar-wrapper -->
                </aside>

                <div class="col-lg-10">
                    <div class="row product-ajax-grid mb-2">
                        <?php
                        if ($products != NULL) {
                            foreach ($products as $product) {
                                if ($product['id'] == 1) {
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
                                    $temp = $product['id'];
                                    $images_query = "SELECT * FROM product_image where product_id = $temp";
                                    $image = db::getRecord($images_query);
                        ?>
                                    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                                        <div class="product-default inner-quickview inner-icon appear-animate" data-animation-name="fadeIn">
                                            <figure>
                                                <a href=<?php echo "product_details.php?product_id=" . $product['id'] ?>>
                                                    <img src="<?php echo "admin/Images/Products/" . $image['product_images']; ?>" width="205" height="205" alt="product" />
                                                </a>
                                                <div class="btn-icon-group">
                                                    <a href="#" class="btn-icon btn-add-cart product-type-simple"><i class="icon-shopping-cart"></i></a>
                                                </div>
                                                <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick View</a>
                                            </figure>
                                            <div class="product-details">
                                                <div class="category-wrap">
                                                    <div class="category-list">
                                                        <a href="demo18-shop.html" class="product-category"><?php echo $category_name; ?></a>
                                                    </div>
                                                    <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                                </div>
                                                <div class="category-wrap">
                                                    <div class="category-list">
                                                        <a href="product_details.php" class="product-category">(<?php echo $subcategory_name; ?>)</a>
                                                    </div>
                                                </div>
                                                <h3 class="product-title">

                                                    <a href="product_details.php"><?php echo $product['name']; ?></a>
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
                                                    <span class="product-price">$<?php echo $product['price']; ?></span>
                                                </div>
                                                <!-- End .price-box -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End .col-lg-3 -->
                        <?php
                                }
                            }
                        }

                        ?>
                    </div>

                </div>

            </div>
        </div>
    </div>


</section>

<?php
include('footer.php');
?>