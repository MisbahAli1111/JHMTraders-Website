<?
require_once('global.php');


$name=mb_htmlentities($_POST['text']);

echo $query=mysqli_query($con,"SELECT id FROM ecommerce_products WHERE title LIKE '%$name%' OR description LIKE '%$name%'");


?>
