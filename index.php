
<?php   
        session_start();
        if(!isset($_SESSION['email'])){
            header('location:./login.php');
            exit();
        }
        include "connect_db.php"; 
        $query=$pdo->prepare("SELECT * from dsi order by complete,due_date");
        $query->execute();
        $todos=$query->fetchall();
        $template="index";
        $page_titel="Todos";
        include "./layout.phtml";
    ?>

