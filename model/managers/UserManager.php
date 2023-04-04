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

    public function statusBan($id, $ban)
    {
        $sql = "UPDATE " . $this->tableName . "
                    SET status = :statusBan
                    WHERE id_user = :id";

        DAO::update($sql, ['statusBan' => $ban,'id' => $id]);
    }


    public function statusRole($id, $role)
    {
        $sql = "UPDATE " . $this->tableName . "
                    SET status = :statusRole
                    WHERE id_user = :id";

        DAO::update($sql, ['statusRole' => $role,'id' => $id]);
    }

   

}
