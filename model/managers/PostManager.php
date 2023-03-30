<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
  

    class PostManager extends Manager{

        protected $className = "Model\Entities\Post";
        protected $tableName = "post";


        public function __construct(){
            parent::connect();
        }

        //List des posts par topic
        
        public function findPostsByTopic($id) 
        {
            $sql = "SELECT * 
                    FROM ".$this->tableName." p
                    WHERE p.topic_id = :id
                    ORDER BY dateCreationMessage";


            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]),
                $this->className
            );
        }
    
        //Ajouter une nouveau post dans un topic

        public function addPost($id){
            $sql="INSERT INTO post (textPost)
            VALUES (:post)";
            return $this-> getMultipleResults(
                DAO::select($sql,['id'=>$id],true),
                $this->className
            );

            
        }

        //effacer un poste

        public function deletePost($id): int
        {

            $topicId = $this->findOneById($id)->getTopic()->getId();
          

            $sql = "DELETE FROM ".$this->tableName."
                    WHERE id_".$this->tableName." = :id
                    ";

            DAO::delete($sql, ['id' => $id]); 
            $countPost = "SELECT  COUNT(*) AS nbPoste
            FROM ".$this->tableName."
            WHERE topic_id = :id";

            
          

           $nbPost =  DAO::select($countPost, ['id' => $topicId], false); 
            if(intVal($nbPost['nbPoste'] == 0)){
                $topicManager = new TopicManager();
                $topicManager->deleteTopic($topicId, $nbPost);
            }

            return $nbPost['nbPoste'];

        }

       

    }