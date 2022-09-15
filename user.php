<?php
include('header.php');
$is_page_refreshed = (isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] == 'max-age=0');

?>
<section>
    <main class="main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <div class="container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="demo4.html">Home</a></li>
                            <li class="breadcrumb-item"><a href="category.html">Shop</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                My Account
                            </li>
                        </ol>
                    </div>
                </nav>

                <h1>My Account</h1>
            </div>
        </div>

        <div class="container login-container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="heading mb-1">
                                <h2 class="title">Login</h2>
                            </div>

                            <form action="admin/action.php" method="POST">
                                <label for="login-email">
                                    Username or email address
                                    <span class="required">*</span>
                                </label>
                                <input name="user_email" type="email" class="form-input form-wide" id="login-email" required />

                                <label for="login-password">
                                    Password
                                    <span class="required">*</span>
                                </label>
                                <input name="user_password" type="password" class="form-input form-wide" id="login-password" required />

                                <div class="form-footer">
                                    <div class="custom-control custom-checkbox mb-0">
                                        <input type="checkbox" class="custom-control-input" id="lost-password" />
                                        <label class="custom-control-label mb-0" for="lost-password">Remember
                                            me</label>
                                    </div>

                                    <a href="#" class="forget-password text-dark form-footer-right">Forgot
                                        Password?</a>
                                </div>
                                <button name="user_login" type="submit" class="btn btn-dark btn-md w-100">
                                    LOGIN
                                </button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="heading mb-1">
                                <h2 class="title">Register</h2>
                            </div>

                            <form action="admin/action.php" method="POST">
                                <label for="register-email">
                                    Your First Name
                                    <span class="required">*</span>
                                </label>
                                <input name="fname" type="text" class="form-input form-wide" id="register-fname" required />
                                <label for="register-email">
                                    Your Last Name
                                    <span class="required">*</span>
                                </label>
                                <input name="lname" type="text" class="form-input form-wide" id="register-lname" required />

                                <label for="register-email">
                                    Your Phone number
                                    <span class="required">*</span>
                                </label>
                                <input name="phone_no" type="text" class="form-input form-wide" id="register-no" required placeholder="Start with +923 or 03" />


                                <label for="register-email">
                                    Your Country
                                    <span class="required">*</span>
                                </label>
                                <select name="country" class="form-input form-wide" id="country">
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

                                <label for="register-email">
                                    Your City
                                    <span class="required">*</span>
                                </label>
                                <input name="city" type="text" class="form-input form-wide" id="register-city" required />

                                <label for="register-email">
                                    Email address
                                    <span class="required">*</span>
                                </label>
                                <input name="user_email" type="email" class="form-input form-wide" id="register-email" required />


                                <label for="register-password">
                                    Password
                                    <span class="required">*</span>
                                </label>
                                <input name="user_password" type="password" class="form-input form-wide" id="register-password" required />

                                <div class="form-footer mb-2">
                                    <button name="user_signup" type="submit" class="btn btn-dark btn-md w-100 mr-0">
                                        Register
                                    </button>
                                </div>
                                <?php
                                if ($is_page_refreshed) {
                                    echo "<script>location='user.php'</script>";
                                } else {
                                    if (isset($_GET["status"])) {
                                        $status = $_GET["status"];
                                        if ($status == 2) {


                                ?>
                                            <div class="row">
                                                <div class=" content d-flex justify-content-center align-items-center">
                                                    <div class="alert alert-danger alert-styled-left alert-dismissible">
                                                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                                        <span class="font-weight-semibold">Email is already registered!</span> Try Login.
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        } elseif ($status == 5) {

                                        ?>
                                            <div class="row">
                                                <div class="content d-flex justify-content-center align-items-center">
                                                    <div class="alert alert-success alert-styled-left alert-dismissible">
                                                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                                        <span class="font-weight-semibold">Great!</span> Signed up successfully.
                                                    </div>
                                                </div>
                                            </div>

                                <?php
                                        }
                                    }
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- End .main -->
</section>


<?php
include('footer.php');

?>