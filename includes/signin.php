<?php
   session_start();
   require 'connect.php';

   $number = $_POST['number'];
   $pin = $_POST['pin'];

   $error_fields = [];

   if($number === '') {
       $error_fields[] = 'number';
   }

   if($pin === '') {
       $error_fields[] = 'pin';
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
   $check_card = mysqli_query($connect, "SELECT * FROM bank.card WHERE number = '$number' AND pin = '$pin'");
   if (mysqli_num_rows($check_card) > 0) {
       //mysqli_fetch_assoc - выбирает следующую строку из набора результатов
       $card = mysqli_fetch_assoc($check_card);
       $_SESSION['card'] = [
           "number" => $card['number'],
           "client_id" => $card['client_id'],
           "account_number" =>$card['account_number']
       ];

       $response = [
           "status" => true
       ];


       //$_SESSION['start'] = time();
       //$_SESSION['expire'] = $_SESSION['start'] + 15;
       $_SESSION['last_activity'] = time(); //your last activity was now, having logged in.
       $_SESSION['expire_time'] = 120;


   } else {
       $response = [
           "status" => false,
           "message" => 'Не верный номер карты или PIN'
       ];

   }
echo json_encode($response);


