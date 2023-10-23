<?
require_once('global.php');
$msg = '';
if (isset($_GET['id'])) {
	$pId = mb_htmlentities($_GET['id']);
	if (!mysqli_num_rows(mysqli_query($con, "select * from ecommerce_products where id='$pId'")) > 0) {
		include('404.html');
		exit();
	} else {
		$details = mysqli_fetch_assoc(mysqli_query($con, "select * from ecommerce_products where id='$pId'"));
		$rev = getAll("select r.*,c.name from ecommerce_review r,ecommerce_customers c where product_id='$pId' and r.customer_id=c.id");
	}
} else {
	include('404.html');
	exit();
}
if (isset($_POST['rev_btn'])) {
	$review = mb_htmlentities($_POST['review']);
	$id = generateRandomString();
	$timeAdded = time();
	$cid = $_SESSION['USER_ID'];
	$result = mysqli_query($con, "INSERT INTO `ecommerce_review` (`id`, `product_id`, `customer_id`, `review`, `added_on`) VALUES ('$id', '$pId', '$cid', '$review', '$timeAdded')");
	if (!$result) {
		header("Location:?id=$pId");
	}
	$msg = 'Review Added Successfully!';
	header("Location:?id=$pId&msg=$msg");
}
include('includes/header.php');
include('includes/topmenu.php');
?>
<nav aria-label="breadcrumb" class="w-100 float-left">
	<ol class="breadcrumb parallax justify-content-center" data-source-url="img/banner/parallax.jpg" style="background-image: url(&quot;img/banner/parallax.jpg&quot;); background-position: 50% 0.809717%;">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Shop</li>
	</ol>
</nav>
<div class="product-deatils-section float-left w-100">
	<div class="container">
		<div class="row">
			<div id="popdown" class="popdown hidden">
				<span id="popdown-message"></span>
			</div>
			<div class="left-columm col-lg-5 col-md-5">
				<div class="product-large-image tab-content">
					<div class="tab-pane active" id="product-01" role="tabpanel" aria-labelledby="product-tab-01">
						<div class="single-img img-full">
							<img src="uploads/<? echo $details['image'] ?>"  alt=""></a>
						</div>
					</div>
					<?php
					$sql = "SELECT * FROM multiple_images WHERE product_id='$pId'";
					$query = mysqli_query($con, $sql);
					$n=2;
					while ($row = mysqli_fetch_assoc($query)) {
						
						?>
					<div class="tab-pane" id="product-0<?echo $n?>" role="tabpanel" aria-labelledby="product-tab-0<?echo $n?>">
						<div class="single-img">
							<a href="uploads/<? echo $row['product_image'] ?>"><img src="uploads/<? echo $row['product_image'] ?>" class="img-fluid" alt=""></a>
						</div>
					</div>
					<?
					$n++;
					}?>
				</div>

				<div class="default small-image-list float-left w-100">
					<div class="nav-add small-image-slider-single-product-tabstyle-3 owl-carousel" role="tablist">
						<div class="single-small-image img-full">
							<a data-toggle="tab" id="product-tab-01" href="#product-01" class="img active"><img src="uploads/<? echo $details['image'] ?>" class="img-fluid" alt=""></a>
						</div>
						<?
						$l=2;
						$query = mysqli_query($con, $sql);
						while ($row = mysqli_fetch_assoc($query)) {
							
							?>
						<div class="single-small-image img-full">
							<a data-toggle="tab" id="product-tab-0<?echo $l?>" href="#product-0<?echo $l?>" class="img"><img src="uploads/<? echo $row['product_image'] ?>" class="img-fluid" alt=""></a>
						</div>
						<?
						$l++;
						} 
						?>
					</div>
				</div>
			</div>
			<div class="right-columm col-lg-7 col-md-7">
				<div class="product-information">
					<h4 class="product-title text-capitalize float-left w-100"><a class="float-left w-100"><? echo $details['title'] ?></a></h4>
					<div class="description">
						<? echo $details['description'] ?>
					</div>

					<div class="rating float-left w-100">
						<?php for ($x = 0; $x < 5; $x++) { ?>
							<?php if ($x <  $details['rating']) { ?>
								<div class="product-ratings d-inline-block align-middle">
									<span class="fa fa-stack"><i class="material-icons">star</i></span>
								</div>
							<?php } else { ?>
								<div class="product-ratings d-inline-block align-middle">
									<span class="fa fa-stack"><i class="material-icons off">star</i></span>
								</div>
							<?php } ?>
						<?php } ?>
					</div>
					<br><br><br><br><br><br><br>
					<div class="price float-left w-100 d-flex">
						<h5>Price :</h5>
						<div class="regular-price">$<? echo $details['price'] ?></div>
					</div>
					<br><br><br>
					<div class="product-variants float-left w-100">
						<div class="col-md-3 col-sm-6 col-xs-12 size-options d-flex align-items-center">
							<h5>Size: <? echo $details['size'] ?> </h5>


						</div>
						<br>
						<div class="color-option d-flex align-items-center">
							<h5>color :</h5>
							<ul class="color-categories">
								<li class="active">
									<a class="tt-<? echo $details['color'] ?>" title="Color" style="background-color: <? echo $details['color'] ?>"></a>
								</li>
								<!-- Add more color categories manually here -->
							</ul>
						</div>
					</div>
					<br>
					<div class="btn-cart d-flex align-items-center float-left w-100">
						<h5>qty:</h5>
						<input id="qtyInput" value="1" name="qty" type="number" min="1">
						<button type="button" class="btn btn-primary btn-cart m-0" onclick="manage_cart('<?php echo $details['id']; ?>', document.getElementById('qtyInput').value , 'add');" data-target="#cart-pop" data-toggle="modal">
							<i class="material-icons">shopping_cart</i> Add To Cart
						</button>
					</div>


				</div>

			</div>
		</div>
	</div>
</div>
<div class="product-tab-area float-left w-100">
	<div class="container">
		<div class="tabs">
			<ul class="nav nav-tabs justify-content-start">
				<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#product-tab1" id="tab1">
						<div class="tab-title">Description</div>
					</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#product-tab2" id="tab2">
						<div class="tab-title">Reviews </div>
					</a></li>
			</ul>
		</div>
		<div class="tab-content float-left w-100">
			<div class="tab-pane active" id="product-tab1" role="tabpanel" aria-labelledby="tab1">
				<div class="description">
					<? echo $details['description'] ?>
				</div>
			</div>
			<div class="tab-pane" id="product-tab2" role="tabpanel" aria-labelledby="tab2">
				<div class="reviews-tab  float-left w-100">
					<?

					?>
					<div class="ttreview-tab float-left w-100 p-30">
						<h2>Customer Reviews </h2>
						<br>

						<? foreach ($rev as $list) { ?>
							<div class="review-title float-left w-100"><span class="user">&nbsp;Name : <? echo $list['name'] ?></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="date"><? echo date('Y-m-d H:i:s', $list['added_on']) ?></span></div>
							<h6>Review :</h6>
							<div class="review-desc  float-left w-100"><? echo $list['review'] ?></div>
							<br><br><br> <? } ?>
					</div>
					<? if (!isset($_SESSION['USER_LOGIN'])) { ?>
						<p style="color: red;">Please Login to submit Review.</p>
						<input type="submit" class="btn btn-primary submit" value="Add Review">

					<? } else { ?>

						<form action="" method="post" class="rating-form float-left w-100">
							<div class="row d-block">

								<div class="col-sm-12 float-left form-group">
									<label for="r-textarea">Your Review</label>
									<textarea name="review" id="r-textarea" cols="26" rows="8" class="w-100"></textarea>
								</div>
							</div>
							<input type="submit" name="rev_btn" class="btn btn-primary submit" value="Submit Review">
						</form>
					<? } ?>
				</div>

			</div>
		</div>
	</div>
</div>
<style>
	   .single-small-image img {
        height: 100px; 
        width: auto; 
    }
	  .single-img img {
        height: 300px;
        width: auto;
    }
	.popdown {
		color: lightgreen;
		position: fixed;
		bottom: 20px;
		left: 50%;
		transform: translateX(-50%);
		background-color: #fff;
		border: 1px solid #ccc;
		padding: 10px 20px;
		border-radius: 4px;
		box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
		z-index: 9999;
	}

	.hidden {
		display: none;
	}
</style>
<script>
	var msg = "<?php echo isset($_GET['msg']) ? $_GET['msg'] : ''; ?>";

	// Get the pop-down element
	var popdown = document.getElementById('popdown');
	var popdownMessage = document.getElementById('popdown-message');

	// Display the pop-down if the 'msg' parameter is set
	if (msg !== '') {
		popdownMessage.innerText = msg;
		popdown.classList.remove('hidden');
	}

	// Close the pop-down when clicked anywhere on the page
	document.addEventListener('click', function() {
		popdown.classList.add('hidden');
	});

	function manage_cart(pid, qty, type) {

		jQuery.ajax({
			url: 'manage_cart.php',
			type: 'post',
			data: 'pid=' + pid + '&qty=' + qty + '&type=' + type,
			success: function(result) {
				jQuery('.ttcount').html(result);
				// window.location.href='checkout.php';
			}
		});

	}
</script>


<? include('includes/footer.php'); ?>

<script type="text/javascript">
	var Tawk_API = Tawk_API || {},
		Tawk_LoadStart = new Date();
	(function() {
		var s1 = document.createElement("script"),
			s0 = document.getElementsByTagName("script")[0];
		s1.async = true;
		s1.src = 'https://embed.tawk.to/5ac1aabb4b401e45400e4197/default';
		s1.charset = 'UTF-8';
		s1.setAttribute('crossorigin', '*');
		s0.parentNode.insertBefore(s1, s0);
	})();
</script>

</body>

</html>