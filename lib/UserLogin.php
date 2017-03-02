<?php
class UserLogin
{
    private $pdo;
    private $userName;
    private $role;

    private $error = false;


    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    private function setError($val)
    {
        $this->error = $val;
    }

    /**
     * @param $userName
     * @param $password
     * @return bool
     */

    public function checkUser($userName,$password)
    {
        $userData = $this->queryForUser($userName);


        $user=$userData['user_name'];
        $goIn = false;
        if (!($user===null)) {
            $hash=$userData['user_hash'];


            if (password_verify($password,$hash)) {



                $goIn = true;

            }


        }

        return $goIn;
    }

    private function queryForUser($userName) {
        $pdo= $this->getPDO();
        $statement = $pdo->prepare('SELECT * FROM users_tbl WHERE user_name = :username limit 0,1');
        $statement->bindParam(':username',$userName, PDO::PARAM_STR);
        $statement->execute();
        $userArray = $statement->fetch(PDO::FETCH_ASSOC);

        return $userArray;
    }




    /**
     * @return PDO
     */
    public function getPDO()
    {
        return $this->pdo;
    }




}

