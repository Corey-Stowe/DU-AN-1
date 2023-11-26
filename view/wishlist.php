<main id="content" class="wrapper layout-page">
<section class="z-index-2 position-relative pb-2 mb-12">
<div class="bg-body-secondary mb-3">
<div class="container">
<nav class="py-4 lh-30px" aria-label="breadcrumb">
<ol class="breadcrumb justify-content-center py-1 mb-0">
<li class="breadcrumb-item"><a title="Home" href="../index.html">Trang chủ</a></li>
<li class="breadcrumb-item"><a title="Shop" href="shop-layout-v2.html">Cửa hàng</a></li>
<li class="breadcrumb-item active" aria-current="page">Yêu Thích</li>
</ol>
</nav>
</div>
</div>
</section> 
<section class="container container-xxl mb-13 mb-lg-15">
<div class="text-center"><h2 class="mb-13">Sản Phẩm Yêu thích</h2></div>
<form class="table-responsive-md" method="post" action="index.php?act=viewcart">
<table class="table" style="min-width: 710px">
<tbody>
<?php
if(isset($_SESSION['sp_yeu_thich'])&&(is_array($_SESSION['sp_yeu_thich']))){   
    if(sizeof($_SESSION['sp_yeu_thich'])>0){
        for ($i=0; $i < sizeof($_SESSION['sp_yeu_thich']); $i++) { 
        ?>   
<tr class="border">
<th scope="row" class=" ps-xl-10 py-6 d-flex align-items-center border-0">
<a href="index.php?act=wishlist&del_yt_id=<?php echo $i;?>" class=" d-block text-muted fw-lighter"><i class="fas fa-times"></i></a>  
<div class="d-flex align-items-center">
<div class="ms-6 me-7">
<img src="#" data-src="image/<?php echo $_SESSION['sp_yeu_thich'][$i][4]?>" class="img-fluid lazy-image" height="100" width="75" alt>
</div>
<div>
<p class=" text-body-emphasis fw-semibold mb-5"><?=$_SESSION['sp_yeu_thich'][$i][1]?></p>
<p class="fw-bold fs-14px mb-4 text-body-emphasis">
<p class="fw-500 mb-1 text-body-emphasis"><?php echo number_format($_SESSION['sp_yeu_thich'][$i][3], 0, ',', '.').'đ'?></p>
<span class="fs-13px fw-500 text-decoration-line-through pe-3"><?php echo number_format($_SESSION['sp_yeu_thich'][$i][2], 0, ',', '.').'đ'?></span>
</p>
</div>
</div>
</th>
<td class=" align-middle text-end pe-10">
<?php 
if($_SESSION['sp_yeu_thich'][$i][5]>2){
    echo'<span class="me-6">kho('.$_SESSION['sp_yeu_thich'][$i][5].')</span><h8>Còn Hàng</h8>
    <button name="addcart" type="submit" class="btn fs-13px px-5 lh-sm btn-outline-dark">Thêm Giỏ Hàng</button>
    ';
}else{
    echo'<span class="me-6" style="color:red; opacity: 0.5;">Hết Hàng</span>';
}
?>
<input type="hidden" name="masp" value="<?=$_SESSION['sp_yeu_thich'][$i][0]?>">
<input type="hidden" name="soluong" value="1">
<input type="hidden" name="tensp" value="<?=$_SESSION['sp_yeu_thich'][$i][1]?>">
<input type="hidden" name="gia" value="<?=$_SESSION['sp_yeu_thich'][$i][2]?>">
<input type="hidden" name="giam_gia" value="<?=$_SESSION['sp_yeu_thich'][$i][3]?>">
<input type="hidden" name="img" value="<?=$_SESSION['sp_yeu_thich'][$i][4]?>">
</td>
</tr>
<?php   }
    }else{
        echo '<tr class="border"><h5 style="color:red">Không có sản phẩm yêu thích nào!</h5></tr>';
    } 
}   
?> 
</form>  
<tr>
<td class="border-0 py-8 px-0">
<form action="index.php" method="post">
<button href="index.php" type="submit" class="btn px-9 btn-outline-dark">
Countinue Shopping
</button>
</form>
</td>
<td class="border-0 text-end py-8 px-0">
</td>
</tr>
</tbody>
</table>
</section>
</main>
