<section class="container">
<div class="shopping-cart">
<h2 class="text-center fs-2 mt-12 mb-13">Shopping Cart</h2><form class="table-responsive-md pb-8 pb-lg-10" method="post">
<table class="table border">
<thead class="bg-body-secondary">
<tr class="fs-15px letter-spacing-01 fw-semibold text-uppercase text-body-emphasis">
<th scope="col" class="fw-semibold border-1 ps-11">products</th>
<th scope="col" class="fw-semibold border-1">quantity</th>
<th colspan="2" class="fw-semibold border-1">Price</th>
</tr>
</thead>
<script>
  function xoagiohang(){
    alert('bạn muốn xóa mặt hàng này?')
  }
</script>
<tbody>
<?php
if(isset($_SESSION['giohang'])&&(is_array($_SESSION['giohang']))){
    if(sizeof($_SESSION['giohang'])>0){
        $tong=0;
    for ($i=0; $i < sizeof($_SESSION['giohang']); $i++) { 
        $ttien=$_SESSION['giohang'][$i][5]*$_SESSION['giohang'][$i][3];
        $tong+=$ttien;
        ?> 
<tr class="position-relative">
<th scope="row" class="pe-5 ps-8 py-7 shop-product">
<div class="d-flex align-items-center">
<div class="form-check">
<input class="form-check-input rounded-0" type="checkbox" name="check-product" value="checkbox">
</div>
<div class="ms-6 me-7">
<img src="#" data-src="image/<?=$_SESSION['giohang'][$i][4]?>" class="lazy-image" width="75" height="100" alt="Natural Coconut Cleansing Oil">
</div>
<div class>
<p class="fw-500 mb-1 text-body-emphasis"><?php echo number_format($_SESSION['giohang'][$i][3], 0, ',', '.').'đ'?></p>
<p class="card-text">
<span class="fs-13px fw-500 text-decoration-line-through pe-3"><?php echo number_format($_SESSION['giohang'][$i][2], 0, ',', '.').'đ'?></span>
<span class="fs-15px fw-bold text-body-emphasis"><?=$_SESSION['giohang'][$i][1]?></span>
</p>
</div>
</div>
</th>
<td class="align-middle">
<div class="input-group position-relative shop-quantity">
<a href="#" class="shop-down position-absolute z-index-2"><i class="far fa-minus"></i></a>
<input name="soluongupdate" type="number" class="form-control form-control-sm px-10 py-4 fs-6 text-center border-0" value="<?php echo($_SESSION['giohang'][$i][5]);?>" required>
<a href="#" class="shop-up position-absolute z-index-2"><i class="far fa-plus"></i>
</a>
</div>
</td>
<td class="align-middle">
<p class="mb-0 text-body-emphasis fw-bold mr-xl-11"><?php echo number_format($ttien, 0, ',', '.').'đ'?></p>
</td>
<td class="align-middle text-end pe-8">
<a href="index.php?delidct=<?=$i?>" onclick="xoagiohang()" class="d-block clear-product">
<i class="fa fa-times"></i>
</a>
</td>
</tr>
<?php }
    }
  }else{
    echo'<tr><td class="align-middle text-center">
    <h5>
    Không có sản phẩm nào trong giỏ hàng! 
    </5>
  </td>
  </tr>';
  }
?>
<tr>
<td class="pt-5 pb-10 position-relative bg-body ps-0 left">
<a href="index.php" title="Countinue Shopping" class="btn btn-outline-dark me-8 text-nowrap my-5">
Countinue Shopping
</a>
<a href="index.php?delcartct=1" value="Clear Shopping Cart" class="btn btn-link p-0 border-0 border-bottom border-secondary text-decoration-none rounded-0 my-5 fw-semibold ">
<i class="fa fa-times me-3"></i>
Clear Shopping Cart
</a>
</td>
<td colspan="3" class="text-end pt-5 pb-10 position-relative bg-body right pe-0">
<button type="submit" name="updatecart" value="Update Cart" class="btn btn-outline-dark my-5">Update Cart
</button>
</td>
</tr>
</tbody>
</table>
</form>
<div class="row pt-8 pt-lg-11 pb-16 pb-lg-18">
<div class="col-lg-4 pt-2">
<h4 class="fs-24 mb-6">Coupon Discount</h4>
<p class="mb-7">Enter you coupon code if you have one.</p>
<form>
<input type="text" class="form-control mb-7" placeholder="Enter coupon code here">
<button type="submit" class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary">
Apply coupon
</button>
</form>
</div>
<div class="col-lg-4 pt-lg-2 pt-10">
<h4 class="fs-24 mb-6">Shipping Caculator</h4>
<form>
<div class="d-flex mb-5">
<div class="form-check me-6 me-lg-9">
<input class="form-check-input form-check-input-body-emphasis" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
<label class="form-check-label" for="flexRadioDefault1">
Free shipping
</label>
</div>
<div class="form-check">
<input class="form-check-input form-check-input-body-emphasis" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
<label class="form-check-label" for="flexRadioDefault2">
Flat rate: $75
</label>
</div>
</div>
<div class="dropdown bg-body-secondary rounded mb-7">
<a href="#" class="form-select text-body-emphasis dropdown-toggle d-flex justify-content-between align-items-center text-decoration-none text-secondary position-relative d-block" role="button" data-bs-toggle="dropdown" aria-expanded="false">
Viet Nam
</a>
<div class="dropdown-menu w-100 px-0 py-4">
<a class="dropdown-item px-6 py-4" href="#">Andorra</a>
<a class="dropdown-item px-6 py-4" href="#">San Marino</a>
<a class="dropdown-item px-6 py-4" href="#">Tunisia</a>
<a class="dropdown-item px-6 py-4" href="#">Micronesia</a>
<a class="dropdown-item px-6 py-4" href="#">Solomon Islands</a>
<a class="dropdown-item px-6 py-4" href="#">Macedonia</a>
</div>
</div>
<input type="text" class="form-control mb-7" placeholder="State / County" required>
<input type="text" class="form-control mb-7" placeholder="City" required>
<input type="text" class="form-control mb-7" placeholder="Postcode / Zip">
<button type="submit" class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary">
Update total
</button>
</form>
</div>
<div class="col-lg-4 pt-lg-0 pt-11">
<div class="card border-0" style="box-shadow: 0 0 10px 0 rgba(0,0,0,0.1)">
<div class="card-body px-9 pt-6">
<div class="d-flex align-items-center justify-content-between mb-5">
<span>Tổng tiền hàng:</span>
<span class="d-block ml-auto text-body-emphasis fw-bold"><?php echo number_format($tong, 0, ',', '.').'đ'?></span>
</div>
<?php
$tongtt=0;
$ship=35000;
if($tong>0){
$tongtt=$tong+$ship;
?>
<div class="d-flex align-items-center justify-content-between">
<span>Phí Giao hàng:</span>
<span class="d-block ml-auto text-body-emphasis fw-bold"><?php echo number_format($ship, 0, ',', '.').'đ'?></span>  
</div>
</div>
<div class="card-footer bg-transparent px-0 pt-5 pb-7 mx-9">
<div class="d-flex align-items-center justify-content-between fw-bold mb-7">
<span class="text-secondary text-body-emphasis">Tổng Thanh toán:</span>
<span class="d-block ml-auto text-body-emphasis fs-4 fw-bold"><?php echo number_format($tongtt, 0, ',', '.').'đ'?></span>
</div>
<a href="checkout.html" class="btn w-100 btn-dark btn-hover-bg-primary btn-hover-border-primary" title="Check Out">Check Out</a>
</div>
</div>
</div>
</div>
</div>
</section>
<?php }

?>
