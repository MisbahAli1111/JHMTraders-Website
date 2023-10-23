<?
require("./global.php");
if ($logged == 0)
	header("Location:./index.php");

if (isset($_POST['order_status'])) {
	$cart_id = $_POST['cart_id'];
	$order_status = $_POST['order_status'];

	$query = "UPDATE `ecommerce_orders` SET `order_status`='$order_status' WHERE cart_id='$cart_id'";
	runQuery($query);
	header("Location:./orders.php?m=Order Status Updated Successfully");
}


if (isset($_GET['delete-record'])) {
	$cart_id = mb_htmlentities($_GET['delete-record']);
	$query = "delete from ecommerce_orders where cart_id='$cart_id'";
	$file = '../uploads/.' . $cart_id . '.html';
	//die();
	// echo $filename = __DIR__ . './uploads/jdsakf.html'; // Replace 'path/to/your/folder' with the relative path to your folder
	// die();
	if (file_exists($file)) {
		unlink($file);
		runQuery($query);
		header("Location:./orders.php?m=Deleted Successfully");
	} else {
		header("Location:./orders.php?m=Invoice Dosent Exist");
	}
}


$query = "SELECT o.cart_id,o.ordered_on,o.order_status,o.customer_id,GROUP_CONCAT(p.price) as prod_price,GROUP_CONCAT(o.qty) as order_qtys, GROUP_CONCAT(o.id) as order_ids, GROUP_CONCAT(o.product_id) as product_ids, GROUP_CONCAT(p.title) as product_names, GROUP_CONCAT(o.qty) as quantities, GROUP_CONCAT(o.total_price) as total_prices,GROUP_CONCAT(p.image) as product_images
FROM ecommerce_orders o
JOIN ecommerce_products p ON o.product_id = p.id
GROUP BY o.cart_id
ORDER BY o.ordered_on DESC";
$result = mysqli_query($con, $query);

?>

<html lang="en">

<head>
	<? require("./includes/views/head.php"); ?>
</head>

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
	<div class="d-flex flex-column flex-root">
		<!--begin::Page-->
		<div class="page d-flex flex-row flex-column-fluid">
			<? require("./includes/views/leftmenu.php"); ?>
			<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
				<? require("./includes/views/topmenu.php"); ?>


				<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
					<!--end::Toolbar-->
					<!--begin::Post-->
					<div class="post d-flex flex-column-fluid" id="kt_post">


						<div id="kt_content_container" class="container-xxl" style="max-width: 100%;">


							<? if (isset($_GET['m'])) { ?>
								<div class="alert alert-dismissible bg-success d-flex flex-column flex-sm-row w-100 p-5 mb-10">
									<!--begin::Icon-->
									<span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="currentColor"></path>
											<path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="currentColor"></path>
										</svg>
									</span>
									<!--end::Icon-->

									<!--begin::Wrapper-->
									<div class="d-flex flex-column text-light pe-0 pe-sm-10">
										<h4 class="mb-2 light" style="color: white;margin-top: 5px;"><? echo $_GET['m'] ?></h4>
									</div>
									<!--end::Wrapper-->

									<!--begin::Close-->
									<button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
										<span class="svg-icon svg-icon-2x svg-icon-light">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
												<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
											</svg>
										</span>
									</button>
									<!--end::Close-->
								</div>
							<? } ?>




							<!--begin::Category-->
							<div class="card card-flush">

								<!--begin::Card header-->
								<div class="card-header align-items-center py-5 gap-2 gap-md-5">
									<!--begin::Card title-->
									<div class="card-title">
										<!--begin::Search-->
										<div class="d-flex align-items-center position-relative my-1">
											<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
											<span class="svg-icon svg-icon-1 position-absolute ms-4">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
													<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
												</svg>
											</span>
											<!--end::Svg Icon-->
											<input type="text" data-kt-ecommerce-category-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Order" />
										</div>
										<!--end::Search-->
									</div>
									<!--end::Card title-->
									<!--begin::Card toolbar-->
									<div class="card-toolbar">
										<!--begin::Add customer-->
										<!--end::Add customer-->
									</div>
									<!--end::Card toolbar-->
								</div>
								<!--end::Card header-->
								<!--begin::Card body-->
								<div class="card-body pt-0">
									<!--begin::Table-->
									<table class="table align-middle table-row-dashed fs-6 gy-5 table-bordered" id="kt_ecommerce_category_table">
										<!--begin::Table head-->
										<thead>
											<!--begin::Table row-->
											<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">

												<th>Product title</th>
												<th>Quantity</th>
												<th>Unit Price</th>
												<th>Price</th>
												<th>Ordered Status</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody class="fw-bold text-gray-600">
											<?
											if ($result) {
												while ($row = mysqli_fetch_assoc($result)) {
													$cartId = $row['cart_id'];
													$date = $row['ordered_on'];
													$customer_id = $row['customer_id'];
													$order_status = $row['order_status'];
													$orderIds = explode(",", $row['order_ids']);
													$productIds = explode(",", $row['product_ids']);
													$productNames = explode(",", $row['product_names']);
													$quantities = explode(",", $row['quantities']);
													$qtys = explode(",", $row['order_qtys']);
													$productImages = explode(",", $row['product_images']);
													$totalPrices = explode(",", $row['total_prices']);
													$prod_prices = explode(",", $row['prod_price']);
													$total = 0;

													for ($i = 0; $i < count($orderIds); $i++) {
														$subtotal = $prod_prices[$i] * $qtys[$i];
														$total = $total + $subtotal;
											?>
													<? }
													?>
													<tr>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
														<td></td>
													</tr>

													<tr>
														<td style="background-color: #e8e3e3;">-------</td>
														<td style="background-color: #e8e3e3;">-------</td>
														<td style="background-color: #e8e3e3;">-------</td>
														<td style="background-color: #e8e3e3;">-------</td>
														<td style="background-color: #e8e3e3;">-----------------</td>
														<td style="background-color: #e8e3e3;">-------</td>
													</tr>
													<?php for ($i = 0; $i < count($orderIds); $i++) { ?>
														<tr>

															<td><?php echo $productNames[$i]; ?></td>

															<td><?php echo $qtys[$i] ?></td>
															<td>$<?php echo $prod_prices[$i] ?></td>
															<td>$<?php echo $prod_prices[$i] * $qtys[$i] ?></td>
														<?php } ?>


														<td>Date: <? echo date('Y-m-d H:i:s', $date) ?></td>
														<td><button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#message-modal-<?php echo $customer_id; ?>">View Details</button>
														</td>
														<div class="modal fade" id="message-modal-<?php echo $customer_id; ?>" tabindex="-1" aria-labelledby="message-modal-<?php echo $customer_id; ?>-label" aria-hidden="true">
															<div class="modal-dialog modal-dialog-centered">
																<div class="modal-content">
																	<div class="modal-header">
																		<h5 class="modal-title" id="message-modal-<?php echo $customer_id; ?>-label">Details</h5>
																		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																	</div>
																	<div class="modal-body">
																		<?php
																		$sql = "SELECT * FROM ecommerce_customers WHERE id='$customer_id'";
																		$query = mysqli_query($con, $sql);
																		if ($row = mysqli_fetch_assoc($query)) {

																			$customerName = $row['name'];
																			$customerEmail = $row['email'];
																			$customerAddress = $row['address'];
																			$phone = $row['phone no'];
																			$country = $row['country'];
																			$city = $row['city'];


																			echo "<h4>Customer Details</h4>";
																			echo "<br>";
																			echo "<strong>Name:</strong> " . $customerName . "<br>";
																			echo "<br>";
																			echo "<strong>Email:</strong> " . $customerEmail . "<br>";
																			echo "<br>";
																			echo "<strong>Address:</strong> " . $customerAddress . "<br>";
																			echo "<br>";
																			echo "<strong>Contact No:</strong> " . $phone . "<br>";
																			echo "<br>";
																			echo "<strong>City:</strong> " . $city . "<br>";
																			echo "<br>";
																			echo "<strong>Country:</strong> " . $country . "<br>";
																		} else {
																			echo "No customer Found";
																		}
																		?>
																	</div>
																</div>
															</div>
														</div>

														</tr>
														<tr>
															<td>Total</td>
															<td></td>
															<td></td>
															<td>$<?php echo $total; ?></td>

															<td>
																<form method="post" action="">
																	<div class="input-group">
																		<input type="hidden" name="cart_id" value="<?php echo $cartId; ?>">
																		<select class="form-select form-select-sm
															<?php if ($order_status == 'Pending') echo 'form-select-border-red';
															elseif ($order_status == 'Processing') echo 'form-select-border-yellow';
															elseif ($order_status == 'Shipped') echo 'form-select-border-yellow';
															elseif ($order_status == 'Delivered') echo 'form-select-border-green'; ?>" name="order_status" onchange="this.form.submit()">
																			<option value="Pending" <?php if ($order_status == 'Pending') echo 'selected'; ?>>Pending</option>
																			<option value="Processing" <?php if ($order_status == 'Processing') echo 'selected'; ?>>Processing</option>
																			<option value="Shipped" <?php if ($order_status == 'Shipped') echo 'selected'; ?>>Shipped</option>
																			<option value="Delivered" <?php if ($order_status == 'Delivered') echo 'selected'; ?>>Delivered</option>
																		</select>
																	</div>
																</form>
															</td>
															<td> <a href="#" data-bs-toggle="modal" data-bs-target="#delete_record" data-url="?delete-record=<? echo $cartId ?>" class="btn btn-danger btn-sm">Delete</a>
															</td>
														</tr>
													<? } ?>

												<? } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Button -->


				<? require("./includes/views/footer.php"); ?>

				<!--end::Footer-->
			</div>
			<!--end::Wrapper-->
		</div>
		<script>

		</script>

		<? require("./includes/views/footerjs.php"); ?>


	</div>
	<style>
		.form-select-border-red {
			border-color: red;
		}

		.form-select-border-yellow {
			border-color: yellow;
		}

		.form-select-border-green {
			border-color: green;
		}

		.highlight {
			background-color: yellow;
			/* Add any other desired styles */
		}
	</style>
</body>

</html>