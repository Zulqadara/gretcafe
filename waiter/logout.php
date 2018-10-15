<?php
session_start();
unset($_SESSION['id']);
unset($_SESSION['orderid']);
header ('Location: ../index.php');
?>