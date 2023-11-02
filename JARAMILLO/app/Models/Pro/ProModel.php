<?php
namespace App\Models\Pro;

use App\Config\Model;

final class ProModel extends Model
{
    protected $table;
    protected $id;
    public function __construct()
    {
        parent::__construct();
        $this->table= 'pro';
        $this->id= 'pro_id';
    }

    public function getPros() : mixed {
        $this->sql = $this->getSqlString("v_pros");
        return $this->getQuery();
    }

    public function getPro($id) : mixed {
        $this->sql = $this->getSqlString("v_pro",$id);
        return $this->getQuery();
    }

    private function getProsSta($sta) : mixed {
        $this->sql = $this->getSqlString("v_pros_sta",[$sta]);
        return $this->getQuery();
    }

    public function getProsActive() : mixed {
        $sta = 1;
        return $this->getProsSta($sta);
    }

    public function getProsInactive() : mixed {
        $sta = 2;
        return $this->getProsSta($sta);
    }

    public function __destruct()
    {
        parent::__destruct();
        unset($this->table, $this->id);
    }
}
