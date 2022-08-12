<?php 

  require_once "database.php";

   class user{

    private $pdo;
    public function __construct(){
        $this->pdo=new dataBase();
    }

    /***
     * @param String $email
     * @param String $password
     * 
     * return Boolean
     */
    public function login(String $email,String $password):bool{
        $sql="SELECT * from users where email=:email";
        $stmt=$this->pdo->launch_query($sql,['email'=>$email]);
        $user=$stmt->fetch();
        if($user==false){
            return false;
        }else{
            if(password_verify($password,$user['password'])){
                $_SESSION['iduser']=$user['iduser'];
                $_SESSION['username']=$user['username'];
                $_SESSION['email']=$user['email'];
                $_SESSION['$password']=$user['password'];
                $_SESSION['avatar']=$user['avatar'];
                return true;
            }else{
                return false;
            }
        }

    }


    /***
     * @param String $email
     * @param String $password
     * @param String $username
     * 
     * return integer
     */

    public function signup(String $username,String $email,String $password):int{
        $sql="INSERT INTO users (username,email,password) VALUES (:username,:email,:password)";
        $this->pdo->launch_query($sql,[
         'username'=>$username,
         'email'=>$email,
         'password'=>password_hash($password,PASSWORD_DEFAULT)]);
         return $this->pdo->lastInsertId();
    }

   }


?>