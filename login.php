<?php 
  include "connect_db.php";
  $errors=[];
  if(isset($_POST['submit'])){
    extract($_POST);
    if(empty($email) && empty($password)){
        $errors[0]="all field is empty";
        goto show_form;
    }
    if(empty($email)){
        $errors['email']="filed email is empty";
        goto show_form;
    }
    if(empty($password)){
        $errors['password']="filed password is empty";
        goto show_form;
    }
    if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
        $errors['email']="invalid email";
        goto show_form;
    }
    if(strlen($password)<6){
        $errors['password']="password must be at least 6 characters";
        goto show_form;
    }
    if(empty($errors)){
        $query=$pdo->prepare("SELECT * FROM users where email=:email");
        $query->execute(['email'=>$email]);
        $users=$query->fetch();
        var_dump($users);
    }
  }
  show_form:
  $template="login";
  $page_titel="login page";
  include "./layout.phtml";

?>