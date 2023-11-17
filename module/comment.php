<?php
function comment_list(){
    $sql = "SELECT * FROM binh_luan JOIN khach_hang ON binh_luan.ma_khach_hang = khach_hang.ma_khach_hang JOIN san_pham ON binh_luan.ma_san_pham = san_pham.ma_san_pham WHERE binh_luan.trang_thai = '0'";
     $data = pdo_query($sql);
    return $data;
}
function comment_softdel($ma_binh_luan){
    $sql = "UPDATE binh_luan SET trang_thai = '1' WHERE ma_binh_luan = '$ma_binh_luan'";
    return pdo_execute($sql);
}
?>