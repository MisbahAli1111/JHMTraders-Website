<?
class add_to_cart{
        function addProduct($pid,$qty){
            $_SESSION['cart'][$pid]=$qty;
        }

        // function updateProduct($pid,$qty,$attr_id){
        //     if(isset($_SESSION['cart'][$pid][$attr_id]))
        //     {
        //         $_SESSION['cart'][$pid]['qty']=$qty;
    
        //     }
        // }
        function deleteProduct($pid){
            if(isset($_SESSION['cart'][$pid])){
                unset($_SESSION['cart'][$pid]);
            }
        }
        function emptyProduct(){
            unset($_SESSION['cart']);
        }

        function totalProduct() {
            if (isset($_SESSION['cart'])) {
                return count($_SESSION['cart']);
            } else {
                return 0;
            }
        }
        
        
    }