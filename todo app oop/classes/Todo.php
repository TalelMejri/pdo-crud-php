
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
         * @param int $id
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

        /***
         * create new todo
         * @param string $titel
         * @param String $description
         * @param Date $due_date
         * 
         * return last id created
         */
        public function create($titel,$description,$due_date,$id)
        {
         $sql="INSERT INTO dsi (titel,description,due_date,userid) VALUES (?,?,?,?)";
         $this->pdo->launch_query($sql,[$titel,$description,$due_date,$id]);
         return $this->pdo->lastInsertId();
        }
/**
 * delete todo
 * @param int $id
 */
        public function delete($id):void
        {
            $sql="Delete from dsi where id=:id";
            $this->pdo->launch_query($sql,['id'=>$id]);
        }

/**
 * 
 * check todo with id
 * @param int $id
 */
        public function check(int $id,int $opposer_complete):void
        {
            $sql='UPDATE dsi SET complete=:com where id=:idtodo';
            $this->pdo->launch_query($sql,['com'=>$opposer_complete,'idtodo'=>$id]);
        }

        /**
         * @param string titel
         * @param string description
         * @param string due_date
         */


        public function update_todo(String $titel,String $description,String $due_date){
            $query="UPDATE dsi SET titel=:titel,description=:description,due_date=:due_date WHERE id=:todoid";
            $this->pdo->launch_query($query,[
                'titel'=>$titel,
                'description'=>$description,
                'due_date'=>$due_date,
               // 'todoid'=>$id]
                 'todoid'=>array_key_exists('id',$_GET)?$_GET['id']:$_POST['id']]
            );
        }

     }


?>