<?php
namespace App\Controller\Zen;
use App\Controller\Zen\AppController;

/**
 * AdvertPositions Controller
 *
 * @property \App\Model\Table\AdvertPositionsTable $AdvertPositions
 */
class AdvertPositionsController extends AppController {

    public function index() {
        $action = $this->Crud->action();

        //不显示的字段
        $action->config('scaffold.fields_blacklist', ['created', 'modified']);

        return $this->Crud->execute();
    }

    public function add() {

        $action = $this->Crud->action();

        //不显示的字段
        $action->config('scaffold.fields_blacklist', ['created', 'modified']);

        return $this->Crud->execute();
    }

    public function edit() {
        $action = $this->Crud->action();

        //不显示的字段
        $action->config('scaffold.fields_blacklist', ['created', 'modified']);
        return $this->Crud->execute();
    }

}
