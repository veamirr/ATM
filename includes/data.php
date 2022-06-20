<?php
   session_start();
   require 'connect.php';
   global $connect;


   //получение имени клиента
   $name = $_SESSION['card']['client_id'];
   $check_client = mysqli_query($connect, "SELECT * FROM bank.client WHERE id = '$name'");
   $client = mysqli_fetch_assoc($check_client);
   $_SESSION['client'] = [
       "name" => $client['name']
   ];

   //получение баланса
   $account_number = $_SESSION['card']['account_number'];
   $check_account = mysqli_query($connect, "SELECT * FROM bank.account WHERE account.number = '$account_number' ");
   $account = mysqli_fetch_assoc($check_account);
   $_SESSION['account'] = [
       "balance" => $account['balance']
   ];
   //print_r($_SESSION['account']['balance']);
   //print_r(mysqli_num_rows($check_client));
