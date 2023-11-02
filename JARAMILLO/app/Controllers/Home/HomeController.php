<?php
namespace App\Controllers\Home;

use App\Config\Model;
use App\Models\Pro\ProModel;

final class HomeController
{
    private $model;

    public function __construct()
    {
        $this->model = new ProModel();
    }

    public function getPros() : mixed 
    {
        return $this->model->getProsActive();
    }
}
