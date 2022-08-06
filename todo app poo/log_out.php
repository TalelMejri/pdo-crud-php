<?php 
    session_start();
    session_destroy();
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['password']);
    header('location:login.php');
?>