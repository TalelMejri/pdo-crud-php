<?php

    include './classes/Todo.php';
    $todo=new todo();
    $todo=$todo->get($_GET['id']);
    $template='details';
    $page_titel='detail';
    include './layout.phtml';

?>