<?php
session_start();
unset($_SESSION['orderid']);
header ('Location: index.php');
?>