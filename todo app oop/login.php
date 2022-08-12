<?php 

  include "./classes/user.php";
  session_start();
  $errors=[];

  if(isset($_POST['submit'])){
    extract($_POST);
    if(empty($email) && empty($password)){
        $errors[0]="all field is empty";
        goto show_form;
    }
    if(empty($email)){
        $errors[0]="filed email is empty";
        goto show_form;
    }
    if(empty($password)){
        $errors[0]="filed password is empty";
        goto show_form;
    }
    if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
        $errors[0]="invalid email";
        goto show_form;
    }
    if(strlen($password)<6){
        $errors[0]="password must be at least 6 characters";
        goto show_form;
    }
   if(empty($errors)){
        /*$query=$pdo->prepare("SELECT * FROM users where email=:email");
        $query->execute(['email'=>$email]);
        $users=$query->fetch();
       if($users==false){
        $errors[0]="warning password or email";
        goto show_form;
        }else{
           if(password_verify($password,$users['password'])){
             $_SESSION['id']=$users['iduser'];
             $_SESSION['username']=$users['username'];
             $_SESSION['email']=$users['email'];
             $_SESSION['avatar']=$users['avatar'];
             header("location:./index.php");
            }else{
                $errors[0]="warning password or email";
                goto show_form;
            }
         }*/
         $user=new user();
         $verifier=$user->login($email,$password);
         if($verifier==false){
               $errors[0]="warning password or email";
                goto show_form;
         }else{
             header("location:index.php");
            exit;
         }
        }
  }
  show_form:
  $template="login";
  $page_titel="login page";
  include "./layout.phtml";
  
?>