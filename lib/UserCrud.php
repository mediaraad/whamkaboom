<?php

class UserCrud {
    private $pdo;
    const TYPE_ROL_GAST = 1;
    const TYPE_ROL_ADMIN= 2;
    const TYPE_ACTIVE_NO=0;
    const TYPE_ACTIVE_YES=1;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return tekenaars[]
     */
    public function getUsers($user,$id="")
    {
        $usersData = $this->queryForUsers($user,$id);

        $users = array();

        foreach ($usersData as $userData) {
            $gebruiker = new Users();
            $gebruiker->setUserId($userData['user_id']);
            $gebruiker->setUserName($userData['user_name']);
            $gebruiker->setHash($userData['user_hash']);
            $gebruiker->setRole($userData['user_role']);
            $gebruiker->setActive($userData['user_active']);
            $gebruiker->setEmail($userData['user_email']);
            $gebruiker->setCreationDate($userData['user_creation_date']);


            $users[] = $gebruiker;
        }

        return $users;
    }


    /**
     * @param string $user
     * @return array
     */
    private function queryForUsers($user, $id) {

        $pdo= $this->getPDO();

        if ($id == null && $user==null) {
            $statement = $pdo->prepare('SELECT * FROM users_tbl WHERE user_name=""');
        }
        elseif ($id == null && $user!=null) {
            $statement = $pdo->prepare('SELECT * FROM users_tbl WHERE user_name LIKE :username ORDER BY user_name');
            //if ($user=="") $naam="";
            //else
            $naam=$user."%";
            $statement->bindParam(':username',$naam, PDO::PARAM_STR);
        }
        else {
            $statement = $pdo->prepare('SELECT * FROM users_tbl WHERE user_id = :id limit 0,1');
            $statement->bindParam(':id',$id, PDO::PARAM_INT);
        }

        $statement->execute();
        $usersArray = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $usersArray;
    }


    /**
     * @return PDO
     */
    public function getPDO()
    {
        return $this->pdo;
    }


    /** CrUd
     *
     * @param $id
     * @param $naam
     * @param $hash
     * @param $role
     * @param $active
     * @param $email
     * @param $creationDate
     * @return bool
     */
    public function createOrUpdateUser($id,$naam,$hash,$role,$active,$email,$creationDate)
    {
        $pdo = $this->getPDO();

        try
        {
            if ($id=='') {
                $stmt = $pdo->prepare("INSERT INTO users_tbl (user_name,user_hash,user_role,user_active,user_email,user_creation_date) VALUES(:naam, :hash, :rol, :actief, :email, :datum)");
            }
            else {
                $stmt=$pdo->prepare("UPDATE users_tbl SET user_name=:naam, user_hash=:hash, user_role=:rol, user_active=:actief, user_email=:email, user_creation_date=:datum WHERE user_id=:id ");
                $stmt->bindparam(":id",$id);
            }

            $stmt->bindparam(":naam",$naam, PDO::PARAM_STR);
            $stmt->bindparam(":hash",$hash);
            $stmt->bindparam(":rol",$role, PDO::PARAM_INT);
            $stmt->bindparam(":actief",$active);
            $stmt->bindparam(":email",$email);
            $date=date('Y-m-d H:i:s',time());
            //$stmt->bindparam(":datum",date("Y-m-d H:i:s", strtotime($creationDate)), PDO::PARAM_STR);
            $stmt->bindparam(":datum",$date, PDO::PARAM_STR);
            $stmt->execute();
            $idLast=$pdo->lastInsertID();

            return $idLast;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }

    }


    /** cruD
     *
     * @param $id
     * @return bool
     */
    public function deleteUser($id)
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("DELETE FROM users_tbl WHERE user_id=:id");
        $stmt->bindparam(":id",$id);
        $stmt->execute();
        return true;
    }





}