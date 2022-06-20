<?php
//session_start();
require 'includes/data.php';
error_reporting(E_ALL ^ E_WARNING);

//переадресация, если пользователь уже авторизован
if(!$_SESSION['card']) {
    header('Location: profile.php');
}

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
    <title>Авторизация</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<!-- Пополнение наличных -->
<form method="post">
    <label>Введите сумму</label>
    <input type="text" name="number">
    <button type="submit" name="get-btn">Внести</button>
    <?php
    if(isset($_POST['get-btn'])){
        global $connect;
        global $name;
        global $account_number;
        $sum = $_POST['number'];
        $sql = "UPDATE bank.account SET account.balance=account.balance + '$sum' WHERE account.number = '$account_number'";
        $sql2 = "UPDATE bank.atm SET balance=balance + '$sum' WHERE id = '123'";
        if (mysqli_query($connect, $sql) && mysqli_query($connect, $sql2)) {
            echo "Операция прошла успешно";
        } else {
            echo "Операция отклонена";// . mysqli_error($connect);
        }
    }
    ?>
    <a href="profile.php" class="logout">Назад</a>
</form>

<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>

