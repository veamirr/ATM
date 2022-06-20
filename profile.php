<?php
//session_start();

require 'includes/data.php';
error_reporting(E_ALL ^ E_WARNING);
if(!$_SESSION['card']) {
    header('Location: authorization.php');
}

if( $_SESSION['last_activity'] < time()-$_SESSION['expire_time'] ) { //have we expired?
    echo "<script type='text/javascript'>alert('Вы были не активны более 2 минут');location='includes/logout.php';</script>";

    //redirect to logout.php
    //header('Location: includes/logout.php');
} else{ //if we haven't expired:
    $_SESSION['last_activity'] = time(); //this was the moment of last activity.
}

?>

<!DOCTYPE html>
<?php
setcookie("welcome", "С возвращением,", time() + 2 * 60);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<!-- Профиль -->
<form>
    <?php if (isset($_COOKIE["welcome"])): ?>
         <h2 align="center"><?= $_COOKIE["welcome"] ?></h2>
    <?php else: ?>
         <h2 align="center">Добро пожаловать,</h2>
    <?php endif ?>
    <h2 align="center"><?= $_SESSION['client']['name'] ?>!</h2>
    <!-- <h2><?= $_SESSION['card']['id_client'] ?> </h2> -->
    <p>
        <a href="balance.php">Запросить баланс</a>
    </p>
    <p>
        <a href="money_out.php">Получить наличные</a>
    </p>
    <p>
        <a href="money_in.php">Внести наличные</a>
    </p>
    <a href="includes/logout.php" class="logout">Выход</a>
</form>

</body>
</html>
