<?php
session_start();
ob_start();
include "module/PDO.php";
include "module/loai.php";
<<<<<<< Updated upstream
=======
include "module/sanpham.php";
include "module/account.php";
include "module/comment.php";
include "module/order.php";
include "module/banner.php";
include "module/static.php";
include "view/header.php";

>>>>>>> Stashed changes
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
        case 'login':{
            if(isset($_POST['submit'])){
                $error = [];
                if(empty($_POST['email'])){
                    $error['email'] = "Bạn chưa nhập email";
                }
                if(empty($_POST['password'])){
                    $error['password'] = "Bạn chưa nhập mật khẩu";
                }
                if(empty($error)){
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $data = account_user_login($email,$password);
            if($data){
                   extract($data);
                if($email == $email && $mat_khau == $password){
                    $_SESSION['ten_khach_hang'] = $ten_khach_hang;
                    $_SESSION['email'] = $email;
                    $_SESSION['ma_khach_hang'] = $ma_khach_hang;    
                    $_SESSION['$avt'] = $avt;
                    header("location:index.php");
                } else {
                    $error['login'] = "Mật khẩu hoặc tài khoản không đúng";
                }
            } else {
                $error['login'] = "Mật khẩu hoặc tài khoản không đúng";
            }
        
                }
            }   
            include "view/khachhang/login.php";
            break;
        }
        case 'register':{
            if(isset($_POST['submit'])){
                $error = [];
                if(empty($_POST['email'])){
                    $error['email'] = "Bạn chưa nhập email";
                }
                if(empty($_POST['password'])){
                    $error['password'] = "Bạn chưa nhập mật khẩu";
                }
                if(empty($_POST['repassword'])){
                    $error['repassword'] = "Bạn chưa nhập lại mật khẩu";
                }
                if(empty($_POST['hoten'])){
                    $error['hoten'] = "Bạn chưa nhập họ tên";
                }
                if(empty($_POST['phonenumber'])){
                    $error['phonenumber'] = "Bạn chưa nhập số điện thoại";
                }
                if(empty($_POST['agree'])){
                    $error['agree'] = "Bạn chưa đồng ý điều khoản";
                }
                if(empty($error)){
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $repassword = $_POST['repassword'];
                    $hoten = $_POST['hoten'];
                    $phonenumber = $_POST['phonenumber'];
                    $data = account_check_email($email);
                    if($data){
                        $error['email'] = "Email đã tồn tại";
                    } else {
                        if($password != $repassword){
                            $error['repassword'] = "Mật khẩu không trùng khớp";
                        } else {
                            $data = account_user_register($email,$password,$hoten,$phonenumber);
                            if($data){
                                $_SESSION['sussec'] = "Đăng ký thành công";
                                header("location:index.php?act=login");
                            }
                        }
                    }
                 
                }
            }
            include "view/khachhang/register.php";
            break;
        }
        case 'account':{
            if(!isset($_SESSION['ten_khach_hang'])){
                $_SESSION['faill_login'] = "Bạn chưa đăng nhập";
                header("location:index.php?act=login");

            }
            if(isset($_POST['submit'])){
                $error = [];
                if(empty($_POST['name'])){
                    $error['hoten'] = "Bạn chưa nhập họ tên";
                }
                if(empty($_POST['sdt'])){
                    $error['phonenumber'] = "Bạn chưa nhập số điện thoại";
                }
                if(empty($_POST['diachi'])){
                    $error['diachi'] = "Bạn chưa nhập địa chỉ";
                }
                if(empty($_POST['email'])){
                    $error['email'] = "Bạn chưa nhập email";
                }
                if(empty($error)){
                    $ten_khach_hang = $_POST['name'];
                    $sdt = $_POST['sdt'];
                    $dia_chi = $_POST['diachi'];
                    $email = $_POST['email'];
                    $ma_khach_hang = $_POST['makh'];;
                    $avt = $_FILES['avt']['name'];
                    //check image
                            if(empty($_FILES['avt']['name'])){
                                $avt = $data['avt'];
                            } else {
                                $target_dir = "../image/";  
                                $target_file = $target_dir . basename($_FILES["avt"]["name"]);
                                if (move_uploaded_file($_FILES["avt"]["tmp_name"], $target_file)) {
                                    // echo "File " . htmlspecialchars(basename($_FILES["avt"]["name"])) . " đã được tải lên.";
                                } else {
                                    // echo "deafut = noimage.jpg";
                                }
                            }
                        account_update($ten_khach_hang,$dia_chi,$sdt,$email,$avt,$ma_khach_hang);
                  
                        $_SESSION['sussec'] = "Cập nhật thành công";
                        header("location:index.php?act=account");
                }
                

            }

            if(isset($_POST['updatepassword'])){
                $error = [];
                if(empty($_POST['oldpass'])){
                    $error['password'] = "Bạn chưa nhập mật khẩu";
                }   
                if(empty($_POST['newpass'])){
                    $error['newpassword'] = "Bạn chưa nhập mật khẩu mới";
                }
                if(empty($_POST['repass'])){
                    $error['repassword'] = "Bạn chưa nhập lại mật khẩu";
                }
                if(empty($error)){
                    $oldpass = $_POST['oldpass'];
                    $newpassword = $_POST['newpass'];
                    $repassword = $_POST['repass'];
                    $ma_khach_hang = $_SESSION['ma_khach_hang'];
                    $data = account_get_password($ma_khach_hang);
                    if($data){
                        extract($data);
                        if($oldpass == $mat_khau){
                            if($newpassword != $repassword){
                                $error['repassword'] = "Mật khẩu không trùng khớp";
                            } else {
                                $data = account_update_password($newpassword,$ma_khach_hang);
                                if($data){
                                    $_SESSION['sussec'] = "Cập nhật thành công";
                                    header("location:index.php?act=account");
                                }
                            }
                        } else {
                            $error['oldpass'] = "Mật khẩu không đúng";
                        }
                    }
                }

            }

            include "view/khachhang/account.php";
            break;
        }
        case 'chitietdh':{
            if(isset($_GET['ma_don_hang'])){
                $ma_don_hang=$_GET['ma_don_hang'];
                $data = donhang_get_chi_tiet($ma_don_hang);
            }
            include "view/khachhang/ctdonhang.php";
            break;  
        }
        case 'logout':{
            session_destroy();
            header("location:index.php");
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
ob_end_flush();
?>