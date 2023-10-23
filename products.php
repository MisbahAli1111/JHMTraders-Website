<?
require_once('global.php');

if (isset($_GET['cat'])) {
	$cat = mb_htmlentities($_GET['cat']);
	if (!mysqli_num_rows(mysqli_query($con, "select * from ecommerce_category where categories='$cat'")) > 0) {
		include('404.html');
		exit();
	}
}else{
	include('404.html');
		exit();
}


if(isset($_POST['limit'])){
	$limit=$_POST['limit'];
	header("Location:products.php?cat=$cat");
}else{
	$limit=12;
}
include('includes/header.php');
include('includes/topmenu.php');




?>
<nav aria-label="breadcrumb" class="w-100 float-left">
	<ol class="breadcrumb parallax justify-content-center" data-source-url="img/banner/parallax.jpg" style="background-image: url(&quot;img/banner/parallax.jpg&quot;); background-position: 50% 0.809717%;">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">category</li>
	</ol>
</nav>
<div class="main-content w-100 float-left">
	<div class="container">
		<div class="row">
			<div class="content-wrapper-canvas col-xl-12 col-lg-12 order-lg-2">
				<div class="block-category mb-30 w-100 float-left">
					<div class="category-cover">
						<img src="img/banner/category-banner.png" alt="category-banner" />
					</div>
				</div>
				<header class="product-grid-header d-flex d-xs-block d-sm-flex d-lg-flex w-100 float-left">
					<div class="hidden-sm-down total-products d-flex d-xs-block d-lg-flex col-md-3 col-sm-3 col-xs-12 align-items-center p-0">

						<div class="nav" role="tablist">
							<a class="grid active" href="#grid" data-toggle="tab" role="tab" aria-selected="true" aria-controls="grid"><i class="material-icons align-middle">grid_on</i></a>
						</div>
					</div>

					<div class="shop-results-wrapper d-flex d-sm-flex d-xs-block d-lg-flex col-md-7 col-sm-8 col-xs-12 justify-content-end">
						<div class="shop-results d-flex align-items-center"><span>Show</span>

							<div class="shop-select">
								<select name="number" id="number" onchange="handleSelectChange(this)">
									<option value="9">9</option>
									<option value="25">25</option>
									<option value="50">50</option>
									<option value="75">75</option>
									<option value="100">100</option>
								</select>
							</div>
						</div>

					</div>

				</header>
				<div class="tab-content text-center products w-100 float-left">
					<? $result = getAll("SELECT * FROM ecommerce_products WHERE category='$cat' LIMIT $limit");
					if($result){
				
					foreach ($result as $val) { ?>
<div class="tab-pane grid fade active" id="grid" role="tabpanel">
    <div class="column">
        <div class="product-layouts col-lg-3 col-md-3 col-sm-6 col-xs-6">
            <div class="product-thumb">
                <div class="image zoom">
                    <a href="product_details.php?id=<?php echo $val['id'] ?>">
                        <div class="image-container">
                            <img src="uploads/<?php echo $val['image'] ?>" alt="01" />
                        </div>
                    </a>
                </div>
                <div class="thumb-description">
                    <div class="caption">
                        <h4 class="product-title text-capitalize"><a href="product_details.php?id=<?php echo $val['id'] ?>"><?php echo $val['title'] ?></a></h4>
                    </div>
                    <div class="price">
                        <div class="regular-price"><?php echo $val['price'] ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

					<? }
					}else{?>
						<h4>Products Will be added Soon...</h4>
					<? } ?>



					<div class="pagination-wrapper float-left w-100">
						<p>Showing Page 1 </p>
						
					</div>
				</div>

			</div>
		</div>
	</div>


	<?
	include('includes/footer.php');
	?>

						<script>
							function handleSelectChange(selectElement) {
							var limit = selectElement.value; 
							var form = document.createElement('form');
							form.method = 'POST';
							form.action = window.location.href; // Submit to the same page

							var limitInput = document.createElement('input');
							limitInput.type = 'hidden';
							limitInput.name = 'limit';
							limitInput.value = limit;

							// Append the hidden input field to the form
							form.appendChild(limitInput);

							// Append the form to the document body and submit it
							document.body.appendChild(form);
							form.submit();
							}

						</script>
	<!-- Footer -->
	<style>
	.image-container {
    height: 200px; /* Set the desired height */
    display: flex;
    justify-content: center;
    align-items: center;
}

.image-container img {
    max-height: 100%;
    max-width: 100%;
    object-fit: contain;
}
	</style>

	<!--Start of Tawk.to Script-->
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
	<!--End of Tawk.to Script-->
	</body>

	</html>