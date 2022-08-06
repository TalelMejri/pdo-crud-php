<?php 
    include './classes/todo.php';

    $todo=new todo;
    $todo->delete($_GET['id']);
    header("location:index.php?type=success&msg=delete todo succefuly");
    exit();

?>