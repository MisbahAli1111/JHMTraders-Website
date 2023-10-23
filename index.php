<? include('includes/header.php');
include('includes/topmenu.php');

?>

<body class="index layout1">


	<main>

		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div class="slider-wrapper my-40 my-sm-25 float-left w-100">
			<div class="container">
				<div class="ttloading-bg"></div>
				<div class="slider slider-for owl-carousel">
					<div>
						<a href="">
							<img src="img/slider/sample-01.jpg" alt="" height="800" width="1600" />
						</a>
						<div class="slider-content-wrap center effect_top">
							<div class="slider-title mb-20 text-capitalize float-left w-100">our specials</div>
							<div class="slider-subtitle mb-50 text-capitalize float-left w-100">fashion trend</div>
						</div>
					</div>
					<div>
						<a href="">
							<img src="img/slider/sample-02.jpg" alt="" height="800" width="1600" />
						</a>
						<div class="slider-content-wrap center effect_bottom">
							<div class="slider-title mb-20 text-capitalize float-left w-100">about us</div>
							<div class="slider-subtitle mb-50 text-capitalize float-left w-100">fashion style</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="main-content">
			<div id="ttcmsbanner" class="ttcmsbanner my-40 my-sm-25">
				<div class="ttbannerblock container text-center">
					<div class="row">
						<!-- <div class="ttbanner1 ttbanner col-sm-6 col-xs-6 left-to-right hb-animate-element">
						<div class="ttbanner-img"><a href="#"><img src="img/banner/cms-01.jpg" alt="cms-01" height="600" width="630"></a></div>
						  <div class="ttbanner-inner d-inline-block align-top float-none">
							<div class="ttbanner-desc float-left w-100">
								<h2 class="ttbanner-heading text-uppercase float-left w-100">Black</h2>
								<span class="title text-uppercase float-left w-100 pb-3">collection</span> 
								<span class="subtitle float-left w-100 py-20">Et harum quidem rerum facilis est et expedita m libero tempore, cum solut</span> 
								<span class="shop-now float-left w-100"><a href="#" class="d-inline-block align-top float-none btn-primary">Shop Now</a></span>							</div>
						 </div>
					  </div>
						  <div class="ttbanner2 ttbanner col-sm-6 col-xs-6 right-to-left hb-animate-element">
                                                      <div class="ttbanner-img"><a href="#"><img src="img/banner/cms-02.jpg" alt="cms-02" height="600" width="630"></a></div>
							<div class="ttbanner-inner d-inline-block align-top float-none">
							  <div class="ttbanner-desc">
								<h2 class="ttbanner-heading text-uppercase">Men's</h2>
								<span class="title text-uppercase float-left w-100 pb-3">collection</span> 
								<span class="subtitle float-left w-100 py-20">Et harum quidem rerum facilis est et expedita m libero tempore, cum solut</span> 
								<span class="shop-now float-left w-100"><a href="#" class="d-inline-block align-top float-none btn-primary">Shop Now</a></span>							  </div>
							</div>
						 </div> -->
					</div>
				</div>
			</div>
			<div id="main">
				<div id="hometab" class="home-tab my-40 my-sm-25 bottom-to-top hb-animate-element">
					<div class="container">
						<div class="row">
							<div class="tt-title d-inline-block float-none w-100 text-center">Trending Products</div>
							<div class="tabs">
								<ul class="nav nav-tabs justify-content-center">
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#ttnew-main" id="new-tab">
											<div class="tab-title">Latest</div>
										</a></li>
								</ul>
							</div>
							<div class="tab-content float-left w-100">
								<div class="tab-pane active float-left w-100" id="ttfeatured-main" role="tabpanel" aria-labelledby="featured-tab">
									<section id="ttfeatured" class="ttfeatured-products">
										<div class="ttfeatured-content products grid owl-carousel" id="owl1">
											<? $array = getAll("select * from ecommerce_products");
											foreach ($array as $row) {


											?>
												<div class="product-layouts">
													<div class="product-thumb">
														<div class="image zoom">
															<a href="product_details.php?id=<?echo $row['id']?>">
																<div class="image-container">
																	<img src="uploads/<? echo $row['image'] ?>" alt="01" class="product-image" />
																	<img src="uploads/<? echo $row['image'] ?>" alt="02" class="second_image img-responsive product-image" />
																</div>
															</a>
														</div>
														<div class="thumb-description">
															<div class="caption">
																<h4 class="product-title text-capitalize"><a href="product-details.html"><? echo $row['title']; ?></a></h4>
															</div>
															<div class="rating">
																<?php for ($x = 0; $x < 5; $x++) { ?>
																	<?php if ($x <  $row['rating']) { ?>
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
																<div class="price">
																	<div class="old-price"> <? echo $row['price']; ?></div>
																</div>
																
															</div>
														</div>
													</div>

												<? } ?>
												</div>
									</section>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="ttcmstestimonial" class="my-40 my-sm-25 bottom-to-top hb-animate-element">
					<div class="tttestimonial-content container">
						<div class="tttestimonial-inner">
							<div class="tttestimonial owl-carousel">
								<div>
									<div class="testimonial-block">
										<div class="testimonial-content">
											<div class="testimonial-desc">
												<p>Discover Quality Products, Unmatched Service. Shop with Confidence at JHM Traders.</p>
											</div>
											<div class="testimonial-user-title">
												<h4>JHM Traders</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="ttspecial" class="ttspecial my-40 bottom-to-top hb-animate-element">
					<div class="container">
						<div class="row">
							<div class="tt-title d-inline-block float-none w-100 text-center">special products</div>
							<div class="ttspecial-content products grid owl-carousel">
							<? $array = getAll("SELECT * FROM ecommerce_products ORDER BY id DESC;");
											foreach ($array as $row) {


											?>
												<div class="product-layouts">
													<div class="product-thumb">
														<div class="image zoom">
															<a href="product_details.php?id=<?echo $row['id']?>">
																<div class="image-container">
																	<img src="uploads/<? echo $row['image'] ?>" alt="01" class="product-image" />
																	<img src="uploads/<? echo $row['image'] ?>" alt="02" class="second_image img-responsive product-image" />
																</div>
															</a>
														</div>
														<div class="thumb-description">
															<div class="caption">
																<h4 class="product-title text-capitalize"><a href="product-details.html"><? echo $row['title']; ?></a></h4>
															</div>
															<div class="rating">
																<?php for ($x = 0; $x < 5; $x++) { ?>
																	<?php if ($x <  $row['rating']) { ?>
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
																<div class="price">
																	<div class="old-price"> <? echo $row['price']; ?></div>
																</div>
																
															</div>
														</div>
													</div>

												<? } ?>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</main>
	<style>
		.product-image {
			height: 300px;
			/* Set the desired height for the images */
			width: 300px;
			/* Set the desired width for the images */
		}
	</style>

	<!-- Footer -->
	<? include('includes/footer.php'); ?>