
<?php   
        session_start();
        if(!isset($_SESSION['username'])){
            header('location:./login.php');
            exit();
        }
        include "connect_db.php"; 
        $query=$pdo->prepare("SELECT * from dsi where id=:iduser order by complete,due_date");
        $query->execute(['iduser'=>$_SESSION['id']]);
        $todos=$query->fetchall();
        $template="index";
        $page_titel="Todos";
        include "./layout.phtml";
    ?>

