
 <?php

     include_once 'database.php';

     class todo
      {
        private $pdo;

        public function __construct(){
            $this->pdo = new DataBase();
        }

        public function getAll(){
            $sql="SELECT * from dsi order by complete,due_date";
          /*  $query=$this->pdo->prepare($sql);
            $query->execute();*/
            $query=$this->pdo->launch_query($sql);
            return $query->fetchAll();
        }

        public function get($id){
            $sql='SELECT * FROM dsi where id=:id';
           /* $query=$this->pdo->prepare($sql);
            $query->execute(['id'=>$id]);*/
            $query=$this->pdo->launch_query($sql,['id'=>$id]);
            return $query->fetch();
        }

     }


?>