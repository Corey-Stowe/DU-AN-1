<?php


?>
<div id="shoppingCart" data-bs-scroll="false" class="offcanvas offcanvas-end">
      <div class="offcanvas-header fs-4">
        <h4 class="offcanvas-title fw-semibold">Giỏ hàng</h4>
        <button type="button" class="btn-close btn-close-bg-none" data-bs-dismiss="offcanvas" aria-label="Close">
          <i class="far fa-times"></i>
        </button>
      </div>
      <div class="offcanvas-body me-xl-auto pt-0 mb-2 mb-xl-0">
        <form class="table-responsive-md shopping-cart pb-8 pb-lg-10">
          <table class="table table-borderless">
            <thead>
              <tr class="fw-500">
                <td colspan="3" class="border-bottom pb-6">
                  <i class="far fa-check fs-12px border me-4 px-2 py-1 text-body-emphasis border-dark rounded-circle"></i> Your cart is saved for the next <span class="text-body-emphasis">4m34s</span>
                </td>
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
                for ($i=0; $i < sizeof($_SESSION['giohang']); $i++) {
                ?>
                
              <tr class="position-relative">
                <td class="align-middle text-center">
                  <a href="?delid=<?=$i?>" onclick="xoagiohang()" class="d-block clear-product">
                    <i class="far fa-times"></i>
                  </a>
                </td>
                <td class="shop-product">
                  <div class="d-flex align-items-center">
                    <div class="me-6">
                      <img src="image/<?=$_SESSION['giohang'][$i][4]?>" width="60" height="80" alt="natural coconut cleansing oil">
                    </div>
                    <div class>
                      <p class="card-text mb-1">
                      <del class=" text-body fw-500 me-4 fs-13px"><?php echo number_format($_SESSION['giohang'][$i][2], 0, ',', '.').'đ' ?></del>
                        <ins class=" text-body fw-500 me-4 fs-13px"><?php echo number_format($_SESSION['giohang'][$i][3], 0, ',', '.').'đ' ?></ins>
                      </p>
                      <p class="fw-500 text-body-emphasis"><?=$_SESSION['giohang'][$i][1]?></p>
                    </div>
                  </div>
                </td>
                <td class="align-middle p-0">
                  <div class="input-group position-relative shop-quantity">
                    <a href="#" class="shop-down position-absolute z-index-2">
                      <i class="far fa-minus"></i>
                    </a>
                    <input name="number[]" type="number" class="form-control form-control-sm px-6 py-4 fs-6 text-center border-0" value="<?php echo($_SESSION['giohang'][$i][5]);?>" required>
                    <a href="#" class="shop-up position-absolute z-index-2">
                      <i class="far fa-plus"></i>
                    </a>
                  </div>
                </td>
              </tr>
            <?php }
              }
            }
              ?>
            </tbody>
          </table>
        </form>
      </div>
      <div class="offcanvas-footer flex-wrap">
        <div class="d-flex align-items-center justify-content-between w-100 mb-5">
        <span class="text-body-emphasis">Tổng tiền giỏ hàng:</span>
        <?php
      if(isset($_SESSION['giohang'])&&(is_array($_SESSION['giohang']))){
        $tong=0;
        for ($i=0; $i < sizeof($_SESSION['giohang']); $i++) {
            $ttien=$_SESSION['giohang'][$i][5]*$_SESSION['giohang'][$i][3];
            $tong+=$ttien;
            
          }?>
          <h5><span ><?php echo number_format($tong, 0, ',', '.').'đ' ?></span></h5>
          <?php 
        }
        ?>
          
        </div>
        <a href="https://templates.g5plus.net/shop/checkout.html" class="btn btn-dark w-100 mb-7" title="Check Out">Check Out</a>
        <a href="index.php?act=viewcart" class="btn btn-outline-dark w-100" title="View shopping cart">Xem giỏ hàng</a>
        <a href="index.php?delcart=1" class="btn btn-outline-dark w-100" title="View shopping cart">Xóa Giỏ Hàng</a>
      </div>
    </div>
  