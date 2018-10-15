<?php
session_start();
unset($_SESSION['storeid']);
header ('Location: ../index.php');
?>