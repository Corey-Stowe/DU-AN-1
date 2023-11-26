<?php
session_start();
ob_start();
include "module/PDO.php";
include "module/loai.php";
include "module/sanpham.php";
include "module/account.php";
include "module/comment.php";
include "module/order.php";
include "module/banner.php";
include "module/static.php";
include "view/header.php";
//update cart
if(isset($_POST['updatecart'])){
    $soluongupdate=$_POST['soluongupdate'];
    for ($i=0; $i < sizeof($_SESSION['giohang']); $i++) {
            $_SESSION['giohang'][$i][5]=$soluongupdate;
            break;
    }
}
//xóa sp trong giỏ hàng
if(isset($_GET['delid'])&&($_GET['delid']>=0)){
    array_splice($_SESSION['giohang'],$_GET['delid'],1); 
    header("Location: index.php");
}
if(isset($_GET['delidct'])&&($_GET['delidct']>=0)){
    array_splice($_SESSION['giohang'],$_GET['delidct'],1); 
    header("Location: index.php?act=viewcart");
}
//xóa giỏ hàng
if(isset($_GET['delcart'])&&($_GET['delcart']==1)){unset($_SESSION['giohang']);header("Location: index.php");}
if(isset($_GET['delcartct'])&&($_GET['delcartct']==1)){unset($_SESSION['giohang']);header("Location: index.php?act=viewcart");}
if(!isset($_SESSION['giohang'])) $_SESSION['giohang']=[];
if(isset($_POST['addcart'])){
    $idsp=$_POST['masp'];
    $tensp=$_POST['tensp'];
    $gia=$_POST['gia'];
    $giam_gia=$_POST['giam_gia'];
    $hinh=$_POST['img'];
    $soluong=$_POST['soluong'];
    $ttien=$soluong*$giam_gia;
    //kiểm tra sản phẩm có trong giỏ hàng hay chưa
    $fl=0;
    for ($i=0; $i < sizeof($_SESSION['giohang']); $i++) {
        if($_SESSION['giohang'][$i][1]==$tensp){
            $fl=1;
            $soluongnew=$soluong+$_SESSION['giohang'][$i][5];
            $_SESSION['giohang'][$i][5]=$soluongnew;
            break;

        }
    }
    if($fl==0){
    //them mới vào cart
    $spadd=[$idsp,$tensp,$gia,$giam_gia,$hinh,$soluong,$ttien];
    $_SESSION['giohang'][]=$spadd;
}
    }

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
            if(isset($_POST['binhluan'])){
                $ma_san_pham=$_POST['masp'];
                $ma_khach_hang=$_SESSION['ma_khach_hang'];
                $noi_dung=$_POST['message'];
                $ngay_binh_luan= date('Y-m-d');
                $anhbl=$_FILES['img']['name'];
                $target_dir = "image/";
                  $target_file = $target_dir . basename($_FILES['img']['name']);
                  if(move_uploaded_file($_FILES['img']['tmp_name'], $target_file)){
  
                 }else{
                    $anhbl=" ";
                 }
                          comment_insert($ma_san_pham,$ma_khach_hang,$noi_dung,$ngay_binh_luan,$anhbl);
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
        case 'search': {
            $key = ''; // Set a default value for $key
        
            if (isset($_POST['submit'])) {
                $key1 = $_POST['key'];
                $_SESSION['kwords'] = $key1;
                $key = $key1; // Update $key with the new value
                $data = san_pham_search($key);
            }
        
            if (isset($_GET['odercode'])) {
                $key = ''; // Set a default value for $key
                $odercode = $_GET['odercode'];
                $key = $_SESSION['kwords'];
                $data = sanpham_search_orderby($key, $odercode);
            } 
        
            include "view/search/list.php";
            break;
        }
        case 'listspdm':{
            if(isset($_GET['ma_loai'])){
                if(is_numeric($_GET['ma_loai'])){
                    $ma_loai = $_GET['ma_loai'];
                    $data = list_sanpham_by_danhmuchot($ma_loai);
                } else {
                   $data = sanpham_list();
                }
            }
            include "view/listsanpham/list.php";
            break;
        }
        case 'viewcart':{
            include "view/shopping&cart.php";
            break;
        }
        case 'logout':{
            unset($_SESSION['ten_khach_hang']);
            unset($_SESSION['email']);  
            unset($_SESSION['ma_khach_hang']);      
            unset($_SESSION['$avt']);
            header("location:index.php");
            break;
        }
        case '404':{
            include "view/404.php";
            break;
        
        }
        case 'wishlist':{
            //xóa sp trong yt
                if(isset($_GET['del_yt_id'])&&($_GET['del_yt_id']>=0)){
                    array_splice($_SESSION['sp_yeu_thich'],$_GET['del_yt_id'],1); 
                    header("Location: index.php?act=wishlist");
                }
                //add yêu thích 
                if(!isset($_SESSION['sp_yeu_thich'])) $_SESSION['sp_yeu_thich']=[];              
                if(isset($_POST['add_wishlist'])){ 
                    $id_yt=$_POST['ma_sp'];
                    $ten_yt=$_POST['ten_sp'];
                    $gia_yt=$_POST['gia_sp'];
                    $giam_gia_yt=$_POST['giam_gia_sp'];
                    $hinh_yt=$_POST['img'];
                    $so_luong_yt=$_POST['soluongkho'];
                    $soluong2=1;
                    $fl=0;
                        for ($i=0; $i < sizeof($_SESSION['sp_yeu_thich']); $i++) {
                            if($_SESSION['sp_yeu_thich'][$i][0]==$id_yt){
                                $fl=1;
                                $soluong2++;
                                $_SESSION['sp_yeu_thich'][$i][6]=$soluong2;
                                break;

                            }
                        }
                        if($fl==0){
                        //them mới vào yt
                        $sp_yt=[$id_yt,$ten_yt,$gia_yt,$giam_gia_yt,$hinh_yt,$so_luong_yt,$soluong2];
                        $_SESSION['sp_yeu_thich'][]=$sp_yt;
                    }    
                }
                
            include "view/wishlist.php";
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