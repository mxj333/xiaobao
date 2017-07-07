<?php
namespace App\Controller\Zen;

use App\Controller\Zen\AppController;

class ConfigsController extends AppController {

    public function index() {

        $action = $this->Crud->action();

        //不显示的字段
        $action->config('scaffold.fields_blacklist', ['created', 'modified', 'con_type']);
        $action->config('scaffold.actions_blacklist', ['view']);

        return $this->Crud->execute();
    }

    public function add() {

        $this->from();
    }

    public function edit() {
        $this->from();

    }

    public function from() {
        $action = $this->Crud->action();

        //不显示的字段
        $action->config('scaffold.fields_blacklist', ['created', 'modified']);
        return $this->Crud->execute();
    }

}
