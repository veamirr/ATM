<?php
//session_start();
require "includes/admin_data.php";

error_reporting(E_ALL ^ E_WARNING);


if( $_SESSION['admin_last_activity'] < time()-$_SESSION['admin_expire_time'] ) { //have we expired?
    echo "<script type='text/javascript'>alert('Вы были не активны более 5 минут');location='includes/admin_logout.php';</script>";

    //redirect to logout.php
    //header('Location: includes/logout.php');
} else{ //if we haven't expired:
    $_SESSION['admin_last_activity'] = time(); //this was the moment of last activity.
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<!-- Профиль админа-->
<form>
    <h2 align="center">Баланс:</h2>
    <h2 align="center"><?= $_SESSION['atm']['balance'] ?> РУБ</h2>
    <p>
        <a href="admin_atm_transactions.php">Транзакции</a>
    </p>
    <p>
        <a href="admin_money_in.php">Пополнить баланс банкомата</a>
    </p>
    <a href="includes/admin_logout.php" class="logout">Выход</a>
</form>

</body>
</html>
