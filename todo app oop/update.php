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

    include "./classes/Todo.php";
    $todo=new Todo();

    $errors=[];
   if(!empty($_POST)){
      include "utilities.php";
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
              
            $res=$todo->update_todo($titel,$description,$due_date,$id);
             header("location:detail.php?id=".$id);
             exit();
         }
  }
    $todo=$todo->get(array_key_exists('id',$_GET)?$_GET['id']:$_POST['id']);
    if(!$todo){
        header("location:index.php");
        exit;
    }

    $template="update";
    $page_titel="update";
    include "layout.phtml";
?>