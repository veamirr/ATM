<?php
//session_start();
require 'includes/admin_data.php';
error_reporting(E_ALL ^ E_WARNING);

//переадресация, если пользователь уже авторизован
//if(!$_SESSION['atm']) {
//   header('Location: admin_profile.php');
//}

if( $_SESSION['admin_last_activity'] < time()-$_SESSION['admin_expire_time'] ) { //have we expired?
    echo "<script type='text/javascript'>alert('Вы были не активны более 5 минут');location='includes/admin_logout.php';</script>";
    //redirect to logout.php
    //header('Location: includes/logout.php'); //change yoursite.com to the name of you site!!
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

<!-- Пополнение наличных -->
<form method="post">
    <label>Введите сумму</label>
    <input type="text" name="number">
    <button type="submit" name="atm-btn">Внести</button>
    <?php
    if(isset($_POST['atm-btn'])){
        global $connect;
        global $atm_id;
        $sum = $_POST['number'];
        $sql = "UPDATE bank.atm SET balance=balance + '$sum' WHERE id = '$atm_id'";
        if (mysqli_query($connect, $sql)) {
            echo "Операция прошла успешно";
        } else {
            echo "Операция отклонена";// . mysqli_error($connect);
        }
    }
    ?>
    <a href="admin_profile.php" class="logout">Назад</a>
</form>

<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/admin_main.js"></script>

</body>
</html>
