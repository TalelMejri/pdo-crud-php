<?php 
    
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
          /*  $sql="INSERT INTO dsi (titel,description,due_date,userid) VALUES (?,?,?,?)";
            $query=$pdo->prepare($sql);
            $query->execute([$titel,$description,$due_date,$_SESSION['id']]);*/
            include './classes/todo.php';
            $todo=new todo();
            $todos=$todo->create($titel,$description,$due_date);
            header("location:index.php?type=success&msg=Todo added succefuly");
            // astuce /// 
            //header("location:detail.php?id=".$todos);
            exit();
        }
     }

     $template="addtodo";
     $page_titel="addtodo";
     include "layout.phtml";

?>