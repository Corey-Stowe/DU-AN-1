<?php
function sanpham_insert($ten_san_pham, $ma_loai, $mo_ta, $ngay_them, $don_gia, $giam_gia, $so_luong, $thuong_hieu, $luot_xem, $anh, $anh1, $anh2, $anh3, $anh4) {
    $sql = "INSERT INTO san_pham (ten_san_pham, ma_loai, mo_ta, ngay_them, don_gia, giam_gia, so_luong, thuong_hieu, luot_xem, trang_thai, anh, anh1, anh2, anh3, anh4) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    pdo_execute($sql, $ten_san_pham, $ma_loai, $mo_ta, $ngay_them, $don_gia, $giam_gia, $so_luong, $thuong_hieu, $luot_xem, 0, $anh, $anh1, $anh2, $anh3, $anh4);
}
function sanpham_list(){
    $sql = "SELECT * FROM san_pham JOIN loai_hang ON san_pham.ma_loai = loai_hang.ma_loai WHERE san_pham.trang_thai = 0";
    $data = pdo_query($sql);
    return $data;
}
function sanpham_get_byid($ma_san_pham){
    $sql = "SELECT * FROM san_pham JOIN loai_hang ON san_pham.ma_loai = loai_hang.ma_loai WHERE ma_san_pham=?";
    $data = pdo_execute_single($sql, $ma_san_pham);
    return $data;
}

function sanpham_update($ten_san_pham, $ma_loai, $mo_ta, $ngay_them, $don_gia, $giam_gia, $so_luong, $thuong_hieu, $luot_xem, $anh, $anh1, $anh2, $anh3, $anh4, $ma_san_pham){
    $sql = "UPDATE san_pham SET ten_san_pham=?, ma_loai=?, mo_ta=?, ngay_them=?, don_gia=?, giam_gia=?, so_luong=?, thuong_hieu=?, luot_xem=?, anh=?, anh1=?, anh2=?, anh3=?, anh4=? WHERE ma_san_pham=?";
    try {
        pdo_execute($sql, $ten_san_pham, $ma_loai, $mo_ta, $ngay_them, $don_gia, $giam_gia, $so_luong, $thuong_hieu, $luot_xem, $anh, $anh1, $anh2, $anh3, $anh4, $ma_san_pham);
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

}
function sanpham_noimg($ten_san_pham, $ma_loai, $mo_ta, $ngay_them, $don_gia, $giam_gia, $so_luong, $thuong_hieu, $luot_xem, $ma_san_pham){    
    $sql = "UPDATE san_pham SET ten_san_pham=?, ma_loai=?, mo_ta=?, ngay_them=?, don_gia=?, giam_gia=?, so_luong=?, thuong_hieu=?, luot_xem=? WHERE ma_san_pham=?";
    pdo_query($sql, $ten_san_pham, $ma_loai, $mo_ta, $ngay_them, $don_gia, $giam_gia, $so_luong, $thuong_hieu, $luot_xem, $ma_san_pham);
}
function sanpham_softdel($ma_san_pham){
    $sql = "UPDATE san_pham SET trang_thai=1 WHERE ma_san_pham=?";
   pdo_query($sql, $ma_san_pham);
   


}
function  sanpham_loadct($ma_san_pham){
    $sql = "SELECT * FROM san_pham 
    JOIN loai_hang ON san_pham.ma_loai = loai_hang.ma_loai 
    JOIN binh_luan ON san_pham.ma_san_pham = binh_luan.ma_san_pham 
    JOIN khach_hang ON binh_luan.ma_khach_hang = khach_hang.ma_khach_hang WHERE binh_luan.ma_san_pham =? AND binh_luan.trang_thai = 0 ";
    $data = pdo_query($sql, $ma_san_pham);
    return $data;
}
function sanpham_recover($ma_san_pham){
    $sql = "UPDATE san_pham SET trang_thai=? WHERE ma_san_pham=?";
    pdo_execute($sql, 0, $ma_san_pham);
}       
function sanpham_delete($ma_san_pham){
    $sql = "DELETE FROM san_pham WHERE ma_san_pham=?";
    pdo_execute($sql, $ma_san_pham);
}
function sanpham_softdel_list(){
    $sql = "SELECT * FROM san_pham JOIN loai_hang ON san_pham.ma_loai = loai_hang.ma_loai WHERE san_pham.trang_thai = 1";
    $data = pdo_query($sql);
    return $data;
}
// function hanghoa_delete_byid($ma_hanghoa_list){
//  // Lấy danh sách mã loại từ tham số truyền vào qua URL
//     $ma_hanghoa_list = explode(',', $ma_hanghoa_list);
//     foreach ($ma_hanghoa_list as $ma_hanghoa) {
//         $sql = "DELETE FROM hang_hoa WHERE ma_hang_hoa=?";
//         if(is_numeric($ma_hanghoa)){
//             pdo_execute($sql, $ma_hanghoa);
//         }
        
//     }
//     header('location:index.php?act=listhh');   
   
// }


?>