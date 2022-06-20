<?php
session_start();
require 'connect.php';

//echo "работает!!";

$atm_number = $_POST['atm_number'];
$atm_password = $_POST['atm_password'];

$error_fields = [];

if($atm_number === '') {
    $error_fields[] = 'atm_number';
}

if($atm_password === '') {
    $error_fields[] = 'atm_password';
}

if (!empty($error_fields)) {
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Проверьте правильность полей",
        "fields" => $error_fields
    ];
    //json_encode - возвращает json представление данных
    echo json_encode($response);
    die();
}

global $connect;
$check_card = mysqli_query($connect, "SELECT * FROM bank.atm WHERE id = '$atm_number' AND password = '$atm_password'");
if (mysqli_num_rows($check_card) > 0) {
    //mysqli_fetch_assoc - выбирает следующую строку из набора результатов
    $atm = mysqli_fetch_assoc($check_card);
    $_SESSION['atm'] = [
        "id" => $atm['id']
    ];

    $response = [
        "status" => true
    ];


    //$_SESSION['start'] = time();
    //$_SESSION['expire'] = $_SESSION['start'] + 15;
    $_SESSION['admin_last_activity'] = time(); //your last activity was now, having logged in.
    $_SESSION['admin_expire_time'] = 300;


} else {
    $response = [
        "status" => false,
        "message" => 'Данные введены неверно'
    ];

}
echo json_encode($response);
