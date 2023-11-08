<?php
include "../module/PDO.php";
include "../module/loai.php";
include "header.php";

    if(isset($_GET['act'])){
        $act=$_GET['act'];
        switch ($act){
            case 'listdm':
                $data=loai_list();
                include "loaihang/list.php";
                break;
        }
    } else {
        include "body.php";
    }

?>