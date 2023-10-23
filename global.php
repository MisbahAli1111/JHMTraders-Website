<?php
session_start();
include("./database.php");
if(!isset($_SESSION['USER_LOGIN'])){
	global $login;
    $login = 0;
}
function getAll($query)
{

	global $con;
	$myArray=array();
	$result=$con->query($query);
	if(!$result)
			echo $con->error;
	$index=0;
	while($row=$result->fetch_assoc())
	{
		$myArray[$index++]=$row;	
	}
	return $myArray;
}
function getRow($query)
{
	global $con;
	$myArray=array();
	$query=$query." limit 1";
	$result=$con->query($query);
	if(!$result)
			echo $con->error;
	$index=0;
	while($row=$result->fetch_assoc())
	{
		$myArray[$index++]=$row;	
	}
	return $myArray;
}


function generateRandomString($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function mb_htmlentities($string, $hex = true, $encoding = 'UTF-8') {
    global $con;
    return mysqli_real_escape_string($con, $string);
}


?>