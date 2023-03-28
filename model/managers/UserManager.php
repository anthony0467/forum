<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;


class UserManager extends Manager
{

    protected $className = "Model\Entities\User";
    protected $tableName = "user";


    public function __construct()
    {
        parent::connect();
    }

    // récupérer le champ mail
    public function findOneByEmail($email)
    {
        $sql = "SELECT *
            FROM " . $this->tableName . " a
            WHERE a.email = :email
            ";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['email' => $email], false),
            $this->className
        );
    }

    public function findOneByUser($pseudo)
    {
        $sql = "SELECT *
            FROM " . $this->tableName . " a
            WHERE a.pseudo = :pseudo
            ";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['pseudo' => $pseudo], false),
            $this->className
        );
    }

    public function retrievePassword($email){
        $sql = "SELECT *
            FROM " . $this->tableName . " u
            WHERE u.email = :email
            ";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['email' => $email], false),
            $this->className
        );
    }

}
