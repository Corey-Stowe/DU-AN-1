<?php
function comment_list($ma_hang_hoa){
    $sql="SELECT * FROM binh_luan JOIN khach_hang ON binh_luan.ma_khach_hang = khach_hang.ma_khach_hang WHERE ma_hang_hoa = '$ma_hang_hoa'";
    $data = pdo_query($sql);
    return $data;

}
function list_comment(){
    $sql="SELECT * FROM binh_luan";
    $data = pdo_execute($sql);   
    return $data;
}
function comment_add($noi_dung,$ma_hang_hoa,$ma_khach_hang,$ngay_binh_luan){
    $sql="INSERT INTO binh_luan(noi_dung,ma_hang_hoa,ma_khach_hang,ngay_binh_luan) VALUES('$noi_dung','$ma_hang_hoa','$ma_khach_hang','$ngay_binh_luan')";
    pdo_execute($sql);
}
function comment_admin_loadall(){
    $sql="SELECT * FROM binh_luan JOIN khach_hang ON binh_luan.ma_khach_hang = khach_hang.ma_khach_hang JOIN hang_hoa ON binh_luan.ma_hang_hoa = hang_hoa.ma_hang_hoa";
    $data = pdo_query($sql);
    return $data;
}
function comment_admin_loadid($ma_binh_luan){
    $sql="SELECT * FROM binh_luan JOIN khach_hang ON binh_luan.ma_khach_hang = khach_hang.ma_khach_hang JOIN hang_hoa ON binh_luan.ma_hang_hoa = hang_hoa.ma_hang_hoa WHERE ma_binh_luan = '$ma_binh_luan'";
    $data = pdo_execute_single($sql);
    return $data;
}
function comment_admin_edit($ma_binh_luan,$noi_dung){
    $sql="UPDATE binh_luan SET noi_dung = '$noi_dung' WHERE ma_binh_luan = '$ma_binh_luan'";
    pdo_execute($sql);
}
function comment_admin_delete($ma_binh_luan){
    $sql="DELETE FROM binh_luan WHERE ma_binh_luan = '$ma_binh_luan'";
    pdo_execute($sql);
}
function comment_admin_delete_selected($ma_binh_luan){
  // Lấy danh sách mã loại từ tham số truyền vào qua URL
  $ma_hanghoa_list = explode(',', $ma_binh_luan);
  foreach ($ma_hanghoa_list as $ma_hanghoa) {
      $sql = "DELETE FROM binh_luan WHERE ma_binh_luan=?";
      if(is_numeric($ma_hanghoa)){
          pdo_execute($sql, $ma_hanghoa);
      }
      
  }
 
}
?>