<?php 
    
     class DataBase extends PDO
     {
        const DB_HOST="localhost";
        const DB_NAME="todos";
        const DB_USER="root";
        const DB_PASSWORD="";

      public function __construct()
         {
            $dsn='mysql:host='.self::DB_HOST.';dbname='.self::DB_NAME;
        try{
            //new PDO($dsn,self::DB_USER,self::DB_PASSWORD);
                  //ou bien
            parent::__construct($dsn,self::DB_USER,self::DB_PASSWORD);
            $this->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
            $this->query('SET NAMES UTF8');
        }catch(Exception $e){
            echo 'connect failed :'.$e->getMessage();
        }
      }

      public function launch_query(string $sql,array $param = []){
        $stmt=parent::prepare($sql);
        $stmt->execute($param);
        return $stmt;
      }

     }



?>