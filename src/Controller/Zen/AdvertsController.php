<?php
namespace App\Controller\Zen;

use App\Controller\Zen\AppController;

/**
 * Adverts Controller
 *
 * @property \App\Model\Table\AdvertsTable $Adverts
 */
class AdvertsController extends AppController {

    public function index() {
        $action = $this->Crud->action();

        //不显示的字段
        $action->config('scaffold.fields_blacklist', ['created', 'modified']);

        $action->config('scaffold.actions', ['add', 'edit', 'delete']);
        return $this->Crud->execute();
    }

    public function add() {

        $action = $this->Crud->action();

        $action->config('scaffold.fields', [
            'adv_title',
            'advert_position_id',
            'adv_start_time',
            'adv_stop_time' => [
                'formatter' => function ($name, Time $value) {
                    return $value->nice();
                },
            ],

            'adv_url',
            'adv_sort',
            'adv_people',
            'adv_tel',
            'adv_email',
            'adv_status',
            'adv_savename' => [
                'type' => 'file',
            ],
            'adv_savepath' => [
                'type' => 'hidden',
            ],
        ]);

        //不显示的字段
        $action->config('scaffold.fields_blacklist', ['created', 'modified']);

        return $this->Crud->execute();
    }

    public function edit() {

        $action = $this->Crud->action();

        $action->config('scaffold.fields', [
            'adv_title',
            'advert_position_id',
            'adv_start_time',
            'adv_stop_time' => [
                'formatter' => function ($name, Time $value) {
                    return $value->nice();
                },
            ],

            'adv_url',
            'adv_sort',
            'adv_people',
            'adv_tel',
            'adv_email',
            'adv_status',
            'adv_savename' => [
                'type' => 'file',
            ],
            'adv_savepath' => [
                'type' => 'hidden',
            ],
        ]);

        //不显示的字段
        $action->config('scaffold.fields_blacklist', ['created', 'modified']);
        return $this->Crud->execute();
    }
}
