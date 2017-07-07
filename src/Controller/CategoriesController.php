<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 */
class CategoriesController extends AppController {

    public function beforeRender(\Cake\Event\Event $event) {
        //$this->viewBuilder()->theme('Modern');
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {

        // $getLevel = $this->Categories->getLevel();
        // pr($getLevel);

        // $categories = TableRegistry::get('Categories');
        // $categories->recover();

        // $list = $categories->find('treeList', [
        //     'level' => 'level',
        //     // 'keyPath' => 'url',
        //     // 'valuePath' => 'id',
        //     // 'spacer' => '',
        // ]);

// In a CakePHP template file:
        //echo $this->Form->input('categories', ['options' => $list]);

// Or you can output it in plain text, for example in a CLI script
        // foreach ($list as $categoryName) {
        //     echo $categoryName . "<br>";
        // }

        // $query = $categories->find('treeList', [
        //     'keyPath' => 'url',
        //     'valuePath' => 'id',
        //     'spacer' => ' ',
        // ]);

        $this->paginate = [
            'contain' => ['ParentCategories'],
        ];
        $categories = $this->paginate($this->Categories);

        $this->set(compact('categories', 'list'));
        $this->set('_serialize', ['categories']);
    }

    /**
     * View method
     *
     * @param string|null $id Category id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $category = $this->Categories->get($id, [
            'contain' => ['ParentCategories', 'ChildCategories', 'Products'],
        ]);

        $this->set('category', $category);
        $this->set('_serialize', ['category']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $category = $this->Categories->newEntity();
        if ($this->request->is('post')) {
            $category = $this->Categories->patchEntity($category, $this->request->data);
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The category could not be saved. Please, try again.'));
            }
        }
        $parentCategories = $this->Categories->ParentCategories->find('list', ['limit' => 200]);
        $this->set(compact('category', 'parentCategories'));
        $this->set('_serialize', ['category']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Category id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $category = $this->Categories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->Categories->patchEntity($category, $this->request->data);
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The category could not be saved. Please, try again.'));
            }
        }
        $parentCategories = $this->Categories->ParentCategories->find('list', ['limit' => 200]);
        $this->set(compact('category', 'parentCategories'));
        $this->set('_serialize', ['category']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Category id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $category = $this->Categories->get($id);
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
