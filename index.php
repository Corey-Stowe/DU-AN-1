<?php
include "view/header.php";
include "module/PDO.php";
include "module/loai.php";
include "module/sanpham.php";
include "module/account.php";
include "module/comment.php";
include "module/order.php";
include "module/banner.php";
$list = banner_list();
if(isset($_GET['act'])){
    $act=$_GET['act'];
    switch ($act){
        case 'ctsp':{
            if(isset($_GET['ma_san_pham'])){
                $ma_san_pham = $_GET['ma_san_pham'];
                $data = sanphamct_get_byid($ma_san_pham);
                $data1 = sanpham_load_ctbl($ma_san_pham);
                $data2 = sanpham_count_ctbl($ma_san_pham);
                sanpham_add_luotxem($ma_san_pham);
             
            }
            include "view/chitietsp/chitetsp.php";
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