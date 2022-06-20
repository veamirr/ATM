<?php
//session_start();
require 'includes/data.php';
error_reporting(E_ALL ^ E_WARNING);
if(!$_SESSION['card']) {
    header('Location: authorization.php');
};

if( $_SESSION['last_activity'] < time()-$_SESSION['expire_time'] ) { //have we expired?
    echo "<script type='text/javascript'>alert('Вы были не активны более 2 минут');location='includes/logout.php';</script>";
    //redirect to logout.php
    //header('Location: includes/logout.php'); //change yoursite.com to the name of you site!!
} else{ //if we haven't expired:
    $_SESSION['last_activity'] = time(); //this was the moment of last activity.
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Баланс</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<!-- Баланс -->
<form>
    <h2 align="center">Ваш баланс:</h2>
    <h2 align="center"><?= $_SESSION['account']['balance'] ?> РУБ</h2>
    <a href="profile.php" class="logout">Назад</a>
</form>

</body>
</html>
