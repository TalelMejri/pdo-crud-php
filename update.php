<?php 

    session_start();
    if(!isset($_SESSION['username'])){
        header('location:./login.php');
        exit();
    }
    
    if(!(array_key_exists('id',$_GET) or array_key_exists('id',$_POST)) and !(ctype_digit($_GET['id']) or ctype_digit($_POST['id']))){
        header("location:index.php");
        exit();
    } 
    include "connect_db.php";
    include "utilities.php";
    $errors=[];
   if(!empty($_POST)){
        $titel=checkdata($_POST['titel']);
        $description=checkdata($_POST['description']);
        $due_date=checkdata($_POST['due_date']);
        $id=checkdata($_POST['id']);

        if(empty($titel)){
            $errors['titel']='this required';
        }
        if(empty($description)){
            $errors['description']='this required';
        }
        if(empty($due_date)){
            $errors['due_date']='this required';
        }
        if(empty($errors)){
            $query=$pdo->prepare("UPDATE dsi SET titel=:titel,description=:description,due_date=:due_date WHERE id=:todoid");
            $query->execute([
                'titel'=>$titel,
                'description'=>$description,
                'due_date'=>$due_date,
                'todoid'=>array_key_exists('id',$_GET)?$_GET['id']:$_POST['id']
          ]);

             header("location:index.php");
             exit();
         }
  }

    $sql=$pdo->prepare("SELECT * from dsi WHERE id=?");
    $sql->execute([$_GET['id']]);
    $todo=$sql->fetch();

    if(!$todo){
        header("location:index.php");
        exit;
    }

    $template="update";
    $page_titel="update";
    include "layout.phtml";
?>