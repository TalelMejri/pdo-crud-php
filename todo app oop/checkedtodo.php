<?php 


    $query=$pdo->prepare("UPDATE dsi SET complete=:com where id=:idtodo");
    $query->execute(["com" => !$todo['complete'],
                    "idtodo"=>$_GET['id']]);
    include './classes/todo.php';
    

    header("location:index.php");
    exit();
    

?>