<?php

  if(! array_key_exists('id',$_GET) or !ctype_digit($_GET['id'])){
        header("location:index.php");
        exit();
    }

    include './classes/Todo.php';
    $todo=new todo();
    $todo=$todo->get($_GET['id']);
    $template='details';
    $page_titel='detail';
    include './layout.phtml';

?>