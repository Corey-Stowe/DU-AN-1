<?php
session_start();
ob_start();
include "../module/PDO.php";
include "../module/loai.php";
include "head.php";
    if(isset($_GET['act'])){
        $act=$_GET['act'];
        switch ($act){
            case 'listdm':{
                $data=loai_list();
                include "loaihang/list.php";
                break;
            }
            case 'adddm':{
                if(isset($_POST['submit'])){
                    $ten_loai=$_POST['ten_loai'];
                    loai_insert($ten_loai); 
                    $_SESSION['success']="Sửa thành công";   
                    header("Location: admin.php?act=listdm");       

                }   
                include "loaihang/add.php";
                break;
            }
            case 'editdm':{
                if(isset($_GET['ma_loai'])){
                    $ma_loai=$_GET['ma_loai'];
                    $data=loai_get_byid($ma_loai);          
                    extract($data);
                } 
                if(isset($_POST['submit'])){
                    $ma_loai=$_POST['ma_loai'];
                    $ten_loai=$_POST['ten_loai'];
                    loai_update($ma_loai,$ten_loai); 
                    header("Location: admin.php?act=listdm");
                    $_SESSION['success']="Sửa thành công";       

                }   
                include "loaihang/edit.php";
                break;
            }
            case 'sdeldm':{
                $ma_loai=$_GET['ma_loai'];
                loai_soft_delete($ma_loai);
                header("Location: admin.php?act=listdm");
                break;
            }
                case 'softdell':{
                $data=loai_soft_delete_list();
                include "loaihang/listsdell.php";
                break;

            }
            case 'recoverdm':{
                $ma_loai=$_GET['ma_loai'];
                loai_recover($ma_loai);
                header("Location: admin.php?act=softdell");
                break;
            }
            case 'deldm':{
                $ma_loai=$_GET['ma_loai'];
                loai_delete($ma_loai);
                header("Location: admin.php?act=listdm");
                break;
            }
            case '404':{
                include "404.php";
                break;
            }
        default:{
                include "body.php";
                break;
            }
        }
    } else {
        include "body.php";
    }
    ob_end_flush();
?>