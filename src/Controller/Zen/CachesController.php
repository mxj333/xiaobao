<?php
namespace App\Controller\Zen;

use App\Controller\Zen\AppController;
use Cake\Cache\Cache;

class CachesController extends AppController {
    public $uses = false;

    public function index() {
        if ($this->request->is('post')) {
            $result = Cache::deleteMany([
                'managements',
                'structures',
                'navigations',
                'configs',
                'roles',
            ]);
            unlink(CACHE . '~config.php');
            if ($result) {
                $this->Flash->success(__('Cache cleanup success'));
                // return $this->redirect(['action' => 'index']);
            }
        }
    }

}
