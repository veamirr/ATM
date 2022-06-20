<?php
session_start();

error_reporting(E_ALL ^ E_WARNING);

//переадресация, если админ уже авторизован
if($_SESSION['atm']) {
    header('Location: admin_profile.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация админа</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<!-- Форма авторизации -->
<form>
    <label>Номер банкомата</label>
    <input type="text" name="atm_number" placeholder="Введите номер банкомата">
    <label>Пароль</label>
    <input type="password" name="atm_password" placeholder="Введите пароль от банкомата">
    <button type="submit" class="admin-btn">Войти</button>
    <p>
        <a href="authorization.php">Вход для клиента</a>
    </p>
    <p class="msg none">HELLO</p>
</form>

<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/admin_main.js"></script>

</body>
</html>
