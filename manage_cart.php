<?


include('global.php');
include('add_to_cart.inc.php');

$type=mb_htmlentities($_POST['type']);
if($type!='remove'){
    $qty=mb_htmlentities($_POST['qty']);

}
$pid=mb_htmlentities($_POST['pid']);


$obj= new add_to_cart();

        if($type=='add')    
        {
            $obj->addProduct($pid,$qty);
        }
    
        if($type=='remove')
        {
            $obj->deleteProduct($pid);
        }
        
        // if($type=='update')
        // {
        
        //     $obj->updateProduct($pid,$qty,$size);
        // }
    echo $obj->totalProduct();