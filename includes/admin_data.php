<?php
session_start();
require 'connect.php';
global $connect;


//получение имени клиента
$atm_id = $_SESSION['atm']['id'];
$check_atm_balance = mysqli_query($connect, "SELECT * FROM bank.atm WHERE atm.id = '$atm_id'");
$atm_data = mysqli_fetch_assoc($check_atm_balance);
//$_SESSION['atm'] = [
//    //"balance" => $atm_data['balance']
//    "balance" => 100
//];
$_SESSION['atm']['balance'] = $atm_data['balance'];

