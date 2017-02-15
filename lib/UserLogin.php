<?php
class UserLogin
{
    private $pdo;
    private $userName;
    private $role;

    private $error = false;

    protected $mysqli;
    protected $namen;

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
        $pdo= $this->getPDO();
        $statement = $pdo->prepare('SELECT * FROM users_tbl WHERE user_name = :username limit 0,1');
        $statement->bindParam(':username',$userName, PDO::PARAM_STR);
        $statement->execute();
        $userArray = $statement->fetch(PDO::FETCH_ASSOC);
        $user=$userArray['user_name'];
        $goIn = false;
        if (!($user===null)) {
            $hash=$userArray['user_hash'];
            if (password_verify($password,$hash)) {
                $goIn = true;

            }
        }

        return $goIn;
    }


    /**
     * @return PDO
     */
    public function getPDO()
    {
        return $this->pdo;
    }




}

