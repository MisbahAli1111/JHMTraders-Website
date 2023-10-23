<?php
include('global.php');
require('config.php');
include('email.php');
if(isset($_POST['stripeToken'])){
	\Stripe\Stripe::setVerifySslCerts(false);

	$token=$_POST['stripeToken'];
	$amount=$_POST['amount'];
	
	$data=\Stripe\Charge::create(array(
		"amount"=>$amount,
		"currency"=>"usd",
		"description"=>"JHM Traders",
		"source"=>$token,
	));

}
		$totalPrices=0;
		$cart_id=generateRandomString();
		$cust_id=$_SESSION['USER_ID'];
		$timeAdded=time();
		foreach ($_SESSION['cart'] as $pid => $qty) {
			$id=generateRandomString();
			$data = mysqli_fetch_assoc(mysqli_query($con, "SELECT price FROM ecommerce_products WHERE id = '$pid'"));
			$price=$data['price'];
			$total=$price*$qty;
			$totalPrices=$totalPrices+$total;
			$sql="INSERT INTO `ecommerce_orders` (`id`, `cart_id` ,`product_id`, `customer_id`, `qty`, `total_price`, `order_status`, `ordered_on`) VALUES ('$id','$cart_id' ,'$pid', '$cust_id', '$qty', '$total', 'pending', '$timeAdded')";
			$query=mysqli_query($con,$sql);
			if(!$query){
				echo $con->error;
			}
		}
		$subject1="Order Confirmation - Thank You for Your Purchase!";
		$name=$_SESSION['USER_NAME']; 
		$date = date('Y-m-d H:i:s', $timeAdded);
		$email="info@jhmtraders.com";
		
		
		// invoice
		
		$html= '
		<!DOCTYPE html>
		<html>
		<head>
		  <title>Invoice</title>
		  <style>
			body {
			  font-family: Arial, sans-serif;
			  font-size: 12px;
			}
			h1 {
			  text-align: center;
			  margin-top: 20px;
			  font-size: 16px;
			}
			.bold {
			  font-weight: bold;
			}
			.right {
			  text-align: right;
			}
			.invoice-table {
			  width: 100%;
			  border-collapse: collapse;
			  margin-top: 20px;
			}
			.invoice-table th, .invoice-table td {
			  border: 1px solid #ccc;
			  padding: 8px;
			  text-align: left;
			}
			.invoice-table th {
			  background-color: #333;
			  color: #fff;
			}
			.invoice-table tfoot th {
			  background-color: transparent;
			  color: #000;
			}
		  </style>
		</head>
		<body>
		  <h1>JHM TRADERS LTD</h1>
		  <br>
		  <div>
			<span class="bold">Buyer:</span> Lynsey
		  </div>
		  <br>
		  <br>
		  <div class="bold">Ship to</div>
		  <div>
			Ashley High<br>
			Durham University School of Education<br>
			Leazes Road<br>
			Durham<br>
			DH1 1TA<br>
			United Kingdom
		  </div>
		  
		  <h2 class="right">INVOICE</h2>
		
		  <div class="right bold">Date: '.$date.'</div>
		  <div>
		  
		  </div>
		  
		  <table class="invoice-table">
			<thead>
			  <tr>
				<th>Item</th>
				<th>Quantity</th>
				<th>Rate</th>
				<th>Amount</th>
			  </tr>
			</thead>
			<tbody>';
            $totalPrices=0;
			foreach ($_SESSION['cart'] as $pid => $qty) {
				$id=generateRandomString();
				$data = mysqli_fetch_assoc(mysqli_query($con, "SELECT price,title FROM ecommerce_products WHERE id = '$pid'"));
				$price=$data['price'];
				$title=$data['title'];
				$total=$price*$qty;
				$totalPrices=$totalPrices+$total;
				
				$html.='
				<tr>
				  <td>' .$title. '</td>
				  <td>' .$qty. '</td>
				  <td>$' .$price. '</td>
				  <td>$' .$total. '</td>
				</tr>';
				
			}
				$html.='
			</tbody>
			<tfoot>
			  <tr>
				<th colspan="3">Subtotal</th>
				<td>$' .$totalPrices. '</td>
			  </tr>
			  <tr>
				<th colspan="3">Tax (0%)</th>
				<td>$0</td>
			  </tr>
			  <tr>
				<th colspan="3">Total</th>
				<td>$' .$totalPrices. '</td>
			  </tr>
			</tfoot>
		  </table>
		</body>
		</html>';
		
		
		$invoicePath = "./uploads/.$cart_id.html"; 
		file_put_contents($invoicePath, $html);
		
		
		
		
		
		$msg1 = "<html>
		<body>
		<p>Dear $name,</p>
		
		<p>Thank you for placing your order with us. We are pleased to confirm that your order has been successfully received and is being processed.</p>
		
		<p><strong>Order Amount of your Order:</strong>$$totalPrices</p>
		<p><strong>Order Date:</strong> $date</p>
		
		<p>We will notify you once your order has been shipped. If you have any questions or require further assistance, please feel free to contact our customer support team at $email.</p>
		<p>Please Find the invoice Attached below.</p>
		
		<p>Thank you again for choosing us. We appreciate your business and look forward to serving you.</p>
		
		<p>Best regards,</p>
		<p>JHM Traders</p>
		</body>
		</html>";

		echo smtp_mailer('syedmisbahali1111@gmail.com',$subject1,$msg1,$invoicePath);
		
		$subject2="An order has been placed on the website!";
		$msg2= "<html>
		<body>
		<p>Dear Owner,</p>			
		<p>An order has been placed on the website.</p>
	
		<p><strong>Customer Name:</strong> $name</p>
		<p><strong>Order Amount:</strong> $$totalPrices</p>
		<p><strong>Order Date:</strong> $date </p>
		<p>Please Find the invoice Attached below.</p>
		
		<p>Please take necessary actions to process and fulfill the order.</p>
		
					
					<p>Thank you.</p>
		
					<p>Best regards,</p>
					<p>JHM Traders</p>
				</body>
			</html>";

		echo smtp_mailer('k201093@nu.edu.pk',$subject2,$msg2,$invoicePath);
	
		
		?>

		<?
		unset($_SESSION['cart']);
		
		?>
<script>
		window.location.href='order_confirmation.php?msg="success"';
	
</script>
<?




?>



