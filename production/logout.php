<?php
session_start();
unset($_SESSION['productionid']);
header ('Location: ../index.php');
?>