<?php 
    if(! array_key_exists('id',$_GET) or !ctype_digit($_GET['id'])){
        header("location:index.php");
        exit();
    }

    include "connect_db.php";
    $sql=$pdo->prepare("SELECT * from dsi WHERE id=?");
    $sql->execute([$_GET['id']]);
    $todo=$sql->fetch();

    $query=$pdo->prepare("UPDATE dsi SET complete=:com where id=:idtodo");
    $query->execute(["com" => !$todo['complete'],
                    "idtodo"=>$_GET['id']]);
    header("location:index.php");
    exit();
    

?>