<?php

include('global.php');
$email=mb_htmlentities($_POST['email']);
$password=mb_htmlentities($_POST['password']);
//$password='123'; 
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
// echo $hashedPassword;

$res=mysqli_query($con,"select * from ecommerce_customers where email='$email'");
$res_admin=mysqli_query($con,"select * from jhm_admins where email='$email'");
$check_admin=mysqli_num_rows($res_admin);
$check_user=mysqli_num_rows($res);
if($check_user>0){

	
	while($row=mysqli_fetch_assoc($res)){
		if(password_verify($password,$row['password']))
		{
			$_SESSION['USER_LOGIN']='yes';
			$_SESSION['USER_ID']=$row['id'];
			$_SESSION['USER_NAME']=$row['name'];
			$_SESSION['USER_EMAIL']=$row['email'];
			
			echo "valid";
			die();
		}
        else{
			echo "wrong";
			die();
		}

	}
}
// for admin
if($check_admin>0){

	while($rowA=mysqli_fetch_assoc($res_admin)){
		if(password_verify($password,$rowA['password']))
		{
			$_SESSION['email'] = $rowA['email'];
			$_SESSION['password'] = $rowA['password'];
			echo "validAdmin";
		}
        else{
			echo "wrong";
			die();
		}

	}
}
else{
	echo "wrong";
}


// $password = "123";
// $hashedPassword = '$2y$10$B./GJLasjCsqRnreDP5zpOczdZhsoslg1X.PV0KkV0vVsn/Ni7aru';

// if (password_verify($password, $hashedPassword)) {
//     echo "Password is correct";
// } else {
//     echo "Password is incorrect";
// }

?> 