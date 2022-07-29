<?php 
 
 include "connect_db.php";
 include "utilities.php";
$errors=[];
  if (isset($_POST['signup'])){
    extract($_POST);

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
        $sql="SELECT * from users";
        $stm=$pdo->prepare($sql);
        $stm->execute();
        $touve=0;
        $todo=$stm->fetchall();
        foreach($todo as $key=>$to){
             if($to['username']==$username && $to['email']==$email){
                    $trouve=1;
             }
        }
        if($trouve==0){
        $sql="INSERT INTO users (username,email,password) VALUES (:username,:email,:password)";
        $query=$pdo->prepare($sql);
        $query->execute(['username'=>$username,
                         'password'=>password_hash($password,PASSWORD_DEFAULT),
                         'email'=>$email
                        ]);
                        header('location:./login.php');
                    }else{
                        $errors[0]="déja existe";
                         goto show_form;
                    }

}
  }
show_form:
 $template="signup";
 $page_titel="sign up";
 include "./layout.phtml";
?>