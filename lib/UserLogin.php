<?php
class UserLogin
{
    private $id;
    private $user;
    private $salt;
    private $hash;
    private $error = false;

    protected $mysqli;

    public function __construct()
    {
        $this->mysqli = mysqliSingleton::init();
    }



    function setError($val)
    {
        $this->error = $val;
    }



    function getError()
    {
        return $this->error;
        
    }



    public function userLogin($user, $pass)
    {
        if($this->checkUser($user) && $this->checkPass($pass))
        {
            //$_SESSION['memberID']   = $this->id;
            $_SESSION['memberName'] = $this->user;

            return true;
        }
        else {
            $this->setError("Invalid username/password");
        }
    }



    public function checkUser($user)
    {
        $stmt = $this->mysqli->prepare("SELECT memberID, userName, salt, hash FROM members WHERE userName = ? LIMIT 1");

        $stmt->bind_param("s",$user);
        $stmt->execute();
        $stmt->bind_result($this->id, $this->user, $this->salt, $this->hash);

        //
        if (null === ($userData = $stmt->fetch_assoc()))
        {
            return false;
        }
        $this->user = $userData['userName'];
        $this->user = $userData['salt'];
        $this->user = $userData['hash'];
        return true;
    }



    public function checkPass($password)
    {
        return (hash_hmac("sha256", $password, $this->salt) === $this->hash);
    }
}


/* Form

if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $user       = $_POST['username'];
        $pass       = $_POST['password'];

            if($login->userLogin($user, $pass))
            {
                echo "Successfully logged in!";
            }
            else {
                echo $login->getError();
            }
    }

 * *
 */