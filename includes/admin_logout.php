<?php
session_start();
unset($_SESSION['atm']);
header('Location: ../admin_authorization.php');
