<?php 
    session_start();
      if(!isset($_SESSION['username'])){
        header('location:./login.php');
        exit();
     }
    include "connect_db.php";
    include "utilities.php";

     $errors=[];
     $titel='';
     $description='';
     $due_date='';

     if(!empty($_POST)){
        $titel=checkdata($_POST['titel']);
        $description=checkdata($_POST['description']);
        $due_date=checkdata($_POST['due_date']);

        if(empty($_POST['titel'])){
            $errors['titel']='titel required';
        }
        
        if(empty($_POST['description'])){
            $errors['description']='description required';
        }
        
        if(empty($_POST['due_date'])){
            $errors['due_date']='due_date required';
        }

        if(empty($errors)){
            $sql="INSERT INTO dsi (titel,description,due_date) VALUES (?,?,?)";
            $query=$pdo->prepare($sql);
            $query->execute([$titel,$description,$due_date]);

            header("location:index.php?type=success&msg=Todo added succefuly");
            exit();
        }
     }

     $template="addtodo";
     $page_titel="addtodo";
     include "layout.phtml";

?>