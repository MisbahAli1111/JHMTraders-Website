<? include('includes/header.php');
    include('includes/topmenu.php');
    $error_msg='';
    
?>

<body>

   
    <nav aria-label="breadcrumb" class="w-100 float-left">
        <ol class="breadcrumb parallax justify-content-center" data-source-url="img/banner/parallax.jpg" style="background-image: url(&quot;img/banner/parallax.jpg&quot;); background-position: 50% 0.809717%;">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Register account</li>
        </ol>
    </nav>
    <div class="main-content w-100 float-left blog-list">
        <div class="container">
            <div class="row">
                
                <div class="products-grid col-xl-9 col-lg-8 order-lg-2">
                    <div class="row">
                        <div class="col-lg-12 order-lg-last account-content">
                            <h4>Registration Form</h4>
                            <form action="register_submit.php" method="post" class="myacoount-form">
                                <div class="row">
                               <div class="col-sm-12">
                               <?php if(isset($_GET['success'])) { ?>
                               <div class="success-message">
                                        <span><?php echo $_GET['success']; ?></span>
                                 </div>
                                <?php } ?>
                                <?php if(isset($_GET['msg'])) { ?>    
                                <div class="error-message">
                                    <span><?php echo $_GET['msg']; ?></span>
                                    </div>
                                    <?php } ?>
                                    <div class="row">
                               
                                        <div class="col-md-4">
                                                <div class="form-group required-field">
                                                    <label for="acc-name">Name <span class="required">*</span></label>
                                                    <input type="text" class="form-control" id="name" name="name" required="">
                                                </div>
                                                <!-- End .form-group -->
                                            </div>
                                            <!-- End .col-md-4 -->

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="acc-mname">Phone no <span class="required">*</span></label>
                                                    <input type="number" class="form-control" id="phone_no" name="phone_no">
                                                </div>
                                                <!-- End .form-group -->
                                            </div>
                                            <!-- End .col-md-4 -->

                                            <div class="col-md-4">
                                                <div class="form-group required-field">
                                                    <label for="acc-lastname">Post Code<span class="required">*</span></label>
                                                    <input type="text" class="form-control" id="post_code" name="post_code" required="">
                                                </div>
                                                <!-- End .form-group -->
                                            </div>
                                            <!-- End .col-md-4 -->
                                        </div>
                                        <!-- End .row -->
                                    </div>
                                    <!-- End .col-sm-11 -->
                                </div>
                                <!-- End .row -->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group required-field">
                                                    <label for="acc-name">City <span class="required">*</span></label>
                                                    <input type="text" class="form-control" id="city" name="city" required="">
                                                </div>
                                                <!-- End .form-group -->
                                            </div>
                                            <!-- End .col-md-4 -->

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="acc-mname">Country<span class="required">*</span></label>
                                                    <input type="text" class="form-control" id="country" name="country">
                                                </div>
                                                <!-- End .form-group -->
                                            </div>
                                            <!-- End .col-md-4 -->
                                        </div>
                                        <!-- End .row -->
                                    </div>
                                    <!-- End .col-sm-11 -->
                                </div>
                                <!-- End .row -->
                                <div class="form-group required-field">
                                    <label for="acc-email">Street Address<span class="required">*</span></label>
                                    <input type="text" class="form-control" id="address" name="address" required="">
                                </div>
                                <div class="form-group required-field">
                                    <label for="acc-email">Email<span class="required">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" required="">
                                </div>
                                <!-- End .form-group -->

                                <div class="form-group required-field">
                                    <label for="account-password">Password<span class="required">*</span></label>
                                    <input type="password" class="form-control" id="password" name="password" required="">
                                </div>
                   
                                <div class="form-footer d-flex justify-content-between align-items-center">
                                    <a href="#"><i class="material-icons">navigate_before</i>Back</a>

                                    <div class="form-footer-right">
                                        <button type="submit" class="btn btn-primary btn-primary">Save</button>
                                    </div>
                                </div>
                                <!-- End .form-footer -->
                            </form>
                        </div>
                    </div>
                </div>
		    </div>
        </div>
    </div>
    <style>
    .error-message {
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px;
    border: 1px solid #f5c6cb;
    border-radius: 4px;
    margin-bottom: 10px;
}

.error-message span {
    display: block;
    text-align: center;
}
.success-message {
    background-color: #d4edda;
    color: #155724;
    padding: 10px;
    border: 1px solid #c3e6cb;
    border-radius: 4px;
    margin-bottom: 10px;
}

.success-message span {
    display: block;
    text-align: center;
}

    </style>
	<? include('includes/footer.php'); ?>