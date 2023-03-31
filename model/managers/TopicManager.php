<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;


class TopicManager extends Manager
{

    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";


    public function __construct()
    {
        parent::connect();
    }

    public function findTopicsByCategory($id) // topic par catégorie
    {
        $sql = "SELECT t.*, COUNT(p.id_post) as nbPosts 
        FROM " . $this->tableName . " t
        LEFT JOIN post p ON t.id_" . $this->tableName . " = p.topic_id
        WHERE t.category_id = :id
        GROUP BY t.id_" . $this->tableName . "
        ORDER BY dateCreationTopic DESC";

        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]),
            $this->className
        );

    }


    //Ajouter un nouveau topic

    public function addTopic($id)
    {
        $sql = "INSERT INTO topic (title)
            VALUES (:title)";

        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id], true),
            $this->className
        );
    }

    // verouiller topic


    public function lock($id)
    {
        $sql = "UPDATE " . $this->tableName . "
                    SET locked = 1
                    WHERE id_topic = :id";

        DAO::update($sql, ['id' => $id]);
    }

    // devérouiller topic
    public function unlock($id)
    {
        $sql = "UPDATE " . $this->tableName . "
                    SET locked = 0
                    WHERE id_topic = :id";

        DAO::update($sql, ['id' => $id]);
    }


    public function deleteTopic($id)
    {
        
            // Supprimer tous les messages associés au sujet
            $sql = "DELETE p FROM post p
                INNER JOIN " . $this->tableName . " t ON t.id_" . $this->tableName . " = p.topic_id
                WHERE t.id_" . $this->tableName . " = :id";
            DAO::delete($sql, ['id' => $id]);
        
        // Supprimer le sujet
        $sql = "DELETE FROM " . $this->tableName . " WHERE id_" . $this->tableName . " = :id";
        return DAO::delete($sql, ['id' => $id]);
    }


    public function searchTopic($search){
        $sql = "SELECT *
                    FROM ".$this->tableName." t
                    WHERE t.title = :search
                    ";


            return $this->getMultipleResults(
                DAO::select($sql, ['search' => $search]),
                $this->className
            );
    }

}