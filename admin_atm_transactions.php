<?php
session_start();
require "includes/connect.php";

//$query = "SELECT * FROM bank.transactions"; //You don't need a ; like you do in SQL
//$result = mysql_query($query);

if( $_SESSION['admin_last_activity'] < time()-$_SESSION['admin_expire_time'] ) { //have we expired?
    echo "<script type='text/javascript'>alert('Вы были не активны более 5 минут');location='includes/admin_logout.php';</script>";
    //redirect to logout.php
    //header('Location: includes/logout.php'); //change yoursite.com to the name of you site!!
} else{ //if we haven't expired:
    $_SESSION['admin_last_activity'] = time(); //this was the moment of last activity.
}

//global $connect;
//$sql = mysqli_query($connect, "SELECT * FROM bank.transactions");
//$num_rows = mysqli_num_rows($sql);

//echo "<table>"; // start a table tag in the HTML

//while($row = mysqli_fetch_assoc($sql)){   //Creates a loop to loop through results
//    echo "<tr><td>" . htmlspecialchars($row['operation_time']) . "</td><td>" . htmlspecialchars($row['card_number']) . "</td></tr>";
//}

//echo "</table>"; //Close the table in HTML
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
<!-- Список транзакций-->
    <form method="get">
        <label>Укажите необходимое число последних транзакций</label>
        <input type="text" name="number">
        <button type="submit" name="trn-btn">Посмотреть</button>
        <?php
        if(isset($_GET['trn-btn'])){
            global $connect;
            $num_rows = $_GET['number'];
            $sql = mysqli_query($connect, "SELECT * FROM bank.transactions");//
            $all_num_rows = mysqli_num_rows($sql);

            if($all_num_rows > $num_rows){
                while ($all_num_rows > $num_rows){
                    mysqli_fetch_assoc($sql);
                    $all_num_rows = $all_num_rows - 1;
                }
            }
            echo "<div style='width: 1000px'><table>";
            echo "<tr><th>Время операции</th><th>Тип</th><th>Сумма</th></tr>";
            while($row = mysqli_fetch_assoc($sql)){
                echo "<tr><td>" . htmlspecialchars($row['operation_time']) . "</td><td>" . htmlspecialchars($row['operation_type']) . "</td><td>" . htmlspecialchars($row['cash_value']) . "</td></tr>";
            }
            echo "</table></div>";
        }
        ?>
        <a href="admin_profile.php" class="logout">Назад</a>
    </form>
</body>
</html>
