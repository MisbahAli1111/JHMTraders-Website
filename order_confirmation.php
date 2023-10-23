<? 
require_once('gLobal.php');
if(!isset($_SESSION['USER_ID'])){
  header('Location:index.php');
 }

include('includes/header.php');
include('includes/topmenu.php');

$cust_id=$_SESSION['USER_ID'];
    
$query = "SELECT o.cart_id,o.order_status,GROUP_CONCAT(p.price) as prod_price,GROUP_CONCAT(o.qty) as order_qtys, GROUP_CONCAT(o.id) as order_ids, GROUP_CONCAT(o.product_id) as product_ids, GROUP_CONCAT(p.title) as product_names, GROUP_CONCAT(o.qty) as quantities, GROUP_CONCAT(o.total_price) as total_prices,GROUP_CONCAT(p.image) as product_images
FROM ecommerce_orders o
JOIN ecommerce_products p ON o.product_id = p.id
WHERE o.customer_id = '$cust_id'
GROUP BY o.cart_id
ORDER BY o.ordered_on DESC";
$result = mysqli_query($con, $query);
    
    
    
    // else{
    // echo "Error executing query: " . mysqli_error($con);
    // }


?>
<nav aria-label="breadcrumb" class="w-100 float-left">
  <ol class="breadcrumb parallax justify-content-center" data-source-url="img/banner/parallax.jpg" style="background-image: url(&quot;img/banner/parallax.jpg&quot;); background-position: 50% 0.809717%;">
    <li class="breadcrumb-item active"><a href="index.php">Home</a></li>
	    <li class="breadcrumb-item active" aria-current="page">order-confirmation</li>

  </ol>
</nav>
 <div class="order-inner float-left w-100">     
 <div class="container">
 <div class="row">
  <?  if(isset($_GET['msg'])){ ?>
	<div id="order-confirmation" class="card float-left w-100 mb-10">
		<div class="card-block p-20">
			<h3 class="card-title text-success">Your order is confirmed</h3>
			<p>An email has been sent to your mail address <? echo $_SESSION['USER_EMAIL'] ?>.</p>
		</div>
	</div>
  <?}?>
    <h3>Order List</h3>
    <? if ($result) {
        while ($row = mysqli_fetch_assoc($result)){
        $cartId = $row['cart_id'];
        $status = $row['order_status'];
        $orderIds = explode(",", $row['order_ids']);
        $productIds = explode(",", $row['product_ids']);
        $productNames = explode(",", $row['product_names']);
        $quantities = explode(",", $row['quantities']);
        $qtys = explode(",", $row['order_qtys']);
        $productImages = explode(",", $row['product_images']);
        $totalPrices = explode(",", $row['total_prices']);
        $prod_prices=explode(",", $row['prod_price']);
        $total=0;
        ?>
        <div id="order-itens" class="card float-left w-100 mb-10">
    <div class="card-block p-20">
        <div class="order-confirmation-table float-left w-100">
            <?php for ($i = 0; $i < count($orderIds); $i++) {
                $subtotal = $prod_prices[$i] * $qtys[$i];
                $total = $total + $subtotal;
            ?>
            
            <?php } ?>
            <table class="float-left w-100 mb-30">
                <tbody>
                    <tr class="mb-10">
                        
                        <td><strong>Product Name</strong></td>
                        <td><strong>Quantity</strong></td>
                        <td><strong>Price</strong></td>
                        <td><strong>Subtotal</strong></td>
                    </tr>
                    <?php for ($i = 0; $i < count($orderIds); $i++) { ?>
                    <tr>
                        <td><?php echo $productNames[$i] ?></td>
                        <td><?php echo $qtys[$i] ?></td>
                        <td><?php echo $prod_prices[$i] ?></td>
                        <td><?php echo $prod_prices[$i] * $qtys[$i] ?></td>
                    </tr>
                    <?php } ?>
                    
                    <tr class="mb-10">
                        <td>Subtotal</td>
                        <td colspan="3" class="text-right">$<?php echo $total ?></td>
                    </tr>
                    <tr class="mb-10">
                        <td>Shipping and handling</td>
                        <td colspan="3" class="text-right">$0.00</td>
                    </tr>
                    <br>
                    <tr class="font-weight-bold">
                        <td><span class="text-uppercase">Total Price</span></td>
                        <td colspan="3" class="text-right">$<?php echo $total ?></td>
                    </tr>
                    <tr><td></td></tr>
                    <tr><td></td></tr>
                    <tr>
                      <td><strong>Order Status: <?echo $status?></strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

    <? }
    }?>
    <? if(mysqli_num_rows($result)>0){ ?>
<div id="content-hook_payment_return" class="card definition-list float-left w-100">
      <div class="card-block p-20">
        <div class="row">
          <div class="col-md-12">
   


    <p>
      We've also sent you this information by e-mail.
    </p>
    <strong>Your order will be sent as soon as we receive payment.</strong>
    <p>Free Secure and Safe Home delivery.</p>
    
    <p>
      If you have questions, comments or concerns, please contact our <strong><a href="contact_us.php">expert customer support team</a></strong>
    </p>

          </div>
        </div>
      </div>
    </div>
    <?} else{?>
      <div id="content-hook_payment_return" class="card definition-list float-left w-100">
      <div class="card-block p-20">
        <div class="row">
          <div class="col-md-12">
   


   
    <strong>Hurry Up! Place your Order.</strong>
    <p>Free Secure and Safe Home delivery.</p>
    
    <p>
      If you have questions, comments or concerns, please contact our <strong><a href="contact_us.php">expert customer support team</a></strong>
    </p>

          </div>
        </div>
      </div>
    </div>
      
    <?} ?>
</div>
</div>
</div>
    <? include('includes/footer.php'); ?>		
		</body>
</html>






