<?php
    namespace Model\Entities;

    use App\Entity;

    final class Likepost extends Entity{

        private $user;
        private $post;
        
        public function __construct($data){         
            $this->hydrate($data);        
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
         * Get the value post
         */ 
        public function getPost()
        {
                return $this->post;
        }

        /**
         * Set the value post
         *
         * @return  self
         */ 
        public function setPost($post)
        {
                $this->post = $post;

                return $this;
        }

    }
