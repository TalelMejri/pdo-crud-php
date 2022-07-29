<?php 
    if(!array_key_exists('id',$_GET) or !ctype_digit($_GET['id'])){
        header("location:index.php?type=danger&msg=id incorrect !");
        exit();
    } 

    include "connect_db.php";
    // recuperation de todo
    $sql=$pdo->prepare("SELECT * from dsi WHERE id=?");
    $sql->execute([$_GET['id']]);
    $todo=$sql->fetch();
    if($todo){
        $query=$pdo->prepare('DELETE FROM dsi where id=:todoid');
        $query->execute([
            'todoid'=>$_GET['id']
        ]);
    }
    else{
        header("location:index.php?type=danger&msg=todo not found !");
    exit();
}
    header("location:index.php?type=success&msg=delete todo succefuly");
    exit();

?>