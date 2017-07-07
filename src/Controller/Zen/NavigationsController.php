<?php
namespace App\Controller\Zen;

use App\Controller\Zen\AppController;

class NavigationsController extends AppController {

    public function add() {
        $this->from();
    }

    public function edit() {
        $this->from();
    }

    public function from() {
        $action = $this->Crud->action();
        $action->config('scaffold.fields', [
            'parent_id',
            'title',
            'url',
            'target' => ['options' => ['_blank' => '_blank', 'new' => 'new', '_parent' => '_parent', '_self' => '_self', '_top' => '_top']],
            'position',
            'status' => ['type' => 'checkbox', 'label' => '启用'],
        ]);
        return $this->Crud->execute();
    }
}
