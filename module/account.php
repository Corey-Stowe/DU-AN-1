<?php
function account_register($user,$email,$pass){
    $sql="INSERT INTO khach_hang(ho_ten,email,mat_khau) VALUES('$user','$email','$pass')";
    pdo_execute($sql);

}
function account_login($user,$pass){
    $sql="SELECT * FROM khach_hang WHERE email='$user' AND mat_khau='$pass'";
    $data = pdo_execute_single($sql);   
    return $data;
}
function account_info($user){
    $sql="SELECT * FROM khach_hang WHERE ho_ten='$user'";
    $data = pdo_execute_single($sql);   
    return $data;
}
function account_info_id($ma_khach_hang){
    $sql="SELECT * FROM khach_hang WHERE ma_khach_hang='$ma_khach_hang'";
    $data = pdo_execute_single($sql);   
    return $data;
}
function account_update($ma_kh,$user,$email,$pass,$sdt,$diachi,$avatar){
    $sql="UPDATE khach_hang SET ho_ten='$user',email='$email',mat_khau='$pass',sdt='$sdt',dia_chi='$diachi',avatar='$avatar' WHERE ma_khach_hang='$ma_kh'";
    pdo_execute($sql);
}
function account_update_noimg($ma_kh,$user,$email,$pass,$sdt,$diachi){
    $sql="UPDATE khach_hang SET ho_ten='$user',email='$email',mat_khau='$pass',sdt='$sdt',dia_chi='$diachi' WHERE ma_khach_hang='$ma_kh'";
    pdo_execute($sql);
}
function account_email_info($email){
    $sql="SELECT * FROM khach_hang WHERE email='$email'";
    $data = pdo_execute_single($sql);   
    return $data;
}
function account_set_verified($email){
    $sql="UPDATE khach_hang SET kich_hoat=1 WHERE email='$email'";
    pdo_execute($sql);
}
function account_list(){
    $sql="SELECT * FROM khach_hang";
    $data = pdo_execute($sql);   
    return $data;
}
function account_delete($ma_khach_hang){
    $sql="DELETE FROM khach_hang WHERE ma_khach_hang='$ma_khach_hang'";
    pdo_execute($sql);
}
function account_admin_delete_byid($ma_khach_hang_list){
    // Lấy danh sách mã loại từ tham số truyền vào qua URL
    $ma_khach_hang_list = explode(",", $_GET["ma_khach_hang"]);
    // Kiểm tra nếu danh sách không rỗng
       if (!empty($ma_khach_hang_list)) {
           foreach($ma_khach_hang_list as $ma_loai){
           //đảm bảo mã loại đúng số nguyên
           $ma_loai=intval($ma_loai);
           $sql="DELETE FROM loai_hang WHERE ma_khach_hang='$ma_loai'";
           pdo_execute($sql);
      }
       if (!$sql) {
        // Xử lý lỗi nếu cần
        echo "Xóa không thành công cho mã loại $ma_loai";
        exit(); // Kết thúc kịch bản nếu xóa không thành công
       }
    header("Location: index.php?act=listdm");
    exit();
   } else {
     // Xử lý trường hợp không có mã loại nào để xóa
     echo "Không có mã loại nào để xóa.";
   }
   }

function account_admin_add($user,$email,$pass,$sdt,$diachi,$vaitro,$kichhoat){
    $sql="INSERT INTO khach_hang(ho_ten,email,mat_khau,sdt,dia_chi,vai_tro,kich_hoat) VALUES('$user','$email','$pass','$sdt','$diachi','$vaitro','$kichhoat')";
    pdo_execute($sql);
}
function account_admin_edit($ma_kh,$user,$email,$pass,$sdt,$diachi,$vaitro,$kichhoat){
    $sql="UPDATE khach_hang SET ho_ten='$user',email='$email',mat_khau='$pass',sdt='$sdt',dia_chi='$diachi',vai_tro='$vaitro',kich_hoat='$kichhoat' WHERE ma_khach_hang='$ma_kh'";
    pdo_execute($sql);
}
?>