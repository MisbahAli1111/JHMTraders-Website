<?

require_once('global.php');
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
		
			
		$invoicePath = "./uploads/invoicehtml"; 
		file_put_contents($invoicePath, $html);
		
		
		echo $html;
		