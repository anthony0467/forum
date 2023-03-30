<?php
    namespace Model\Entities;

    use App\Entity;

    final class User extends Entity{

        private $id;
        private $email;
        private $pseudo;
        private $role;
        private $dateCreationMember;
        private $password;
        private $status;
    

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
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of user
         */ 
        public function getPseudo()
        {
                return $this->pseudo;
        }

        /**
         * Set the value of user
         *
         * @return  self
         */ 
        public function setPseudo($pseudo)
        {
                $this->pseudo = $pseudo;

                return $this;
        }

        public function __toString()
        {
                return $this->pseudo;
        }


         /**
         * Get the value of user
         */ 
        public function getRole()
        {
                return $this->role;
        }

        /**
         * Set the value of user
         *
         * @return  self
         */ 
        public function setRole($role)
        {
                $this->role = $role;

                return $this;
        }

        public function hasRole($role) // verifier si le role correspond 
        {
        return $this->role === $role;
        }
       

        public function getDateCreationMember(){
            $formattedDate = $this->dateCreationMember->format("d/m/Y, H:i:s");
            return $formattedDate;
        }

        public function setDateCreationMember($dateCreationMember){
            $this->dateCreationMember = new \DateTime($dateCreationMember);
            return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        
        /**
         * Get the value of status
         */ 
        public function getStatus()
        {
                return $this->status;
        }

        /**
         * Set the value of status
         *
         * @return  self
         */ 
        public function setStatus($status)
        {
                $this->status= $status;

                return $this;
        }
    }
