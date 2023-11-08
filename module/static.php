<?php 
function load_static_hanghoa_list(){
 //thống kê số lượng, giá nhỏ nhất ,giá lớn nhất và giá trung bình
    $sql = "SELECT hang_hoa.ma_loai, COUNT(*) AS so_luong, MIN(hang_hoa.giam_gia) AS gia_min, MAX(hang_hoa.giam_gia) AS gia_max, AVG(hang_hoa.giam_gia) AS gia_avg, ten_loai
    FROM hang_hoa
    JOIN loai_hang ON hang_hoa.ma_loai = loai_hang.ma_loai
    GROUP BY hang_hoa.ma_loai
    ORDER BY so_luong DESC
    ";
    $result = pdo_query($sql);
    return $result;
    


}
?>