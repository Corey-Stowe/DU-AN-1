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
if(isset($_SESSION['cart'])){
    $cart = $_SESSION['cart'];
    //tính tổng
    function calculateTotal() {
        $total = 0;
    
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $product) {
                $total += $product['so_luong'] * $product['giam_gia'];
                // Nếu bạn muốn tính tổng theo giá không giảm giá, thay $product['giam_gia'] bằng $product['don_gia']
            }
        }
    
        return $total;
    }
    $total = calculateTotal();
}
include "view/extension/cart.php";
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
        case 'cart': {
            if (isset($_POST['addcart'])) {
                $ma_san_pham = $_POST['ma_san_pham'];
                $so_luong = $_POST['so_luong'];
                $ten_san_pham = $_POST['ten_san_pham'];
                $don_gia = $_POST['don_gia'];
                $giam_gia = $_POST['giam_gia'];
                $anh = $_POST['anh'];
        
                // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
                $product_exists = false;
                
                if (isset($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $key => $product) {
                        if ($product['ma_san_pham'] == $ma_san_pham) {
                            // Nếu sản phẩm đã tồn tại trong giỏ hàng, tăng số lượng lên
                            $_SESSION['cart'][$key]['so_luong'] += $so_luong;
                            $product_exists = true;
                            header("location:index.php?act=cart");
                            break;
                        }
                    }
                }
        
                // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới
                if (!$product_exists) {
                    $product = array(
                        'ma_san_pham' => $ma_san_pham,
                        'so_luong' => $so_luong,
                        'ten_san_pham' => $ten_san_pham,
                        'don_gia' => $don_gia,
                        'giam_gia' => $giam_gia,
                        'anh' => $anh
                    );
        
                    if (!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = array($product);
                        header("location:index.php?act=cart");
                    } else {
                        $_SESSION['cart'][] = $product;
                        header("location:index.php?act=cart");
                    }
                }
            }
        
            include "view/cart.php";
            break;
        }
        case'cartupdate':{
            if (isset($_POST['dellprod'])) {
                $ma_san_pham_xoa = $_POST['ma_san_pham'];
            
                // Tìm kiếm và xóa sản phẩm khỏi giỏ hàng trong $_SESSION
                if (isset($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $key => $product) {
                        if ($product['ma_san_pham'] == $ma_san_pham_xoa) {
                            unset($_SESSION['cart'][$key]);
                            header("location:index.php?act=cart");
                        }
                    }
                }
            }
            
            // Xử lý khi người dùng ấn nút "Xóa toàn bộ giỏ hàng"
            if (isset($_POST['clearallcart'])) {
                // Xóa toàn bộ giỏ hàng trong $_SESSION
                unset($_SESSION['cart']);
                header("location:index.php?act=cart");
            }
            
                    // Chỉ xử lý khi người dùng nhấn nút "Cập nhật giỏ hàng" từ trang cart
                    if (isset($_POST['updatecart'])) {
                        // Lặp qua sản phẩm trong giỏ hàng và cập nhật số lượng
                        if (isset($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $key => $product) {
                                $new_quantity = $_POST['so_luong'][$key];
                                
                                // Kiểm tra nếu số lượng mới là 0, thì xóa sản phẩm khỏi giỏ hàng
                                if ($new_quantity == 0) {
                                    unset($_SESSION['cart'][$key]);
                                    header("location:index.php?act=cart");
                                } else {
                                    // Cập nhật số lượng
                                    $_SESSION['cart'][$key]['so_luong'] = $new_quantity;
                                    header("location:index.php?act=cart");
                                }
                            }
                        }
                    }
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
        case 'checkout':{
            if(!isset($_SESSION['ten_khach_hang'])){
                $_SESSION['faill_login'] = "Bạn chưa đăng nhập";
                header("location:index.php?act=login");

            }
            if(isset($_POST['submit'])){
                //do validate
                $error = [];
                if(empty($_POST['name'])){
                    $error['hoten'] = "Bạn chưa nhập họ tên";
                }
                if(empty($_POST['sdt'])){
                    $error['sdt'] = "Bạn chưa nhập số điện thoại";
                }
                if(empty($_POST['diachi'])){
                    $error['diachi'] = "Bạn chưa nhập địa chỉ";
                }   
                if(empty($error)){
                    $ten_khach_hang = $_POST['name'];
                    $sdt = $_POST['sdt'];
                    $dia_chi = $_POST['diachi'];
                    $email = $_SESSION['email'];
                    $ma_khach_hang = $_SESSION['ma_khach_hang'];
                    $phuong_thuc_thanh_toan = $_POST['phuong_thuc'];
                    $ghi_chu_kh = $_POST['ghichu_kh'];

                    if($phuong_thuc_thanh_toan == 0){
                        donhang_create($ma_khach_hang, $ghi_chu_kh, $phuong_thuc_thanh_toan);
                        $ma_don_hang = pdo_get_insert_id();
                        foreach($_SESSION['cart'] as $value){
                            extract($value);
                            donhang_insert_ctdonhang($ma_don_hang, $ma_san_pham, $so_luong, $giam_gia);
                        }
                        unset($_SESSION['cart']);
                        $_SESSION['sussecc'] = "Đặt hàng thành công! cảm ơn bạn đã mua hàng của chúng tôi";
                        header("location:index.php?act=chitietdh&ma_don_hang=$ma_don_hang");        

                        
                    } 
                    if($phuong_thuc_thanh_toan == 1){
                        echo "tin dung";
                    } 
                    if($phuong_thuc_thanh_toan == 2){
                        echo "VNPAY";
                    } 

                    }
            }

            
        
            include "view/payment/checkout.php";
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