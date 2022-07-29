<?php 
    session_start();
    session_destroy();
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    header('location:login.php');
?>