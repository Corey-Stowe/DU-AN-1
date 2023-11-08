<?php
function loai_insert($ten_loai){
    $sql="INSERT INTO loai_hang(ten_loai) VALUES('$ten_loai')";
    pdo_execute($sql);
}
function loai_update($ma_loai,$ten_loai){
    $sql="UPDATE loai_hang SET ten_loai='$ten_loai' WHERE ma_loai='$ma_loai'";
    pdo_execute($sql);
}
function loai_delete($ma_loai){
    $sql="DELETE FROM loai_hang WHERE ma_loai='$ma_loai'";
    pdo_execute($sql);
}
function loai_delete_byid($ma_loai_list){
 // Lấy danh sách mã loại từ tham số truyền vào qua URL
    $ma_loai_list = explode(",", $_GET["ma_loai"]);
 // Kiểm tra nếu danh sách không rỗng
    if (!empty($ma_loai_list)) {
        foreach($ma_loai_list as $ma_loai){
        //đảm bảo mã loại đúng số nguyên
        $ma_loai=intval($ma_loai);
        $sql="DELETE FROM loai_hang WHERE ma_loai='$ma_loai'";
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
function loai_get_byid($ma_loai){
    $sql= "SELECT * FROM loai_hang WHERE ma_loai='$ma_loai'";
    return pdo_execute_single($sql);
}
function loai_list(){
    $sql="SELECT * FROM loai_hang";
    $list=pdo_query($sql);
    return $list;
}
function loai_list_limit(){
    $sql="SELECT * FROM loai_hang ORDER BY ten_loai DESC LIMIT 0,5";
    return pdo_execute($sql);
}
?>