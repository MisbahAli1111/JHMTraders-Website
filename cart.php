
<? include('includes/header.php');
 include('includes/topmenu.php'); ?>
  <body>
  	
	
      <nav aria-label="breadcrumb" class="w-100 float-left">
    <ol class="breadcrumb parallax justify-content-center" data-source-url="img/banner/parallax.jpg" style="background-image: url(&quot;img/banner/parallax.jpg&quot;); background-position: 50% 0.809717%;">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">cart</li>
  
    </ol>
  </nav>
      
      <div class="cart-area table-area pt-110 pb-95 float-left w-100">
              <div class="container">
              <div class="row">
              <div class="col-lg-8 col-md-12 col-sm-12 float-left cart-wrapper">
                  <div class="table-responsive">
                      <table class="table product-table text-center">
                         <thead>
                              <tr>
                                  <th class="table-remove text-capitalize">remove</th>
                                  <th class="table-image text-capitalize">image</th>
                                  <th class="table-p-name text-capitalize">product</th>
                                  <th class="table-p-price text-capitalize">price</th>
                                  <th class="table-p-qty text-capitalize">quantity</th>
                                  <th class="table-total text-capitalize">total</th>
                              </tr>
                          </thead>
                         <tbody>
                         <?php
                              $total_price=0;
                              if(isset($_SESSION['cart'])){
                            foreach ($_SESSION['cart'] as $pid => $qty) {
                            $data = mysqli_fetch_assoc( mysqli_query($con, "SELECT * FROM ecommerce_products WHERE id = '$pid'"));
                            ?>
                            <tr>
                            <td class="table-remove"><button onclick="manage_cart('<? echo $data['id'] ?>','remove')"><i class="material-icons">delete</i></button></td>
                            <td class="table-image"><a href="product-details.html"><img src="uploads/<? echo $data['image'] ?>" alt=""></a></td>
                            <td class="table-p-name text-capitalize"><a href="product_details.php?id=<?echo$pid?>"><?php echo $data['title']; ?></a></td>
                            <td class="table-p-price"><p>$<?php echo $data['price']; ?></p></td>
                            <td class="table-p-qty"><p><?php echo $qty; ?></p></td>
                            <td class="table-total"><p>$<?php echo $data['price'] * $qty; ?></p></td>
                            </tr>
                            <? $total_price=$total_price+$data['price']*$qty;  ?>
                            
                            <?php } }?>
                          </tbody>
                      </table>
                  </div>
                 
              </div>
              <div class="table-total-wrapper d-flex justify-content-end pt-60 col-md-12 col-sm-12 col-lg-4 float-left  align-items-center">
                      <div class="table-total-content">
                          <h2 class="pb-20">Cart totals</h2>
                          <div class="table-total-amount">
                              <div class="single-total-content d-flex justify-content-between float-left w-100">
                                  <strong>Subtotal</strong>
                                  <span class="c-total-price"><? echo $total_price ?></span>
                              </div>
                              
                              <div class="single-total-content tt-total d-flex justify-content-between float-left w-100">
                                  <strong>Total</strong>
                                  <span class="c-total-price"><? echo $total_price ?></span>
                              </div>
                              <? if(isset($_SESSION['USER_LOGIN'])){
                                if(isset($_SESSION['cart'])){?>
                                    <a href="checkout.php" class="btn btn-primary float-left w-100 text-center">Proceed to checkout</a>
                                    <?
                                }else{?>
                                    <p>Your cart is empty.</p>
                                    
                                <?} ?>
                             <? } 
                                else{ ?>
                                    <p>You have to login before you checkout.</p>
                                <? } ?></div>
                      </div>
                  </div>
              </div>
              </div>
                  
          </div>
  <script>
    function manage_cart(pid,type){
        jQuery.ajax({
		url:'manage_cart.php',
		type:'post',
		data:'pid='+pid+'&type='+type,
		success:function(result){
			     jQuery('.ttcount').html(result);
                 window.location.href='cart.php';
		}	
	});
    }
    </script>

 
  <!--End of Tawk.to Script-->
          
          </body>
  </html>
  
  
  <? include('includes/footer.php'); ?>
  