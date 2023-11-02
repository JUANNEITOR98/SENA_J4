<?php
namespace App\Config;
use App\Config\Database;
use Exception;

abstract class Model
{
    protected $con;
    protected $sql;
    protected $result;
    public function __construct()
    {
        $this->con = (new Database)->getCon();
        $this->sql = null;
    }

    protected final function getQuery($typeArray = null)  {
        $typeResult = ($typeArray === null) ? MYSQLI_ASSOC : MYSQLI_NUM; 
        try {
            $consult = $this->con->query($this->sql);
            $this->result = $consult->fetch_all($typeResult);
        } catch (Exception $e) {
            $this->result = $this->error($e);
        } finally {
            return $this->result;
        }
    }

    final protected function getValuesForSql(array $data) : string {
          return '"'. implode('", "', $data) . '"';
    }

    protected final function error($e) : string {
        return 'Error: ' . $e->getMessage();
    }

    protected final function getSqlString(string $name, ?array $data = null) : string {
        $data = $this->getValuesForSql($data);
        $this->sql = "CALL $name ($data);";
        return $this->sql;
    }

    public function __destruct()
    {
        unset( $this->con, $this->sql, $this->result );
    }

}
