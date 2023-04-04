<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class LikepostManager extends Manager{

        protected $className = "Model\Entities\Likepost";
        protected $tableName = "likepost";


        public function __construct(){
            parent::connect();
        }

       
    }