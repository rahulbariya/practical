<?php 
	session_start();
	if(empty($_SESSION['Id']) &&  empty($_SESSION['Email'])){
        header('location:login.php');
    }
?>