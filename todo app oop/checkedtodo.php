<?php 

    include './classes/todo.php';
    $todo=new todo();
    $todo->check($_GET['id']);
    header("location:index.php");
    exit();

?>