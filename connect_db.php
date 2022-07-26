<?php 

    define('DB_HOST','localhost');
    define('DB_USER','root');
    define('DB_Pass','');
    define('DB_name','todos');
    try{
        $pdo=new PDO('mysql:host='.DB_HOST.';dbname='.DB_name,DB_USER,DB_Pass);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
    }catch(Exception $e){
        echo "ereur connected".$e;
        die();
    }

?>