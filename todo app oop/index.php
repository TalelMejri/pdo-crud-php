<?php 
    include './classes/Todo.php';
     $todo= new todo();
     $todos=$todo->getAll();
     $template='index';
     $page_titel='list_todo';
     include './layout.phtml';
?>