<?php
session_start();
ob_start();
include "../module/PDO.php";
include "../module/loai.php";
include "../module/sanpham.php";
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
            case 'addsp':{
                $data=loai_list();
                if(isset($_POST['submit'])){
                    //validate
                    $error = [];
                    if(empty($_POST['tensp'])){
                        $error['ten_san_pham']="Tên sản phẩm không được để trống";
                    }
                    if(empty($_POST['description1'])){
                        $error['mo_ta']="Mô tả không được để trống";
                    }
                    if(empty($_POST['soluong'])){
                        $error['so_luong']="Số lượng không được để trống";
                    }
                    if(empty($_POST['dongia'])){
                        $error['don_gia']="Đơn giá không được để trống";
                    }
                    if(empty($_POST['giamgia'])){
                        $error['giam_gia']="Giảm giá không được để trống";
                    }
                    if($_POST['loaihang'] == 'concac'){
                        $error['ma_loai']="Loại hàng không được để trống";
                    }
                    if(empty($_POST['thuonghieu'])){
                        $error['thuong_hieu']="Thương hiệu không được để trống";
                    }
                    if(empty($_POST['ngaythem'])){
                        $error['ngay_nhap']="Ngày nhập không được để trống";
                    }
        
                                // Kiểm tra ảnh đại diện
                    if (empty($_FILES['anh']['name'])) {
                        $error['anh'] = "Phải có ảnh đại diện sản phẩm.";
                    } else {
                        $target_dir = "../image/";
                        $target_file = $target_dir . basename($_FILES["anh"]["name"]);

                        if (move_uploaded_file($_FILES["anh"]["tmp_name"], $target_file)) {
                            echo "File " . htmlspecialchars(basename($_FILES["anh"]["name"])) . " đã được tải lên.";
                        } else {
                            
                            echo "Có lỗi xảy ra khi tải ảnh lên.";
                            $error['anh'] = "Lỗi khi tải ảnh đại diện lên.";
                        }
                    }
                    $anh1 = $anh2 = $anh3 = $anh4 = "noimage.jpg";
                    // Khởi tạo các biến với giá trị mặc định
                    for ($i = 1; $i <= 4; $i++) {
                        $input_name = "anh$i";
                        if (isset($_FILES[$input_name]['name'])) {
                            $file_name = $_FILES[$input_name]['name'];
                            $target_file = $target_dir . basename($file_name);
                            if (move_uploaded_file($_FILES[$input_name]['tmp_name'], $target_file)) {
                                // Nếu ảnh được tải lên thành công, cập nhật giá trị biến tương ứng
                                ${"anh$i"} = $_FILES[$input_name]['name'];
                            }
                        }
                    }
                    // Kiểm tra và xử lý thông tin sản phẩm nếu không có lỗi ảnh
                    if (empty($error)) {
                        echo 'added';
                        $ten_san_pham = $_POST['tensp'];
                        $mo_ta = $_POST['description1'];
                        $so_luong = $_POST['soluong'];
                        $don_gia = $_POST['dongia'];
                        $giam_gia = $_POST['giamgia'];
                        $ngay_them_raw = $_POST['ngaythem'];
                        $ngay_them = date("Y-m-d", strtotime($ngay_them_raw));
                        $ma_loai = $_POST['loaihang'];
                        $thuong_hieu = $_POST['thuonghieu'];
                        $luot_xem = $_POST['luotxem'];
                        $anh = $_FILES['anh']['name'];
                        echo "$ten_san_pham, $ma_loai, $mo_ta, $ngay_them, $don_gia, $giam_gia, $so_luong, $thuong_hieu, $luot_xem, $anh, $anh1, $anh2, $anh3, $anh4";
                        sanpham_insert($ten_san_pham, $ma_loai, $mo_ta, $ngay_them, $don_gia, $giam_gia, $so_luong, $thuong_hieu, $luot_xem, $anh, $anh1, $anh2, $anh3, $anh4);
                        header("Location: admin.php?act=listsp");
                       
                
                    }
                }
                include "sanpham/add.php";
                break;
            
        }
            case 'listsp':{
                $data=sanpham_list();
                include "sanpham/list.php";
                break;
            }   
            case 'editsp': {
                if (isset($_GET['ma_san_pham'])) {
                    $ma_san_pham = $_GET['ma_san_pham'];
                    $data = sanpham_get_byid($ma_san_pham);
                    extract($data);
                } else {
               
                }
            
                if (isset($_POST['submit'])) {
                    $error = [];
                    $target_dir = "../image/";
                
                    // Kiểm tra xem ảnh đại diện có được thay đổi hay không
                    if (!empty($_FILES['anh']['name'])) {
                        $target_file = $target_dir . basename($_FILES["anh"]["name"]);
                
                        if (move_uploaded_file($_FILES["anh"]["tmp_name"], $target_file)) {
                            echo "File " . htmlspecialchars(basename($_FILES["anh"]["name"])) . " đã được tải lên.";
                        } else {
                            echo "Có lỗi xảy ra khi tải ảnh lên.";
                            $error['anh'] = "Lỗi khi tải ảnh đại diện lên.";
                        }
                    }
                
                    // Khởi tạo các biến với giá trị mặc định
                    $anh1 = $anh2 = $anh3 = $anh4 = "noimage.jpg";
                    for ($i = 1; $i <= 4; $i++) {
                        $input_name = "anh$i";
                        if (!empty($_FILES[$input_name]['name'])) {
                            $file_name = $_FILES[$input_name]['name'];
                            $target_file = $target_dir . basename($file_name);
                            if (move_uploaded_file($_FILES[$input_name]['tmp_name'], $target_file)) {
                                // Nếu ảnh được tải lên thành công, cập nhật giá trị biến tương ứng
                                ${"anh$i"} = $_FILES[$input_name]['name'];
                            }
                        }
                    }
                
                    if (empty($error)) {
                        $ten_san_pham = $_POST['tensp'];
                        $ma_san_pham = $_POST['masp'];
                        $mo_ta = $_POST['description1'];
                        $so_luong = $_POST['soluong'];
                        $don_gia = $_POST['dongia'];
                        $giam_gia = $_POST['giamgia'];
                        $ngay_them_raw = $_POST['ngaythem'];
                        $ngay_them = date("Y-m-d", strtotime($ngay_them_raw));
                        $ma_loai = $_POST['maloai'];
                        $thuong_hieu = $_POST['thuonghieu'];
                        $luot_xem = $_POST['luotxem'];
                        echo "$ngay_them | $ngay_them_raw";
                
                        // Kiểm tra xem ảnh đại diện có được thay đổi hay không
                        if (!empty($_FILES['anh']['name'])) {
                            // Nếu có thay đổi ảnh đại diện, cập nhật chỉ ảnh đại diện
                            sanpham_update($ten_san_pham, $ma_loai, $mo_ta, $ngay_them, $don_gia, $giam_gia, $so_luong, $thuong_hieu, $luot_xem, $_FILES['anh']['name'], $anh1, $anh2, $anh3, $anh4, $ma_san_pham);
                        } else {
                            // Nếu không có thay đổi ảnh đại diện, giữ nguyên ảnh phụ
                            sanpham_noimg($ten_san_pham, $ma_loai, $mo_ta, $ngay_them, $don_gia, $giam_gia, $so_luong, $thuong_hieu, $luot_xem, $ma_san_pham);
                        }
                        header("Location: admin.php?act=listsp");
                    }
                }
                
                include "sanpham/edit.php";
                break;
                

            }
            
            
            case 'softdellsp':{
               
                    $ma_san_pham=$_GET['ma_san_pham'];
                    sanpham_softdel($ma_san_pham);
                    header("Location: admin.php?act=listsoftdellsp");
            
                break;
            }
            case 'listsoftdellsp':{
                $data=sanpham_softdel_list();
                include "sanpham/listdell.php";
                break;
            }   
            case 'recoversp':{
                $ma_san_pham=$_GET['ma_san_pham'];
                sanpham_recover($ma_san_pham);
                header("Location: admin.php?act=listsoftdellsp");
                break;
            }
            case 'listkh':{
                include "khachhang/list.php";
                break;
            }      
           case 'login':{
            include "login/login.php";
            break;

           }
        
        default:{
                include "404.php";
                break;
            }
        }
    } else {
        include "body.php";
    }
  
ob_end_flush();
?>