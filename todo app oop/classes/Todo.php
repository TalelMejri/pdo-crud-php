
 <?php

     include_once 'database.php';

     class todo
      {
        private $pdo;

        public function __construct(){
            $this->pdo = new DataBase();
        }
/**
 * get all toto
 * retrun array $todos[]
 */
        public function getAll():array{
            $sql="SELECT * from dsi order by complete,due_date";
          /*  $query=$this->pdo->prepare($sql);
            $query->execute();*/
            $query=$this->pdo->launch_query($sql);
            return $query->fetchAll();
        }

        /**
         * get todo with id
         * 
         * return array $todo[]
         */
        public function get($id):array
        {
            $sql='SELECT * FROM dsi where id=:id';
           /* $query=$this->pdo->prepare($sql);
            $query->execute(['id'=>$id]);*/
            $query=$this->pdo->launch_query($sql,['id'=>$id]);
            return $query->fetch();
        }

        public function create($titel,$description,$due_date){
         $sql="INSERT INTO dsi (titel,description,due_date,userid) VALUES (?,?,?,?)";
         $this->pdo->launch_query($sql,[$titel,$description,$due_date,1]);
         return $this->pdo->lastInsertId();
        }

     }


?>