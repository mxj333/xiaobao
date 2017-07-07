<?php
namespace App\Controller\Ucenter;

use App\Controller\Ucenter\AppController;
use Cake\Event\Event;

class DashboardsController extends AppController {

    public $uses = false;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->viewBuilder()->layout('ucenter');
    }

    public function index() {
        // pr($this->request->session()->read('User.name'));

    }

}
