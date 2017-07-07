<?php
namespace App\Controller\Ucenter;
use App\Controller\Ucenter\AppController;

class IndexController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->viewBuilder()->layout('default');
    }

    public function index() {

    }
}
