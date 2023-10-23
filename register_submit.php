<?php
include('global.php');


$name=mb_htmlentities($_POST['name']);
$email=mb_htmlentities($_POST['email']);
$phone_no=mb_htmlentities($_POST['phone_no']);
$city=mb_htmlentities($_POST['city']);
$post_code=mb_htmlentities($_POST['post_code']);
$country=mb_htmlentities($_POST['country']);
$address=mb_htmlentities($_POST['address']);
$password=mb_htmlentities($_POST['password']);
$id=generateRandomString();
$timeAdded=time();

$hashedpassword=password_hash($password,PASSWORD_DEFAULT);
$check_user=mysqli_num_rows(mysqli_query($con,"select * from ecommerce_customers where email= '$email'"));
$check_admins=mysqli_num_rows(mysqli_query($con,"select * from jhm_admins where email= '$email'"));

if($check_user>0 || $check_admins>0)
{
    header('Location:register_form.php?msg=Email Already Exist');
}
else{
    $sql="INSERT INTO `ecommerce_customers` (`id`, `name`, `email`, `phone no`, `address`, `post_code`, `city`, `country`, `registered_on`, `password`) VALUES ('$id', '$name', '$email', '$phone_no', '$address', '$post_code', '$city', '$country', '$timeAdded', '$hashedpassword')";
    $result=mysqli_query($con,$sql);
    header('Location:register_form.php?success=Email Registered Successfully! Please Login to Continue Shopping');
}


?>