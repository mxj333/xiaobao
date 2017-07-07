<?php
namespace App\Controller\Ucenter;

use App\Controller\Ucenter\AppController;
use Cake\Event\Event;

/**
 * Catalogs Controller
 *
 * @property \App\Model\Table\CatalogsTable $Catalogs
 */
class CatalogsController extends AppController {

    public function initialize() {
        parent::initialize();
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->set('is_vip_alert', 0);
        $this->set('is_breadcrumb', 0);
        $this->set('activeNav', 2);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $this->paginate = [
            // 'contain' => ['ParentCatalogs'],
            'conditions' => ['parent_id' => 0],
        ];
        $catalogs = $this->paginate($this->Catalogs);

        $this->set(compact('catalogs'));
        $this->set('_serialize', ['catalogs']);
    }

    /**
     * View method
     *
     * @param string|null $id Catalog id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $catalog = $this->Catalogs->get($id, [
            'contain' => ['ParentCatalogs', 'ChildCatalogs'], //, 'Subjects'
        ]);
        $this->set('catalog', $catalog);
        $this->set('_serialize', ['catalog']);
    }

}
