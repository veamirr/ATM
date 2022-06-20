<?php
session_start();

error_reporting(E_ALL ^ E_WARNING);

//переадресация, если пользователь уже авторизован
if($_SESSION['card']) {
    header('Location: profile.php');
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

<!-- Форма авторизации -->
    <form>
        <label>Номер карты</label>
        <input type="text" name="number" placeholder="Введите номер карты">
        <label>PIN</label>
        <input type="password" name="pin" placeholder="Введите PIN">
        <button type="submit" class="login-btn">Войти</button>
        <p>
            <a href="admin_authorization.php">Вход для администратора</a>
        </p>
        <p class="msg none">HELLO</p>
    </form>

    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>