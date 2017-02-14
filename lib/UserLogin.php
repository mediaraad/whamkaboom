<?php
class UserLogin
{
    private $pdo;
    private $userName;
    private $salt;
    private $hash;
    private $role;

    private $error = false;

    protected $mysqli;
    protected $namen;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return array
     */
    public function getNamen()
    {
        $this->namen= array("hub","buhbuh","gast","g_2009");
        return $this->namen;
    }


    public function userValidLogin ( $login, $password ) {
        $namen=$this->getNamen();
        $aantal=count($namen);
        $ret = false;
        //sql statement mogelijk

        if ($login=='' or $password=='') {
            $ret=false;
            $this->setError("Fout: Toegang geweigerd") ;
        }

        else {
            for ($i=0;$i<=$aantal;$i=$i+2) {
                if (isset($namen[$i]) && $login==$namen[$i]) {
                    if ($password==$namen[$i+1]) {
                        $ret=true;
                        $this->setError("OK");
                    }
                    else {
                        $ret=false;
                        $this->setError("Fout: Toegang geweigerd");
                    }
                }
            }
        }
    // sql afhandeling
        return $ret;
    }

    public function userValidCrypt ( $login, $crypt_password ) { //nodig bij index.php
        $namen=$this->getNamen();
        $aantal=count($namen);
        $ret = false;

        $salt = substr($crypt_password, 0, 2);
        //sql statement mogelijk
        $res=false;
        for ($i=0;$i<=$aantal;$i=$i+2) {
            if (isset($namen[$i]) && $login==$namen[$i]) {
                $j=$i+1;
                $password=$namen[$j];
                $res=true;
                //echo "gevonden ID/PW: $login $password<br>";
            }
            //echo "$namen[$i] - $namen[$j]<br>";
        }
        if ( $res ) {
            //echo "RES routine<br>";
            if ( crypt($password, $salt) == $crypt_password ) {
                $ret = true; // found login/password
//		echo "Goed";
            }
// sql afhandeling
            else $this->setError("Geen toegang");
        }
        else {
            $this->setError("Geen toegang");
        }
        return $ret;
    }





    private function setError($val)
    {
        $this->error = $val;
    }



    private function getError()
    {
        return $this->error;
        
    }



    public function userLogin($userName, $pass)
    {
        if($this->checkUser($userName) && $this->checkPass($pass))
        {
            //$_SESSION['memberID']   = $this->id;
            $_SESSION['memberName'] = $this->user;

            return true;
        }
        else {
            $this->setError("Invalid username/password");
        }
    }



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
            if (password_verify($password,$hash)) $goIn = true;
        }
        return $goIn;
    }

    public function queryForUser($userName){
        $pdo= $this->getPDO();
        $statement = $pdo->prepare('SELECT * FROM users_tbl WHERE user_name = :username limit 0,1');
        $statement->bindParam(':username',$userName, PDO::PARAM_STR);

        $statement->execute();
        $userArray = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $userArray;
    }

    public function checkPass($password)
    {
        return (hash_hmac("sha256", $password, $this->salt) === $this->hash);
    }


    /**
     * @return PDO
     */
    public function getPDO()
    {
        return $this->pdo;
    }




}

