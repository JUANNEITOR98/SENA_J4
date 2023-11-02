
<?php
namespace App\Controllers\Register;
use App\Models\Sex\SexModel;
use App\Models\TyDoc\TyDocModel;

final class RegisterController
{
    private $model;

    public function __construct()
    {
        $this->model = null;
    }

    public function getData() : mixed 
    {
        $this->model = new SexModel;
        $data['sex'] = $this->model->getSexAll();
        $this->model = new TyDocModel;
        $data['tyDoc'] = $this->model->getTyDocAll();
        return $data;
    }
}
