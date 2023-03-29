<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
  

    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";


        public function __construct(){
            parent::connect();
        }

        public function findTopicsByCategory($id) // topic par catégorie
        {
            $sql = "SELECT * 
                    FROM ".$this->tableName." t
                    WHERE t.category_id = :id
                    ORDER BY dateCreationTopic DESC";


            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]),
                $this->className
            );
        }

       
         //Ajouter un nouveau topic

         public function addTopic($id){
            $sql="INSERT INTO topic (title)
            VALUES (:title)";
            
            return $this-> getMultipleResults(
                DAO::select($sql,['id'=>$id],true),
                $this->className
            );
        }

        // verouiller topic

        
        public function lock($id){
            $sql = "UPDATE " . $this->tableName . "
                    SET locked = 1
                    WHERE id_topic = :id";
                    
            DAO::update($sql, ['id' => $id]);
        }


        public function deleteTopic($id){
            $sql = "DELETE FROM ".$this->tableName."
                    WHERE id_".$this->tableName." = :id
                    ";

            return DAO::delete($sql, ['id' => $id]); 
        }


    }