<?php 

    require_once 'database.php';

    class file{
        private $pdo;

        public function __construct(){
            $this->pdo=new DataBase();
        }

        
    }


?>