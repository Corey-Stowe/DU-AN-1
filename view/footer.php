<footer class="pt-15 pt-lg-20 pb-16 footer bg-section-4">
<<<<<<< Updated upstream
<div class="container container-xxl pt-4">
<div class="row">
<div class="col-lg col-md-4 col-12 mb-11 mb-lg-0 fs-14px">
<h3 class="fs-5 mb-6 ">Company</h3>
<p class="pe-xl-18 lh-2">
Find a location nearest you. See <a class href="#"><u class="fw-medium">Our Stores</u></a>
</p>
<p class="mb-0 lh-2"><strong class="text-body-emphasis">+391 (0)35 2568 4593</strong>
<br>
hello@domain.com
</p>
</div>
<div class="col-lg col-md-4 col-12 mb-11 mb-lg-0">
<h3 class="fs-5 mb-6 ">Useful links</h3>
=======
<<<<<<< HEAD
    <div class="container container-xxl pt-4">
        <div class="row">
            <div class="col-lg col-md-4 col-12 mb-11 mb-lg-0 fs-14px">
                <h3 class="fs-5 mb-6 ">về Glowing</h3>
                <ul class="list-unstyled mb-0 fw-medium ">
                    <li class="pt-3 mb-4">
                        <a href="#" title="New Products" class="text-body">Thông Tin</a>
                    </li>
                    <li class="pt-3 mb-4">
                        <a href="#" title="Best Sellers" class="text-body">Danh Sách Cửa Hàng</a>
                    </li>
                    <li class="pt-3 mb-4">
                        <a href="#" title="Bundle &amp; Save" class="text-body">Báo Chí</a>
                    </li>
                    <li class="pt-3 mb-4">
                        <a href="#" title="Online Gift Card" class="text-body">Thời Trang</a>
                    </li>
                </ul>

            </div>
            <div class="col-lg col-md-4 col-12 mb-11 mb-lg-0">
                <h3 class="fs-5 mb-6 ">Trợ Giúp</h3>
                <ul class="list-unstyled mb-0 fw-medium ">
                    <li class="pt-3 mb-4">
                        <a href="#" title="New Products" class="text-body">FAQ</a>
                    </li>
                    <li class="pt-3 mb-4">
                        <a href="#" title="Best Sellers" class="text-body">Blog</a>
                    </li>
                    <li class="pt-3 mb-4">
                        <a href="#" title="Bundle &amp; Save" class="text-body">Hỗ Trợ</a>
                    </li>
                    <li class="pt-3 mb-4">
                        <a href="#" title="Online Gift Card" class="text-body">Chính Sách Đổi Trả</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg col-md-4 col-12 mb-11 mb-lg-0">
                <h3 class="fs-5 mb-6 ">Mua Sắm</h3>
                <ul class="list-unstyled mb-0 fw-medium ">
                    <li class="pt-3 mb-4">
                        <a href="#" title="Start a Return" class="text-body">Giao Hàng</a>
                    </li>
                    <li class="pt-3 mb-4">
                        <a href="#" title="Contact Us" class="text-body">Thanh Toán</a>
                    </li>
                    <li class="pt-3 mb-4">
                        <a href="#" title="Shipping FAQ" class="text-body">Trả Hàng</a>
                    </li>
                    <li class="pt-3 mb-4">
                        <a href="#" title="Terms &amp; Conditions" class="text-body">Tìm Cửa Hàng</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-5 col-12 mb-11 mb-lg-0">
                <h3 class="mb-4 ">Bảng Tin Điện Tử</h3>
                <p class="lh-2 ">Đăng ký ngay và là người đầu tiên nắm được thông tin khi có mặt hàng mới, khuyến mãi,
                    các sự kiện sắp diễn ra tại cửa hàng và nhiều thông tin hữu ích khác.
                </p>
                <form class=" pt-8">
                    <div class="input-group position-relative">
                        <input type="email" class="form-control bg-body rounded-left"
                            placeholder="Nhập địa chỉ email của bạn">
                        <button type="submit" class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary ms-0">
                            Đăng Ký
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row align-items-center mt-0 mt-lg-20 pt-lg-4">
            <div class="col-sm-12 col-md-6 col-lg-4 d-flex align-items-center order-2 order-lg-1 fs-6 mt-8 mt-lg-0">
                <p class="mb-0">© Glowing 2023</p>
                <ul class="list-inline fs-18px ms-6 mb-0">
                    <li class="list-inline-item me-8">
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </li>
                    <li class="list-inline-item me-8">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <li class="list-inline-item me-8">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
=======
<div class="container container-xxl pt-4">
<div class="row">
<?php
$data = admin_get_contract();
foreach ($data as $value) {
    extract($value);
}?>
<div class="col-lg col-md-4 col-12 mb-11 mb-lg-0 fs-14px">
<h3 class="fs-5 mb-6 ">Công Ty</h3>
<p class="pe-xl-18 lh-2">
Tên công ty: <a class href="#"><u class="fw-medium"><?=$ten_doanh_nghiep?></u></a>
</p>
<p class="pe-xl-18 lh-2">
Địa chỉ: <a class href="#"><u class="fw-medium"><?=$dia_chi?></u></a>
</p>
<p class="mb-0 lh-2"><strong class="text-body-emphasis">+84 (0)<?=$sdt?></strong>
<br>
<?=$email?>
</p>
</div>
<div class="col-lg col-md-4 col-12 mb-11 mb-lg-0">
<h3 class="fs-5 mb-6 ">Trang</h3>
>>>>>>> Stashed changes
<ul class="list-unstyled mb-0 fw-medium ">
<li class="pt-3 mb-4">
<a href="#" title="New Products" class="text-body">New Products</a>
</li>
<li class="pt-3 mb-4">
<a href="#" title="Best Sellers" class="text-body">Best Sellers</a>
</li>
<li class="pt-3 mb-4">
<a href="#" title="Bundle &amp; Save" class="text-body">Bundle &amp; Save</a>
</li>
<li class="pt-3 mb-4">
<a href="#" title="Online Gift Card" class="text-body">Online Gift Card</a>
</li>
</ul>
</div>
<div class="col-lg col-md-4 col-12 mb-11 mb-lg-0">
<<<<<<< Updated upstream
<h3 class="fs-5 mb-6 ">Information</h3>
=======
<h3 class="fs-5 mb-6 ">Thông Tin</h3>
>>>>>>> Stashed changes
<ul class="list-unstyled mb-0 fw-medium ">
<li class="pt-3 mb-4">
<a href="#" title="Start a Return" class="text-body">Start a Return</a>
</li>
<li class="pt-3 mb-4">
<a href="#" title="Contact Us" class="text-body">Contact Us</a>
</li>
<li class="pt-3 mb-4">
<a href="#" title="Shipping FAQ" class="text-body">Shipping FAQ</a>
</li>
<li class="pt-3 mb-4">
<a href="#" title="Terms &amp; Conditions" class="text-body">Terms &amp; Conditions</a>
</li>
<li class="pt-3 mb-4">
<a href="#" title="Privacy Policy" class="text-body">Privacy Policy</a>
</li>
</ul>
</div>
<div class="col-lg-5 col-12 mb-11 mb-lg-0">
<h3 class="mb-4 ">Good emails.</h3>
<<<<<<< Updated upstream
<p class="lh-2 ">Enter your email below to be the first to know about new collections and product launches.</p>
=======
<p class="lh-2 ">Nhập Email Để Nhận Thông Tin Của Chúng Tôi.</p>
>>>>>>> Stashed changes
<form class=" pt-8">
<div class="input-group position-relative">
<input type="email" class="form-control bg-body rounded-left" placeholder="Enter your email address">
<button type="submit" class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary ms-0">
<<<<<<< Updated upstream
Subscribe
=======
Đăng Ký
>>>>>>> Stashed changes
</button>
</div>
</form>
</div>
</div>
<div class="row align-items-center mt-0 mt-lg-20 pt-lg-4">
<div class="col-sm-12 col-md-6 col-lg-4 d-flex align-items-center order-2 order-lg-1 fs-6 mt-8 mt-lg-0">
<p class="mb-0">© Glowing 2023</p>
<ul class="list-inline fs-18px ms-6 mb-0">
<li class="list-inline-item me-8">
<a href="#"><i class="fab fa-twitter"></i></a>
</li>
<li class="list-inline-item me-8">
<a href="#"><i class="fab fa-facebook-f"></i></a>
</li>
<li class="list-inline-item me-8">
<a href="#"><i class="fab fa-instagram"></i></a>
</li>
<li class="list-inline-item">
<a href="#"><i class="fab fa-youtube"></i></a>
</li>
</ul>
</div>
<<<<<<< Updated upstream
<div class="col-sm-12 col-lg-4 text-md-center order-1 order-lg-2 ">
<a class="d-inline-block" href="index-2.html">
<img class="lazy-image img-fluid light-mode-img" src="#" data-src="./assets/images/others/logo.png" width="179" height="26" alt="Glowing - Bootstrap 5 HTML Templates">
<img class="lazy-image dark-mode-img img-fluid" src="#" data-src="./assets/images/others/logo-white.png" width="179" height="26" alt="Glowing - Bootstrap 5 HTML Templates">
</a>
</div>
<div class="col-sm-12 col-md-6 col-lg-4 order-3 text-sm-start text-lg-end mt-8 mt-lg-0">
<img src="#" data-src="./assets/images/footer/img_1.png" width="313" height="28" alt="Paypal" class="img-fluid lazy-image">
</div>
</div>
</div>
=======
</div>
</div>
>>>>>>> 4d16460795bdee49bf20f71543959c82f053032d
>>>>>>> Stashed changes
</footer>