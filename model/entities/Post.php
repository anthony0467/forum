<?php
    namespace Model\Entities;

    use App\Entity;

    final class Post extends Entity{

        private $id;
        private $textPost;
        private $topic;
        private $dateCreationMessage;
        private $user;
    

        public function __construct($data){         
            $this->hydrate($data);        
        }
 
        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of post
         */ 
        public function getTextPost()
        {
                return $this->textPost;
        }

        /**
         * Set the value of post
         *
         * @return  self
         */ 
        public function setTextPost($textPost)
        {
                $this->textPost = $textPost;

                return $this;
        }

     

        public function getDateCreationMessage(){
            $formattedDate = $this->dateCreationMessage->format("d/m/Y, H:i:s");
            return $formattedDate;
        }

        public function setDateCreationMessage($dateCreationMessage){
            $this->dateCreationMessage = new \DateTime($dateCreationMessage);
            return $this;
        }

        /**
         * Get the value of topic
         */ 
        public function getTopic()
        {
                return $this->topic;
        }

        /**
         * Set the value of topic
         *
         * @return  self
         */ 
        public function setTopic($topic)
        {
                $this->topic = $topic;

                return $this;
        }

        /**
         * Get the value of user
         */ 
        public function getUser()
        {
                return $this->user;
        }

        /**
         * Set the value of user
         *
         * @return  self
         */ 
        public function setUser($user)
        {
                $this->user = $user;

                return $this;
        }
    }


    
