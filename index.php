<?php
session_start();
ob_start();
include "view/header.php";
include "module/PDO.php";
include "module/loai.php";
include "module/account.php";
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
        case "login":
            $thongbao="vui lòng nhập tài khoản và mật khẩu";
            if(isset($_POST['login'])){
                // lấy dữ liệu nhập vào
                $emailnhap=$_POST['user_login_email'];
                $passnhap=$_POST['user_login_password'];
                $checkuser2=checkuserclien($emailnhap,$passnhap);
                if(is_array($checkuser2)){
                    $_SESSION['user2']=$checkuser2;
                    extract($_SESSION['user2']);
                    if($emailnhap=$_SESSION['user2'] && $passnhap=$_SESSION['user2']){
                        header('location: index.php');
                    }else{
                        $thongbao="SAI TÀI KHOẢN HOẶC MẬT KHẨU";
                        
                    }
                }
            }
            include "view/kh/login.php";    
            break;
        case "logout":
                session_unset();
                header('Location: index.php');
                if(isset($_POST['logout'])){
                    session_unset();
                    header('Location: index.php');
                }
            break;
        case "sigup":
            if(isset($_POST['dangky'])){
                $email=$_POST['email'];
                $hoten=$_POST['hoten'];
                $pass=$_POST['password'];
                $phone=$_POST['phonenumber'];
                $dia_chi=$_POST['dia_chi'];
                insert_taikhoan($email,$hoten,$pass,$phone,$dia_chi);
                $thongbao="Đăng Ký Thành công";
            }else{
                $thongbao="Bạn Chưa Nhập Đầy Đủ Thông Tin";
            }
            include "view/kh/sigup.php";
            break;
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