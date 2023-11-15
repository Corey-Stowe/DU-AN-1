<?php
include "view/header.php";
include "module/PDO.php";
include "module/loai.php";
if(isset($_GET['act'])){
    $act=$_GET['act'];
    switch ($act){
        case 'ctsp':{
            include "view/chitetsp.php";
            break;
        }
        case 'cart':{
            include "view/cart.php";
            break;
        }
        case 'order':{
            include "view/order.php";
            break;
        }
        default:{
            include "view/body.php";
            break;
        }   
    }
} else {
    include "view/body.php";
}
include "view/footer.php";
?>