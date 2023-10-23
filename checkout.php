<?

require_once('global.php');
$msg = '';
if (!isset($_SESSION['USER_LOGIN'])) { ?>
  <script>
    window.location.href = 'index.php';
  </script>
<? }
if (isset($_POST['name'])) {
  $name = mb_htmlentities($_POST['name']);
  $email = mb_htmlentities($_POST['email']);
  $phone_no = mb_htmlentities($_POST['phone_no']);
  $city = mb_htmlentities($_POST['city']);
  $post_code = mb_htmlentities($_POST['post_code']);
  $country = mb_htmlentities($_POST['country']);
  $address = mb_htmlentities($_POST['address']);
  $id = mb_htmlentities($_POST['id']);
  $query = mysqli_query($con, "UPDATE `ecommerce_customers` SET `name`='$name',`email`='$email',`phone no`='$phone_no',`address`='$address',`post_code`='$post_code',`city`='$city',`country`='$country' WHERE id='$id'");
  if (!$query) {
    echo $con->error;
  } else {
    $msg = 'Information Updated';
  }
}

$cust_id = $_SESSION['USER_ID'];
$array = mysqli_fetch_assoc(mysqli_query($con, "select * from ecommerce_customers where id='$cust_id'"));


include('includes/header.php');
include('includes/topmenu.php');
include('config.php');
?>

<?

?>

<nav aria-label="breadcrumb" class="w-100 float-left">
  <ol class="breadcrumb parallax justify-content-center" data-source-url="img/banner/parallax.jpg" style="background-image: url(&quot;img/banner/parallax.jpg&quot;); background-position: 50% 0.809717%;">
    <li class="breadcrumb-item active"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">checkout</li>

  </ol>
</nav>
<div class="checkout-inner float-left w-100">
  <div class="container">
    <div class="row">
      <?
      if (isset($_SESSION['cart'])) {
      ?>
        <div class="cart-block-left col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span>Your cart</span>
          </h4>
          <div class="list-group mb-3">
            <?php
            $total_price = 0;

            foreach ($_SESSION['cart'] as $pid => $qty) {
              $data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM ecommerce_products WHERE id = '$pid'"));
            ?>
              <div class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                  <h6 class="my-0"><? echo $data['title'] ?></h6>
                </div>
                <span class="text-muted">$<? echo $data['price'] ?> * <? echo $qty ?></span>
              </div>
              <? $total_price = $total_price + $data['price'] * $qty;  ?>

            <?php } ?>
            <div class="list-group-item d-flex justify-content-between">
              <strong>Total (USD)</strong>
              <strong>$<? echo $total_price ?></strong>
            </div>
            <div class="list-group-item  justify-content-between">
              <div class="custom-control custom-radio" id="checkbox-card">
                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" required="" checked>
                <label class="custom-control-label" for="credit">Credit card</label>
              </div>
            </div>

            <form action="checkout_page.php" method="post" class="stripe-form">
              <input type="hidden" name="amount" value="<?php echo $total_price * 100 ?>">
              <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="<?php echo $publishableKey ?>" data-amount="<?php echo $total_price * 100 ?>" data-name="JHM Traders" data-description="JHM Traders Shipping" data-image="img/logos/logo.png" data-currency="usd" data-email="<? echo $_SESSION['USER_EMAIL'] ?>"></script>
            </form>


            </ul>


          </div>
        </div>
      <? } ?>
      <div class="cart-block-right col-md-8 order-md-1">
        <h4 class="mb-3">Billing information and address</h4>
        <form action="" method="post">

          <? if ($msg != '') { ?>
            <br>
            <div class="success-message">
              <? echo $msg ?>
            </div>
            <br>
          <? } ?>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">Name <span class="required">*</span></label>
              <input type="text" class="form-control" id="name" name="name" placeholder="" value="<? echo $array['name'] ?>" required="">

            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Email <span class="required">*</span></label>
              <input type="text" class="form-control" id="email" name="email" placeholder="" value="<? echo $array['email'] ?>" required="">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">City <span class="required">*</span></label>
              <input type="text" class="form-control" id="city" name="city" placeholder="" value="<? echo $array['city'] ?>" required="">

            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Country <span class="required">*</span></label>
              <input type="text" class="form-control" id="country" name="country" placeholder="" value="<? echo $array['country'] ?>" required="">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">Contact no <span class="required">*</span></label>
              <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="" value="<? echo $array['phone no'] ?>" required="">

            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Post code <span class="required">*</span></label>
              <input type="text" class="form-control" id="post_code" name="post_code" placeholder="" value="<? echo $array['post_code'] ?>" required="">
            </div>
          </div>
          <div class="mb-3">
            <label for="address">Address<span class="required">*</span> </label>
            <input type="text" class="form-control" id="address" name="address" value="<? echo $array['address'] ?>" required="">
          </div>
          <input type="hidden" class="form-control" id="id" name="id" value="<? echo $array['id'] ?>" required="">
          <hr class="mb-4">
          <div class="custom-control custom-checkbox" id="same-address-main">
            <label class="custom-control" for="same-address">Shipping address is the same as my billing address.&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <button type="submit" class="btn btn-primary btn-lg btn-primary">Update Information</button> </label>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<style>
  .success-message {
    background-color: #dff0d8;
    color: #3c763d;
    border: 1px solid #d6e9c6;
    padding: 10px;
    border-radius: 4px;
  }

  .stripe-form {
    margin: 20px;
    text-align: center;
  }

  .stripe-button {
    background-color: #6772e5;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    border: none;
  }

  .stripe-button:hover {
    background-color: #5469d4;
  }
</style>
<? include('includes/footer.php'); ?>
</body>

</html>