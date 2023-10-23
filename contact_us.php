
<? 
require_once("global.php");
    $msg="";

    
if(isset($_POST['contact'])){
        $name=mb_htmlentities($_POST['name']);
        $email=mb_htmlentities($_POST['email']);
        $subject=mb_htmlentities($_POST['subject']);
        $message=mb_htmlentities($_POST['message']);
        $timeAdded=time();
        $id=generateRandomString();
        $query=mysqli_query($con,"INSERT INTO `ecommerce_contactus` (`id`, `message`, `title`, `email`, `timeAdded`, `name`) VALUES ('$id', '$message', '$subject', '$email', '$timeAdded', '$name')");
        if(!$query){
            echo $con->error;
        }else{
            header("Location:contact_us.php?m=success");
        }
    }
    include('includes/header.php');
    include('includes/topmenu.php');

?>

<nav aria-label="breadcrumb" class="w-100 float-left">
  <ol class="breadcrumb parallax justify-content-center" data-source-url="img/banner/parallax.jpg" style="background-image: url(&quot;img/banner/parallax.jpg&quot;); background-position: 50% 0.809717%;">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">contact us</li>
  </ol>
</nav>
    	<div class="main-content w-100 float-left"> 
		<div class="container">
			<div class="row">
			<!--Google map-->
<div id="map-container-google-1" class="z-depth-1-half map-container col-sm-12 mb-50" style="height: 500px">
<iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d59512.74927226758!2d72.81491575568408!3d21.210153908095307!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e0!4m5!1s0x3be04efc0f8687bd%3A0xc783857ba5d79622!2sTemplateTrip%2C+4030%2C+Central+Bazzar%2C+opp.+Varachha+Police+Station%2C+Varachha+Main+Road%2C+Surat%2C+Gujarat+395006!3m2!1d21.2100775!2d72.84993519999999!4m0!5e0!3m2!1sen!2sin!4v1565339377691!5m2!1sen!2sin" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>

</div>

                    
				<div class="contact-form-area col-sm-7">
				<?if(isset($_GET['m'])){?>
    <div style="text-align: center;">
        <span class="alert alert-success">Your Message Has Been Delivered</span>
    </div>
    <?}?>
                <div class="contact-form-inner">
					<h4 class="text-capitalize">Contact Us</h4>
					<form id="contact-form" method="post">
                    <div class="row">
                        <div class="col-md-12">
							<label for="name" class="float-left">Name<span class="required">*</span></label>
                            <input type="text" name="name" id="name" class="float-right" required>
                        </div>
                        <div class="col-md-12">
 							<label for="email" class="float-left">Email<span class="required">*</span></label>
                            <input type="text" name="email" id="email" class="float-right" required>
                        </div>
                        <div class="col-md-12">
 							<label for="subject" class="float-left">Subject<span class="required">*</span></label>
                            <input type="text" name="subject" id="subject" class="float-right" required>
                        </div>
						<div class="col-md-12">
							<label for="message" class="float-left">Message</label>
							<textarea name="message" id="message" class="float-right"></textarea>
                        </div>
                    </div>
					<input type="submit" class="submit-btn default-btn btn-primary btn" name="contact" value="Send Email">
                    <p class="form-messege"></p>
                </form>
				</div>
				</div>
				<div class="contact-address col-sm-5">
				<div class="contact-inner float-left w-100">
                <div class="contact-information">
									<h4 class="text-capitalize">contact us</h4>

                    <p>We would love to hear from you! If you have any questions, inquiries, or feedback, please feel free to reach out to us using the contact information below. Our dedicated team is here to assist you.</p>
                    <div class="contact-wrapper">
                        <div class="contact-list">
                           <i class="material-icons">place</i>
                            <span><strong>Address</strong> &nbsp;: Unit: 21088<br>
                            Street: 61A Bridge street<br>
                                City: Kington<br>
                                County: Herefordshire<br>
                                Post code: HR5 3DJ<br>
                                UNITED KINGDOM</span>
                        </div>
                        <div class="contact-list">
                           <i class="material-icons">call</i>
                            <span>+447476452379</span>
                        </div>
                        <div class="contact-list">
                          <i class="material-icons">email</i>
                            <span>info@jhmtraders.com</span>
                        </div>
                    </div>
                </div>
                <div class="working-time">
                    <h5>Working hours</h5>
                    <div>
					<div>24/7</div>
					</div>
                </div>
				</div>
				</div>
			</div>
		</div>
		</div>
		</body>
</html>
<style>
    .success-message {
        background-color: #dff0d8;
        color: #3c763d;
        padding: 10px;
        border: 1px solid #d6e9c6;
        border-radius: 4px;
    }
</style>
<? include('includes/footer.php'); ?>




