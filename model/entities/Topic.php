<?php
    namespace Model\Entities;

    use App\Entity;

    final class Topic extends Entity{

        private $id;
        private $title;
        private $user;
        private $category;
        private $dateCreationTopic;
        private $locked;
        private $nbPosts;
        

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
         * Get the value of title
         */ 
        public function getTitle()
        {
                return $this->title;
        }

        /**
         * Set the value of title
         *
         * @return  self
         */ 
        public function setTitle($title)
        {
                $this->title = $title;

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

        /**
         * Get the value of category
         */ 
        public function getCategory()
        {
                return $this->category;
        }

        /**
         * Set the value of category
         *
         * @return  self
         */ 
        public function setCategory($category)
        {
                $this->category = $category;

                return $this;
        }

        public function getDateCreationTopic(){
            $formattedDate = $this->dateCreationTopic->format("d/m/Y, H:i:s");
            return $formattedDate;
        }

        public function setDateCreationTopic($dateCreationTopic){
            $this->dateCreationTopic = new \DateTime($dateCreationTopic);
            return $this;
        }

        /**
         * Get the value of closed
         */ 
        public function getLocked()
        {
                return $this->locked;
        }

        /**
         * Set the value of closed
         *
         * @return  self
         */ 
        public function setLocked($locked)
        {
                $this->locked = $locked;

                return $this;
        }

        public function lockedTopic()
        {
        $this->locked = 1;
        }

        /**
         * Get the value of nbPost
         */ 
        public function getNbPosts()
        {
                return $this->nbPosts;
        }

        /**
         * Set the value of nbPost
         *
         * @return  self
         */ 
        public function setNbPosts($nbPosts)
        {
                $this->nbPosts = $nbPosts;

                return $this;
        }


    }
