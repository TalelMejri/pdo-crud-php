<?php 

    require_once 'database.php';

    class file{
        private $filename;
        private $storagedirectory;
        private $fileExtention;
        private $filesize;
        private $filetmpname;

        public function __construct(String $storagepath,array $info_file){
            $this->filename=$info_file['name'];
            $this->storagedirectory=$storagepath;
            $this->fileExtention=pathinfo($this->filename,PATHINFO_EXTENSION);
            $this->filesize=$info_file['size'];
            $this->filetmpname=$info_file['tmp_name'];
        }

        /***
         * return bool
         * 
         */
        public function uploadfile():bool{
            $this->filename = md5(rand()). ' . ' .$this->fileExtention ; 
            if(!move_uploaded_file($this->filetmpname,$this->storagedirectory.$this->filename)){
                    return false;
            }
            return true;
        }

        /***
         * return string
         */
        public function getfilename():String{
            return $this->filename;
        }

        /**
         * return bool
         */
        public function isImage():bool{
            $alloewedextension=["jpg","jpeg","png","gif"];
            if(!in_array($this->fileExtention,$alloewedextension)){
                return false;
            }
            return true;
        } 

    /**
    * return bool
    */
        public function sizefile():bool{
            if($this->filesize>3000000){
                return false;
            }
            return true;
        }

    }


?>