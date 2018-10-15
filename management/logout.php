<?php
session_start();
unset($_SESSION['managementid']);
header ('Location: ../index.php');
?>