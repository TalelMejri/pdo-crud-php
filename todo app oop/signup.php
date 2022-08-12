<?php 
 
 include "./classes/user.php";
 include "./classes/File.php";

$errors=[];
  if (isset($_POST['signup'])){
     include "utilities.php";
     extract($_POST);
     echo '<pre>';
     print_r($_FILES);
     echo '</pre>';
    exit ;
    
    $file = new File('./storage/avatars/',$_FILES['avatars']);

    if(strlen($username)<3){
        $errors[0]="username must be at least 3 characters";
        goto show_form;
    }
    if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
        $errors[0]="email incorect";
        goto show_form;
    }
    
    if(strlen($password)<6){
        $errors[0]="password must be at least 3 characters";
        goto show_form;
    }
    if(strlen($confirm)<6){
        $errors[0]="confirm password must be at least 3 characters";
        goto show_form;
    }
    if($confirm!=$password){
        $errors[0]="confirm password must be password";
        goto show_form;
    }
    if(empty($errors)){
       /* $sql="SELECT * from users";
        $query=new todo();
        $stmt=$query->launchquery($sql);
        $touve=0;
        $todo=$stm->fetchall();
        foreach($todo as $key=>$to){
             if($to['username']==$username && $to['email']==$email){
                    $trouve=1;
             }
        }*/
     //   if($trouve==0){
            $todo=new user();
            $id=$todo->signup($username,$email,$password);
        if(is_int($id)){
            header('location:./login.php');
            exit;
        }else{
            $errors[0]=$id;
        }
                //    }else{
                   /*     $errors[0]="déja existe";
                        goto show_form;
                    }*/
}
  }
show_form:
 $template="signup";
 $page_titel="sign up";
 include "./layout.phtml";
?>