<?php
namespace App\Controller\Zen;

use App\Controller\Zen\AppController;

/**
 * Managements Controller
 *
 * @property \App\Model\Table\ManagementsTable $Managements
 */
class ManagementsController extends AppController {

    public function add() {
        $this->from();
    }

    /**
     * View method
     *
     * @param string|null $id Management id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $management = $this->Managements->get($id, [
            'contain' => ['Structures'],
        ]);

        $this->set('management', $management);
        $this->set('_serialize', ['management']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Management id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->from();
    }

    public function from() {
        $action = $this->Crud->action();
        $targets = ['_blank' => '_blank', '_self' => '_self', '_parent' => '_parent', '_top' => '_top'];
        $action->config('scaffold.fields', [
            'structure_id' => [
                'type' => 'select',
            ],
            'name',
            'label',
            'icon',
            'url',
            'target' => ['options' => ['_blank' => '_blank', 'new' => 'new', '_parent' => '_parent', '_self' => '_self', '_top' => '_top']],
            'weight',
            'status' => ['type' => 'checkbox', 'label' => '启用'],
        ]);
        return $this->Crud->execute();
    }

}
