<?php 
 
 include "./classes/user.php";
 include "./classes/File.php";

$errors=[];
  if (isset($_POST['signup'])){
     include "utilities.php";
     extract($_POST);
     /*echo '<pre>';
     print_r($_FILES);
     echo '</pre>';
    exit ;*/

    $file = new File('./storage/avatars/',$_FILES['avatar']);

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
    $upload=$file->uploadfile();
    if(!$upload){
        $errors[0]="file upload failed";
        goto show_form;
    }
    if($file->sizefile()==false){
        $errors[0]="please upload an image smaller than 1MB";
        goto show_form;
    }
    if($file->isImage()==false){
         $errors[0]="please upload an image";
        goto show_form;
    }
    
    $avatar='./storage/avatars/'.$file->getfilename();
    if(empty($errors)){
            $todo=new user();
            $id=$todo->signup($username,$email,$password,$avatar);
        if(is_int($id)){
            header('location:./login.php');
            exit;
        }else{
            $errors[0]=$id;
        }
}
  }
show_form:
 $template="signup";
 $page_titel="sign up";
 include "./layout.phtml";
?>