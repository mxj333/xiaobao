<?php
namespace App\Controller\Ucenter;

use App\Controller\Ucenter\AppController;
use Cake\Event\Event;

/**
 * Subjects Controller
 *
 * @property \App\Model\Table\SubjectsTable $Subjects
 */
class SubjectsController extends AppController {

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
    public function index($catalog_id = null) {
        $page_title = '学习';
        $this->paginate = [
            'contain' => ['Catalogs'],
            'conditions' => ['catalog_id' => intval($catalog_id)],
            'limit' => 1,
        ];
        $subjects = $this->paginate($this->Subjects);
        $this->set(compact('page_title', 'subjects'));
        $this->set('_serialize', ['subjects']);
    }

    /**
     * View method
     *
     * @param string|null $id Subject id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $subject = $this->Subjects->get($id, [
            'contain' => ['Catalogs'],
        ]);

        $subject->type = $this->Subjects->getType($subject->type);
        $subject->body = str_replace('###', '<br/>', $subject->body);
        $this->set('subject', $subject);
        $this->set('_serialize', ['subject']);
    }
}
