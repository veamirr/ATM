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

<!-- Получение наличных -->
<form method="post">
    <label>Введите сумму</label>
    <input type="text" name="number">
    <button type="submit" name="get-btn">Получить</button>
    <?php
    if(isset($_POST['get-btn'])){
        global $connect;
        global $name;
        global $account_number;
        $sum = $_POST['number'];
        $sql = mysqli_query($connect, "SELECT * FROM bank.atm WHERE atm.id = '123'");
        $atm_data = mysqli_fetch_assoc($sql);
        $atm_sum = $atm_data['balance'];


        if (($_SESSION['account']['balance'] >= $sum) & ($sum <= $atm_sum)){
            $sql2 = "UPDATE bank.atm SET balance=balance - '$sum' WHERE id = '123'";

            $lock_table = "lock tables account as account write";
            mysqli_query($connect, $lock_table);
            $sql = "UPDATE bank.account SET account.balance=account.balance - '$sum' WHERE account.number = '$account_number'";
            $check_query = mysqli_query($connect, $sql);
            sleep(10);
            $unlock_table = "unlock tables";
            mysqli_query($connect, $unlock_table);

            if ($check_query & mysqli_query($connect, $sql2)) {
                echo "Операция прошла успешно";
            } else {
                echo "Операция отклонена";// . mysqli_error($connect);
            }
        }elseif ($_SESSION['account']['balance'] < $sum){
            echo "Недостаточно средств";
        }else{
            echo "Выдача средств временно недоступна";
        }
    }
    ?>
    <a href="profile.php" class="logout">Назад</a>
</form>

<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>