<?php 

    session_start();
    if(!isset($_SESSION['username'])){
         header('location:./login.php');
         exit();
    }
    include "./connect_db.php";
    $id=$_GET['id'];
    $query=$pdo->prepare("SELECT * from dsi WHERE id=?");
    $query->execute([$id]);
    $todo=$query->fetch();
    $page_titel="detail";
    $template="details";
    include "./layout.phtml";
?>