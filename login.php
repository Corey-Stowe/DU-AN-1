<main id="content" class="wrapper layout-page">
<section class="pb-lg-20 pb-16">
<div class="bg-body-secondary py-5">
<nav aria-label="breadcrumb">
<ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
<li class="breadcrumb-item"><a class="text-decoration-none text-body" href="#">Home</a>
</li>
<li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">Login
</li>
</ol>
</nav>
</div>
<div class="container">
<div class=" text-center pt-13 mb-12 mb-lg-15">
<div class="text-center"><h2 class="fs-36px mb-11 mb-lg-14">My Account</h2></div>
</div>
<?php
if(isset($_SESSION['user2'][0])&&(is_array($_SESSION['user2'][0]))){
    extract($_SESSION['user2'][0]);
    }
if(isset($_SESSION['user2'][0])&&(is_array($_SESSION['user2'][0]))){ 
    echo'<div class="container">
    <div class="row gx-5">
        <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 offset-xl-1">
            <div class="login_wrapper">
                <form action="" method="post">
                    
                    <div class="sherah-header__author-img">
                    Mã kh: kh0<a>'.$ma_khach_hang.'</a><br>
                    </div>
                    <div class="input_wrap">
                        Số điện thoại:<a>'.$sdt.'</a><br>
                    </div>
                    <div class="input_wrap">
                        TÊN KHÁCH HÀNG:<a>'.$ten_khach_hang.'</a><br>
                    </div>
                    <div class="input_wrap">
                        Email:<a>'.$email.'</a><br>
                    </div>
                    <div class="input_wrap">
                        ĐỊA CHỈ:<a>'.$dia_chi.'</a><br>
                    </div>
                    <div class="input_wrap">
                    <li><a href="index.php?act=logout">Logout</a></li>
                    </div>
                    <div class="input_wrap">
                    <input type="submit" name="" value="Quản Lý Đơn Mua">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
</div>';              
}else{
    echo '<div class="row no-gutters">
    <div class="col-lg-10 mx-auto">
    <div class="row no-gutters">
    <div class="col-lg-6 mb-15 mb-lg-0 pe-xl-2">
    <h3 class="fs-4 mb-10">Log In</h3>
    <form action="" method="post">
    <div class="form-group mb-6">
    <label for="user_login_email" class="visually-hidden">Email address</label>
    <input type="email" class="form-control" id="user_login_email" name="user_login_email" placeholder="Email Address">
    </div>
    <div class="form-group mb-6">
    <label for="user_login_password" class="visually-hidden">Password</label>
    <input type="password" class="form-control" id="user_login_password" placeholder="Password" name="user_login_password">
    '.$thongbao.'
    </div>
    <a href="#" class="d-inline-block fs-15 lh-12 mb-7">Forgot your password?</a>
    <input type="submit" class="btn btn-primary w-100 mb-7" value="Submit" name="login">
    <div class="form-check mb-7 d-flex">
    <input type="checkbox" class="form-check-input rounded-0" id="customCheck1" name="remember">
    <label class="form-check-label fs-15 ps-4 text-body-emphasis" for="customCheck1">Keep me signed in.</label>
    </div>
    </form>
    </div>
    <div class="col-lg-6 ps-lg-6 ps-xl-12">
    <h3 class="fs-4 mb-8">New Customer</h3>
    <p class="mb-8">By creating an account with our store, you will be able to move through the
    checkout process
    faster, store multiple shipping addresses, view and track your orders in your account and
    more.</p>
    <a href="index.php?act=sigup" class="btn btn-primary">Đăng Ký</a>
    </div>
    </div>
    </div>
    </div>
    </div>';
}
?>

</section>
</main>