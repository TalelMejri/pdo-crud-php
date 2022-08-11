<?php 

    include './classes/todo.php';
    $todo=new Todo();
    $res=$todo->get($_GET['id']);
    $todo->check($_GET['id'],!$res['complete']);
    header("location:index.php");
    exit();

?>