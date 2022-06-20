<?php
session_start();
unset($_SESSION['card']);
header('Location: ../authorization.php');
