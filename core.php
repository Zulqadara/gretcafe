<?php
$db = mysqli_connect('localhost','root','','cafe');
if (mysqli_connect_errno()){
	echo 'Database Connection Failed With Following Errors: '.mysqli_connect_error();
	die();
	}

define('BASEURL',$_SERVER['DOCUMENT_ROOT'].'/cafe/');
	
require_once BASEURL.'helpers.php';
session_start(); 
?>