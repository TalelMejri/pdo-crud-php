<?php 
 session_start();
    if(!isset($_SESSION['username'])){
        header('location:./login.php');
        exit();
    }
    include './classes/todo.php';
    $todo=new Todo();
    $res=$todo->get($_GET['id']);
    $todo->check($_GET['id'],!$res['complete']);
    header("location:index.php");
    exit();

?>