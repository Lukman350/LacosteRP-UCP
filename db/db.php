<?php

class Database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "ucp";
    public $db;

    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function checkUsername($user)
    {
        $query = $this->db->prepare("SELECT * FROM players WHERE username = '$user'");
        $query->execute(array($user));
        if ($query->rowCount() > 0)
            return true;
        else
            return false;
    }

    public function checkEmail($email)
    {
        $query = $this->db->prepare("SELECT * FROM players WHERE email = '$email'");
        $query->execute(array($email));
        if ($query->rowCount() > 0)
            return true;
        else
            return false;
    }

    public function fetchPlayer($username)
    {
        $query = $this->db->prepare("SELECT * FROM players WHERE username = '$username'");
        $query->execute();
        if ($query->rowCount() > 0) {
            return $data = $query->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function getIP() 
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = '';
        return $ipaddress;
    }
}
