
<? 
require_once('global.php');
include('add_to_cart.inc.php');	
//unset($_SESSION['cart']);
$obj= new add_to_cart();
$total_product=$obj->totalProduct();
	$sql="select * from ecommerce_category";
	$result=getAll($sql);

?>

<header class="header-area header-sticky text-center header-default">
	<div class="header-main-sticky">
	
	<div class="header-main-head">
	
    <div class="header-main">
	<div class="container">
            <div class="header-left float-left d-flex d-lg-flex d-md-block d-xs-block">
			
				
				  <div class="contact">
						<i class="material-icons">phone</i>
						<a href="tel:+447476452379">+447476452379</a>
				  </div>
			</div>
		<div class="header-middle float-lg-left float-md-left float-sm-left float-xs-none">
				<div class="logo">
								<a href="index.php"><img src="img/logos/logo.png" alt="logo" width="150" height="50" ></a>		</div>
		</div> 
		<div class="header-right d-flex d-xs-flex d-sm-flex justify-content-end float-right">
		 
		<div class="user-info">
		<button type="button" class="btn">
		<i class="material-icons">perm_identity</i></button>
		<div id="user-dropdown" class="user-menu">
		<ul>
			<? if(isset($_SESSION['USER_LOGIN'])){
				?><li><a href="account.php" class="text-capitalize">My account</a></li>
				<li><a href="order_confirmation.php" class="text-capitalize">Order details</a></li>
			
			<li><a href="#" class="modal-view button" data-toggle="modal" data-target="#modalLogoutForm">Logout</a></li>
			<? }else{?>
			<li><a href="register_form.php" class="modal-view button">Register</a></li>
			<li><a href="" class="modal-view button" data-toggle="modal" data-target="#modalLoginForm">login</a></li>
				<?}?>
		</ul>
		</div>
		</div>
				<div class="cart-wrapper">
				<button type="button" class="btn" onclick="goToCart()">
			<i class="material-icons">shopping_cart</i>
			<span class="ttcount"><?php echo $total_product; ?></span>
		</button>
				          </div>
		</div>
		</div>
	</div>
	</div> 
	<div class="menu">
	<div class="container">
		<!-- Navbar -->
		<nav class="navbar navbar-expand-lg navbar-light d-sm-none d-xs-none d-lg-block navbar-full">
		
		<!-- Navbar brand -->
		<a class="navbar-brand text-uppercase d-none" href="#">Navbar</a>
		
		<!-- Collapse button -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2"
		aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		
		<!-- Collapsible content -->
		<div class="collapse navbar-collapse">
		
		<!-- Links -->
		<ul class="navbar-nav m-auto justify-content-center">
		<li class="nav-item dropdown active">
		<a class="nav-link  text-uppercase" href="index.php">Home</a>
		
		</li>
		<li class="nav-item dropdown mega-dropdown">
		<a class="nav-link dropdown-toggle text-uppercase" >Category</a>
		<div class="dropdown-menu mega-menu v-2 z-depth-1 special-color py-2 px-3">
		  <div class="row">
			
			<div class="">

			<div class="dropdown-menu show">
			<? 
				foreach($result as $r=>$val){?>	
			<a class="dropdown-item" href="products.php?cat=<? echo $val['categories'] ?>"><? echo $val['categories'] ?></a>
				<?}	?>
			</div>  	
	
			</div>
		
		  </div>
		</div>
		</li>
		<!-- <li class="nav-item dropdown">
		<a class="nav-link dropdown-toggle text-uppercase" href="category.html">
			Shop
		  <span class="sr-only">(current)</span>        </a>
		<div class="dropdown-menu mega-menu v-2 z-depth-1 special-color py-3 px-3">
			<div class="sub-menu mb-xl-0 mb-4">
			  <ul class="list-unstyled">
				<li>
				  <a class="menu-item pl-0" href="product-grid.html">
					product grid                </a>                </li>
				<li>
				  <a class="menu-item pl-0" href="product-sticky-right.html">
				   sticky right                  </a>                </li>
				<li>
				  <a class="menu-item pl-0" href="product-extended-layout.html">
					Extended layout                 </a>                </li>
				<li>
				  <a class="menu-item pl-0" href="product-details.html">
					Default layout                </a>                </li>
				<li>
				  <a class="menu-item pl-0" href="product-compact.html">
					compact layout           </a>                </li>
			  </ul>
			</div>
		</div>
		</li> -->
		
		<li class="nav-item dropdown">
		<a class="nav-link text-uppercase" href="contact_us.php">contact us</a>
        </li>
        <li class="nav-item dropdown">
		<a class="nav-link text-uppercase" href="about_us.php">About us</a>
        </li>
        
		</ul>
		<!-- Links -->
		</div>
		<!-- Collapsible content -->
		
		</nav>
		<!-- Navbar -->
		<nav class="navbar navbar-expand-lg navbar-light d-lg-none navbar-responsive">
		
		<!-- Navbar brand -->
		<a class="navbar-brand text-uppercase d-none" href="#">Navbar</a>
		
		<!-- Collapse button -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2"
		aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"><i class='material-icons'>sort</i></span>
		</button>
		
		<!-- Collapsible content -->
		<div class="collapse navbar-collapse" id="navbarSupportedContent2">
		
		<!-- Links -->
		<ul class="navbar-nav m-auto justify-content-center">
		
		<!-- Features -->
		<li class="nav-item">
		<a class="nav-link  text-uppercase" href="index.php">Home</a>
		</li>
		<li class="nav-item dropdown mega-dropdown">
		<a class="nav-link dropdown-toggle text-uppercase" data-toggle="collapse" data-target="#menu3"
		aria-controls="menu3" aria-expanded="false" aria-label="Toggle navigation" >Category</a>
		<div class="dropdown-menu mega-menu v-2 z-depth-1 special-color py-3 px-3" id="menu3">
		  <div class="row">
			<div class="col-md-12 col-xl-4 sub-menu mb-xl-0 mb-4">
			  <ul class="list-unstyled">
			  <div class="">
			<? 
				foreach($result as $r=>$val){?>	
			<a class="dropdown-item" href="products.php?cat=<? echo $val['categories'] ?>"><? echo $val['categories'] ?></a>
				<?}	?>
			</div>  	
	
				<li>
			  </ul>
			</div>
			
		  </div>
		</div>
		</li>
		<!-- Technology -->
		<li class="nav-item dropdown">
		<a class="nav-link text-uppercase" href="contactus.php">contact us</a></li>
        <li class="nav-item dropdown">
		<a class="nav-link text-uppercase" href="aboutus.php">About us</a></li>
        </ul>
		<!-- Links -->
		</div>
		<!-- Collapsible content -->
		
		</nav>
	</div>
	</div>
	</div>
	</div>
	<!-- Logout Modal -->
<div class="modal fade" id="modalLogoutForm" tabindex="-1" role="dialog" aria-labelledby="modalLogoutFormLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLogoutFormLabel">Logout Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to logout?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <a href="logout.php" class="btn btn-primary">Yes</a>
      </div>
    </div>
  </div>
</div>

	</header>

	<style>
.dropdown-menu.show {
  padding: 0.5rem 0; /* Add padding to the menu items */
  border: none; /* Remove the border */
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow */
}

.dropdown-item {
  display: block;
  width: 100%; /* Make the menu items full-width */
  padding: 0.5rem 1rem; /* Add padding to the menu items */
  text-decoration: none; /* Remove the default text decoration */
  color: #333; /* Set the text color */
}

.dropdown-item:hover,
.dropdown-item:focus {
  background-color: #e9ecef; /* Change the background color on hover/focus */
  color: #333; /* Change the text color on hover/focus */
}

	</style>
			<script>
							function goToCart() {
			window.location.href = 'cart.php';
		}

				</script>
