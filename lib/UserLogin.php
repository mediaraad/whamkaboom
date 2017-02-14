<?php
class UserLogin
{
    private $pdo;
    private $id;
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



    public function checkUser($userName)
    {
        $stmt = $this->mysqli->prepare("SELECT memberID, userName, salt, hash FROM members WHERE userName = ? LIMIT 1");

        $stmt->bind_param("s",$userName);
        $stmt->execute();
        $stmt->bind_result($this->id, $this->user, $this->salt, $this->hash);

        //
        if (null === ($userNameData = $stmt->fetch_assoc()))
        {
            return false;
        }
        $this->user = $userNameData['userName'];
        $this->user = $userNameData['salt'];
        $this->user = $userNameData['hash'];
        return true;
    }



    public function checkPass($password)
    {
        return (hash_hmac("sha256", $password, $this->salt) === $this->hash);
    }
}

