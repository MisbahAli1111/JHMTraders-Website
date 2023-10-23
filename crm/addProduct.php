<?
require("./global.php");
if ($logged == 0)
	header("Location:./index.php");
$multipleImageArr = [];
$new = 0;
$productId = clear($_GET['productId']);
$type = clear($_GET['type']);

if (isset($_GET['id'])) {
	$id = clear($_GET['id']);
	$imageName = clear($_GET['name']);;
	$filePath = "../uploads/" . $imageName;
	if (file_exists($filePath)) {
		if (unlink($filePath)) {
			mysqli_query($con,"delete from multiple_images where id='$id'");	
		}
	}
}
$req='';
if (isset($_GET['new'])){
	$new = 1;
	$req='required';
}
	
if (isset($_POST['addProduct'])) {
	$title = clear($_POST['title']);
	$description = clear($_POST['description']);
	$category = clear($_POST['category']);
	$color = clear($_POST['color']);
	$price = clear($_POST['price']);
	$size = clear($_POST['size']);
	$productId = clear($_POST['productId']);
	$rating = clear($_POST['rating']);
	$id = generateRandomString();
	$timeAdded = time();





	if ($productId == "") {

	
		$query = "insert into ecommerce_products set id='$id',title='$title',description='$description',timeAdded='$timeAdded',rating='$rating',price='$price',color='$color',size='$size',category='$category'";
		$productId = $id;
	} else
		$query = "update ecommerce_products set title='$title',description='$description',timeAdded='$timeAdded',rating='$rating',price='$price',color='$color',size='$size',category='$category' where id='$productId'";
		$u_r = $con->query($query);
	
		if (isset($_FILES['product_images'])) {

			foreach ($_FILES['product_images']['tmp_name'] as $key => $tmp_name) {
				$imgId = generateRandomString();
				$image_name = $_FILES['product_images']['name'][$key];
				$image_size = $_FILES['product_images']['size'][$key];
				$image_type = $_FILES['product_images']['type'][$key];
				$image_tmp = $_FILES['product_images']['tmp_name'][$key];
				$target_dir = "../uploads/";
				$target_file = $target_dir . basename($image_name);

				if (move_uploaded_file($image_tmp, $target_file)) {

					$image = htmlspecialchars(basename($image_name));

					$query = "INSERT INTO `multiple_images` (`id`, `product_id`, `product_image`) VALUES ('$imgId', '$productId', '$image')";

					$result = $con->query($query);
					if (!$result)
						echo $con->error;
				}
			}
		}

	if (isset($_FILES['imge'])) {
		$target_dir = "../uploads/";
		$target_file = $target_dir . basename($_FILES["imge"]["name"]);

		if (move_uploaded_file($_FILES["imge"]["tmp_name"], $target_file)) {
			$image = htmlspecialchars(basename($_FILES["imge"]["name"]));

			$query = "update ecommerce_products set image='$image' where id='$productId'";

			$result = $con->query($query);
			if (!$result)
				echo $con->error;
			else
				header("Location:home.php?m=Product Updated");
		}
	}
	if (!$u_r)
		echo $con->error;
	else
		header("Location:home.php?m=Product Updated");
	if ($new)
		header("Location:home.php?m=Entry added successfully");
}
$productDeets = getRow($con, "select * from ecommerce_products where id='$productId'");

 $sql = "select id,product_image from multiple_images where product_id='$productId'";

$resMultipleImage = mysqli_query($con, $sql);

if (mysqli_num_rows($resMultipleImage) > 0) {
	
	$jj = 0;
	while ($rowMultipleImage = mysqli_fetch_assoc($resMultipleImage)) {
		$multipleImageArr[$jj]['product_image'] = $rowMultipleImage['product_image'];
	 	$multipleImageArr[$jj]['id'] = $rowMultipleImage['id'];
		$jj++;
	}
	
}
?>

<script>
	var total_image = 1;

	function add_more_images() {
		total_image++;
		var html = '<div class="col-lg-5" style="margin-top:20px;" id="add_image_box_' + total_image + '"><label> Image </label><input name="product_images[]" type="file" class="form-control"name="img" placeholder="img" required><br><button type="button" class="btn btn-danger btn-user btn-block" onclick=remove_image("' + total_image + '")>Remove</button></div>';
		jQuery('#image_box').after(html);
	}

	function remove_image(id) {
		jQuery('#add_image_box_' + id).remove();
	}
</script>

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

				<form method="post" action="" enctype="multipart/form-data">
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<div class="post d-flex flex-column-fluid" id="kt_post">
							<div id="kt_content_container" class="container-xxl" style="max-width: 100%;margin-bottom: 50px;">
								<div class="card card-flush">
									<div class="card-header align-items-center py-5 gap-2 gap-md-5">
										<div class="card-title">
											<div class="d-flex align-items-center position-relative my-1">
												<h2><? if ($new) {

														echo "Add ";
													} else {
														echo "Edit ";
													} ?> Product</h2>
											</div>
										</div>
										<div class="card-toolbar">
										</div>
									</div>
									<div class="card-body pt-0">
										<div class="row">
											<div class="col-12 mb-10">
												<label>Title</label>
												<input type="text" name="title" class="form-control" value="<? echo $productDeets['title'] ?>" required>
											</div>
											<div class="col-12 mb-10">
												<label>Category</label>
												<select class="form-control w-100" name="category">
													<?php
													// Assuming you have a database connection established

													// Fetch categories from the database
													$sql = "SELECT * FROM ecommerce_category";
													$result = mysqli_query($con, $sql);

													// Generate option tags based on retrieved categories
													while ($row = mysqli_fetch_assoc($result)) {
														$categoryId = $row['id'];
														$categoryName = $row['categories'];
														$selected = ($productDeets['category'] == $categoryName) ? 'selected' : '';
														echo '<option value="' . $categoryName . '" ' . $selected . '>' . $categoryName . '</option>';
													}
													?>
												</select>
											</div>

											<div class="col-12 mb-10">
												<label>Color</label>
												<input type="text" name="color" class="form-control" value="<? echo $productDeets['color'] ?>" required>
											</div>
											<div class="col-12 mb-10">
												<label>Size</label>
												<input type="text" name="size" class="form-control" value="<? echo $productDeets['size'] ?>" required>
											</div>
											<div class="col-12 mb-10">
												<label>Price</label>
												<input type="float" name="price" class="form-control" value="<? echo $productDeets['price'] ?>" required>
											</div>
											<div class="col-12 mb-10">
												<label>Rating</label>
												<input type="number" name="rating" class="form-control" value="<? echo $productDeets['rating'] ?>" required>
											</div>
											<div class="col-12 mb-10">
												<label>Description</label>
												<textarea name="description" class="form-control" rows="8"><? echo $productDeets['description'] ?></textarea>
											</div>
											<div class="col-12 mb-10">
											<label><h5>Images :</h5></label>
													<br><br>
													<label>Please Enter image only in jpeg,jpg,png</label>
													<br>
												<input class="form-control" type="file" name="imge" value="" <? echo $req ?>>

												<div id="image_box">
													
													<br><br>
													<button type="button" class="btn btn-primary btn-user btn-block" id="" onclick="add_more_images()">Add More Images</button>
													<?
													  if(isset($multipleImageArr[0])){
														foreach($multipleImageArr as $list){
															echo '<div class="col-lg-6" style="margin-top:20px;" id="add_image_box_'.$list['id'].'"><label for="categories" class=" form-control-label">Image</label><input type="file" name="product_images[]" class="form-control" ><a href="addProduct.php?id='.$id.'&pi='.$list['id'].'" style="color:white;"><button type="button" class="btn btn-lg btn-danger btn-block"><span id="payment-button-amount"><a href="addProduct.php?productId='.$productId.'&id='.$list['id'].'&name='.$list['product_image'].'" style="color:white;">Remove</span></button></a>';
															echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
															echo "<a target='_blank' href='".'../uploads/'.$list['product_image']."'><img width='150px' src='".'../uploads/'.$list['product_image']."'/></a>";
															echo '<input type="hidden" name="product_images_id[]" value="'.$list['id'].'"/></div>';
															
														}
													}	
													?>
												
												</div>


											</div>

											<div class="col-12 mb-10">
											</div>

											<input type="text" name="productId" value="<? echo $productDeets['id'] ?>" hidden>


											<div class="col-12 mb-10" style="text-align: center !important;">
												<input type="submit" name="addProduct" class="btn btn-primary" value="Save Changes">
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<? require("./includes/views/footer.php"); ?>
			</div>
		</div>
		<? require("./includes/views/footerjs.php"); ?>
	</div>
</body>

</html>