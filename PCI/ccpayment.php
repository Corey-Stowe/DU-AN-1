<?php
session_start();
include "../module/PDO.php";
include "../module/order.php";
if(!isset($_SESSION['ten_khach_hang'])){
    $_SESSION['faill_login'] = "Bạn chưa đăng nhập";
    header("location:../index.php?act=login");

}
// unset($_SESSION['ma_don_hang']);
// if(isset($_SESSION['ma_don_hang'])){
//     $ma_don_hang = $_SESSION['ma_don_hang'];
//     $toal = donhang_get_toal_chi_tiet($ma_don_hang);
//     $trang_thai_don = donhang_get_trangthai($ma_don_hang);
//     foreach($toal as $t){
//        extract($t);
//     }

// }

if(isset($_GET['ma_don_hang'])){
    $ma_don_hang = $_GET['ma_don_hang'];
    $toal = donhang_get_toal_chi_tiet($ma_don_hang);
    $trang_thai_don = donhang_get_trangthai($ma_don_hang);
    foreach($toal as $t){
       extract($t);
    }
}  

if(empty($toal)){
    header("location: ../index.php?act=404");
}
if($trang_thai_don['trang_thai_don'] == 1){
    header("location: ../index.php");

}



function GetStr($string, $start, $end) {
    $str = explode($start, $string);

    // Check if the start delimiter exists in the string
    if (count($str) < 2) {
        return false;
    }

    $str = explode($end, $str[1]);

    // Check if the end delimiter exists in the string
    if (count($str) < 1) {
        return false;
    }

    return $str[0];
}

if(isset($_POST['submit'])){
    $error = [];
    $card_holder_name = htmlspecialchars($_POST['card_holder_name']);
    $card_number = htmlspecialchars($_POST['card_number']);
    $month = htmlspecialchars($_POST['month']);
    $year = htmlspecialchars($_POST['year']);
    $card_cvc = htmlspecialchars($_POST['card_cvc']);
    $ma_don_hang = $_GET['ma_don_hang'];
    $tong = $_POST['tong'];
    $pk = 'pk_test_51OG5GjKXLBUZPNQwacFN3wDunhk8kCCnwMrS7EtL9DJFu4eRQEbKPNTTJnUozvSOfwdfIY2hnQX9MQv2Rp083Hws00fyvuzISu';
    $sk = 'sk_test_51OG5GjKXLBUZPNQwT9v3zl7V6NTdhYr0z3QMaJZMPZqBKUNa1LcY4BplNCPQNRicCAGMKJ62Z1HUmwICvZoSJwUK00wM6nyZM1';
    
    // Create token
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_USERPWD, $pk. ':' . '');
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'card[number]='.$card_number.'&card[exp_month]='.$month.'&card[exp_year]='.$year.'&card[cvc]='.$card_cvc.'&card[name]='.$card_holder_name.'');
    $result1 = curl_exec($ch);
    $tok1 = GetStr($result1, '"id": "', '"');
    $msg1 = GetStr($result1, '"message": "', '"');

    // Check for errors in token creation
    if (!empty($msg1)) {
        $error['token_creation'] = $msg1;

    }

    // If there are no token creation errors, proceed to charge creation
    if (empty($error['token_creation'])) {
        // Create charge
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/charges');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_USERPWD, $sk. ':' . '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'amount='.$tong.'&currency=vnd&source='.$tok1.'');
        $result3 = curl_exec($ch);
        $jsonData = json_decode($result3);
    
        // Check for errors in charge creation
        if (isset($jsonData->error)) {
            $errorDetails = $jsonData->error;
    
            // Extract decline_code, code, and other relevant information
            $declineCode = isset($errorDetails->decline_code) ? $errorDetails->decline_code : ' ';
            $errorCode = isset($errorDetails->code) ? $errorDetails->code : ' ';
            $chargeId = isset($errorDetails->charge) ? $errorDetails->charge : 'N/A';
    
            // Construct a more informative error message
            $errorMessage = "Thẻ của bạn bị từ chối: $errorCode $declineCode (Charge ID: $chargeId)";
            $errorapi = "$errorCode $declineCode";
            $_SESSION['error'] =  $errorapi;
            $_SESSION['charge_id'] = $chargeId;
            $_SESSION['decline_code'] = $declineCode;
            $error['charge_creation'] = $errorMessage;
        }
    }

    // If there are errors, display them
    if (!empty($error)) {
         echo"";
    } else {
                // Lấy thông tin từ payment_method_details
                $id = GetStr($result3, '"id": "', '"');
                $last4 = GetStr($result3, '"last4": "', '"');
                $brand = GetStr($result3, '"brand": "', '"');
                header("location: ../index.php?act=order_complete&status=success&ma_don_hang=$ma_don_hang&cong_thanh_toan=stripe&phuong_thuc_thanh_toan=2&charge_id=$id&last4=$last4&brand=$brand&error=");
    }
}
if(isset($_POST['cancel'])){
    $order_id = $_SESSION['ma_don_hang'];
    header("location: ../index.php?act=order_complete&status=cancel&ma_don_hang=$ma_don_hang&cong_thanh_toan=stripe&phuong_thuc_thanh_toan=2&charge_id={$_SESSION['charge_id']}&error={$_SESSION['error']}&decline_code=$declineCode&last4=&brand=");

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/favicon.ico">
    <title>Payment gate</title>
    <!-- Core CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body class="h-full">
    <div class="page-container relative h-full flex flex-auto flex-col px-4 sm:px-6 md:px-8 py-4 sm:py-6">
        <div class="container mx-auto h-full">
                <h3>Payment gate</h3>
                <br>
                <div class="card card-border">
                    <div class="card-body">
                    <?php
if (isset($error)) {
    foreach ($error as $err) {
        ?>
        <div class="alert alert-danger">
            <div class="alert-content">
                <span class="alert-icon">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                </span>
                <div><?php echo $err; ?></div>
            </div>
        </div>
    <?php
    }
}
?>

                        <h5>Đơn hàng sẽ tự động hủy sau: </h5> <h5 id="countdown" class="cut"></h5>
                        <p>Mã đơn hàng: <?php echo $ma_don_hang; ?></p>
                        <p>Giá trị đơn hàng phải thanh toán: <?php echo number_format($tong_gia_don_hang, 0, ',', '.').'đ'?> </p>
                        <form action="#" method="post">
                            <div class="grid md:grid-cols-3 gap-4 py-8 border-b border-gray-200 dark:border-gray-600 items-center">
                                <div class="font-semibold">Tên chủ thẻ</div>
                                <div class="col-span-2">
                                    <div class="form-item vertical mb-0 max-w-[700px]">
                                        <label class="form-label"></label>
                                        <div>
                                            <span class="input-wrapper">
                                                <div class="input-suffix-start">
                                                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" class="text-xl" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                </div>
                                                <input class="input pl-8" type="text" name="card_holder_name" autocomplete="off" placeholder="NGUYEN VAN A" >
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid md:grid-cols-3 gap-4 py-8 border-b border-gray-200 dark:border-gray-600 items-center">
                                <div class="font-semibold">Số Thẻ</div>
                                <div class="col-span-2">
                                    <div class="form-item vertical mb-0 max-w-[700px]">
                                        <label class="form-label"></label>
                                        <div>
                                            <span class="input-wrapper">
                                                <div class="input-suffix-start">
                                                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true" class="text-xl" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                                   
                                                     <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"></path>

                                                    </svg>
                                                </div>
                                                <input class="input pl-8" type="number" name="card_number" autocomplete="off" placeholder="XXXX XXXX XXXX XXXX" oninput="this.value = this.value.slice(0, 16)" >
                                                <input class="input pl-8" type="number" name="tong" autocomplete="off" placeholder="XXXX XXXX XXXX XXXX" value="<?php echo $tong_gia_don_hang?>" hidden>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4 py-8 border-b border-gray-200 dark:border-gray-600 items-center">
                                <div>
                                    <div class="font-semibold">Tháng Hết Hạn</div>
                                    <div>
                                        <div class="form-item vertical mb-0 max-w-[700px]">
                                            <label class="form-label"></label>
                                            <div>
                                                <span class="input-wrapper">
                                                   
                                                    
                                                    <input class="input pl-8" type="number" name="month" autocomplete="off" placeholder="MM" oninput="this.value = this.value.slice(0, 2)" >
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="font-semibold">Năm hết Hạn</div>
                                    <div>
                                        <div class="form-item vertical mb-0 max-w-[700px]">
                                            <label class="form-label"></label>
                                            <div>
                                                <span class="input-wrapper">
                                                    <div class="input-suffix-start">
                                       
                                                    </div>
                                                    <input class="input pl-8" type="number" name="year" autocomplete="off" placeholder="YY" oninput="this.value = this.value.slice(0, 2)" >
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="grid md:grid-cols-3 gap-4 py-8 border-b border-gray-200 dark:border-gray-600 items-center" >
                                <div class="font-semibold">CVV</div>
                                <div class="col-span-2">
                                    <div class="form-item vertical mb-0 max-w-[700px]">
                                        <label class="form-label"></label>
                                        <div>
                                            <span class="input-wrapper">
                                                <div class="input-suffix-start">
                                               
                                                </div>
                                                <input class="input pl-8" type="number" name="card_cvc" autocomplete="off" placeholder="XXX" maxlength="2" oninput="this.value = this.value.slice(0, 3)">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <!-- Add other form fields similarly -->
                            <button type="submit" name="submit" class="btn btn-two-tune mx-auto">Thanh toán</button>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#dialogBasic" class="btn btn-default">
                                Hủy
                            </button>
                            <div class="modal fade" id="dialogBasic" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog dialog">
                                <div class="dialog-content">
                                    <span class="close-btn absolute z-10 ltr:right-6 rtl:left-6" role="button" data-bs-dismiss="modal">
                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20" aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                    <br>
                                    <h5 class="mb-4">Xác nhận hủy</h5>
                                    <p>Nếu bạn hủy thanh toán thì đơn hàng của bạn sẽ về trạng thái chưa thanh toán và có thể dẫn tới bị hủy đơn</p>
                                    <div class="text-right mt-6">
                                        <button class="btn btn-plain ltr:mr-2 rtl:ml-2"  type="submit" name="cancel">Hủy thanh toán</button>
                                        <button class="btn btn-solid" data-bs-dismiss="modal"  >Tiếp tục thanh toán</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <br>
                            
                        </form>
                    </div>
                </div>
      
        </div>
    </div>
</body>
<script>
    let endTime = new Date();
endTime.setMinutes(endTime.getMinutes() + 15);

let timer = setInterval(function() {

  let now = new Date();
 let timeRemaining = endTime - now;

if (timeRemaining <= 0) {
  clearInterval(timer);
 document.getElementById("countdown").innerHTML = "Time Out";
 submitButton.disabled = true;
 window.location.href = "../index.php";


} else {
 let hours = Math.floor(timeRemaining / 3600000);
 let minutes = Math.floor((timeRemaining % 3600000) / 60000);
 let seconds = Math.floor((timeRemaining % 60000) / 1000);
let countdown = hours + ":" + minutes + ":" + seconds;
 document.getElementById("countdown").innerHTML = countdown;
  }
}, 1000);
</script>
	<!-- Core Vendors JS -->
    <script src="js/vendors.min.js"></script>

<!-- Core JS -->
<script src="js/app.min.js"></script>
</html>

