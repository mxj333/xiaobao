<?php
namespace App\Controller\Ucenter;

use App\Controller\Ucenter\AppController;
use Cake\Event\Event;

class VipsController extends AppController {

    public $uses = false;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        // $this->set('is_vip_alert', 0);
        // $this->set('is_breadcrumb', 0);
        $this->set('activeNav', 3);
        $this->viewBuilder()->layout('ucenter');
    }

    public function index() {
        // pr($this->request->session()->read('User.name'));
        $this->set('vip_price', C('VIP_PRICE'));
    }

}
