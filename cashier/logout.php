<?php
session_start();
unset($_SESSION['cashierid']);
header ('Location: ../index.php');
?>