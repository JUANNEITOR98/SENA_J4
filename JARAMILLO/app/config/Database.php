<?php
namespace App\Config;
use mysqli;
use Exception;

require_once('../app/Config/Constants.php');
final class Database
{
    private $host;
    private $pass;
    private $db;
    private $user;
    private $con;

    public function __construct() {
        $this->host = HOST;
        $this->pass = PASS;
        $this->db = DB;
        $this->user = USER;
        try {
            $con = new mysqli( $this->host, $this->user, $this->pass, $this->db );
        } catch (Exception $e) {
            die('Error en la conexión.');
            $con = $e->getMessage();
        } finally {
            $this->con = $con;
        }
    }

    public function getCon() : mixed
    {
        return $this->con;
    }

    /**
     * Get the value of user
     */ 
    public function getUser() : string
    {
        return $this->user;
    }

    /**
     * Get the value of db
     */ 
    public function getDb() : string
    {
        return $this->db;
    }

    /**
     * Get the value of pass
     */ 
    public function getPass() : string
    {
        return $this->pass;
    }

    /**
     * Get the value of host
     */ 
    public function getHost() : string
    {
        return $this->host;
    }

    public function releaseResources() {
        // $this->con->close();
        unset($this->host, $this->pass, $this->db, $this->user);
    }

    public function __destruct()
    {
        $this->releaseResources();
    }

}
?>