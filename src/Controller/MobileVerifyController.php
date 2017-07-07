<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;

/**
 * MobileVerify Controller
 *
 * @property \App\Model\Table\MobileVerifyTable $MobileVerify
 */
class MobileVerifyController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $mobileVerify = $this->paginate($this->MobileVerify);

        $this->set(compact('mobileVerify'));
        $this->set('_serialize', ['mobileVerify']);
    }

    /**
     * View method
     *
     * @param string|null $id Mobile Verify id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $mobileVerify = $this->MobileVerify->get($id, [
            'contain' => [],
        ]);

        $this->set('mobileVerify', $mobileVerify);
        $this->set('_serialize', ['mobileVerify']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $mobileVerify = $this->MobileVerify->newEntity();
        if ($this->request->is('post')) {
            $mobileVerify = $this->MobileVerify->patchEntity($mobileVerify, $this->request->data);
            if ($this->MobileVerify->save($mobileVerify)) {
                $this->Flash->success(__('The mobile verify has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The mobile verify could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('mobileVerify'));
        $this->set('_serialize', ['mobileVerify']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Mobile Verify id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $mobileVerify = $this->MobileVerify->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mobileVerify = $this->MobileVerify->patchEntity($mobileVerify, $this->request->data);
            if ($this->MobileVerify->save($mobileVerify)) {
                $this->Flash->success(__('The mobile verify has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The mobile verify could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('mobileVerify'));
        $this->set('_serialize', ['mobileVerify']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Mobile Verify id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $mobileVerify = $this->MobileVerify->get($id);
        if ($this->MobileVerify->delete($mobileVerify)) {
            $this->Flash->success(__('The mobile verify has been deleted.'));
        } else {
            $this->Flash->error(__('The mobile verify could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
