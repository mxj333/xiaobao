<?php
namespace App\Controller\Zen;

use App\Controller\Zen\AppController;

/**
 * Subjects Controller
 *
 * @property \App\Model\Table\SubjectsTable $Subjects
 */
class SubjectsController extends AppController {

    public $paginate = [
        'limit' => 20,
    ];

    public function initialize() {
        parent::initialize();

        $this->loadComponent('Flash');
    }

    public function beforeFilter(\Cake\Event\Event $event) {

        // $this->Crud->addListener('Crud.Api'); // Required
        // $this->Crud->addListener('Crud.ApiPagination');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $this->Crud->on('beforePaginate', function (\Cake\Event\Event $event) {
            // $this->paginate['conditions'] = ['status in' => '0, 1'];
            $this->paginate['order']['id'] = 'desc';
        });
        $this->Crud->on('afterPaginate', function (\Cake\Event\Event $event) {
            foreach ($event->subject->entities as $entity) {
                $entity->type = $this->Subjects->getType($entity->type);
            }
        });

        $action = $this->Crud->action();
        // pr($action);
        //显示的字段
        // $action->config('scaffold.fields', ['title' => ['label' => '题目']]);

        //不显示字段
        $action->config('scaffold.fields_blacklist', ['user_id', 'status', 'created', 'modified']);

        //不显示删除按钮
        $action->config('scaffold.actions_blacklist', ['view', 'delete']);

        return $this->Crud->execute();
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {

        $subject = $this->Subjects->newEntity();
        if ($this->request->is('post')) {

            $this->Cookie->write('select_catalog_id', $this->request->data['catalog_id']);
            $this->Cookie->write('select_type', $this->request->data['type']);

            $this->request->data['body'] = str_replace(PHP_EOL, '###', $this->request->data['body']);
            $this->request->data['answer'] = strtolower($this->request->data['answer']);
            $user = $this->Auth->user();
            $this->request->data['user_id'] = intval($user['id']);

            $subject = $this->Subjects->patchEntity($subject, $this->request->data);
            if ($this->Subjects->save($subject)) {
                $this->Flash->success(__('The subject has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The subject could not be saved. Please, try again.'));
            }
        }

        $select_catalog_id = $this->Cookie->read('select_catalog_id');
        $select_type = $this->Cookie->read('select_type');

        $catalogs = $this->Subjects->Catalogs->find('treeList', ['spacer' => '----']);
        // $parentCatalogs =$this->Catalogs->ParentCatalogs->find('treeList', ['spacer' => '----']);
        $this->set(compact('subject', 'catalogs', 'select_catalog_id', 'select_type'));
        $this->set('_serialize', ['subject']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Subject id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $subject = $this->Subjects->get($id, [
            'contain' => [],
        ]);
        $subject->body = str_replace('###', PHP_EOL, $subject->body);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['body'] = str_replace(PHP_EOL, '###', $this->request->data['body']);
            $this->request->data['answer'] = strtolower($this->request->data['answer']);
            $subject = $this->Subjects->patchEntity($subject, $this->request->data);
            if ($this->Subjects->save($subject)) {
                $this->Flash->success(__('The subject has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The subject could not be saved. Please, try again.'));
            }
        }
        $select_catalog_id = '';
        $select_type = '';
        $catalogs = $this->Subjects->Catalogs->find('treeList', ['spacer' => '----']);
        $this->set(compact('subject', 'catalogs', 'select_catalog_id', 'select_type'));
        $this->set('_serialize', ['subject']);
    }

    public function adds() {

        $subject = $this->Subjects->newEntity();
        if ($this->request->is('post')) {
            $array['body'] = $this->request->data['body'];
            $array['catalog_id'] = intval($this->request->data['catalog_id']);

            // 获取每题的数据，并入库
            $data = $this->Subjects->oneSubject($array);

            $this->Cookie->write('select_catalog_id', $this->request->data['catalog_id']);

            $user = $this->Auth->user();
            $data['user_id'] = intval($user['id']);

            $subject = $this->Subjects->patchEntity($subject, $data);
            if ($this->Subjects->save($subject)) {
                $this->Flash->success(__('The subject has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The subject could not be saved. Please, try again.'));
            }
        }

        $select_catalog_id = $this->Cookie->read('select_catalog_id');

        $catalogs = $this->Subjects->Catalogs->find('treeList', ['spacer' => '----']);
        $this->set(compact('subject', 'catalogs', 'select_catalog_id'));
        $this->set('_serialize', ['subject']);
    }

    public function addpage() {

        $subject = $this->Subjects->newEntity();
        if ($this->request->is('post')) {

            //当前用户
            $user = $this->Auth->user();

            //处理POST过来的内容，去除html标签
            $body = delete_special_mark($this->request->data['body']);

            //以'试题类型：'分割字符串为数组
            $strToArray = explode('试题类型：', $body);
            // @header('Content-type: text/html;charset=UTF8');

            //循环处理每道题
            foreach ($strToArray as $key => $val) {
                if (!empty($val)) {

                    //补全题目
                    $array['body'] = '试题类型：' . $val;
                    $array['catalog_id'] = intval($this->request->data['catalog_id']);

                    // 获取每题的数据，并入库
                    $data = $this->Subjects->oneSubject($array);
                    $data['user_id'] = intval($user['id']);

                    $entity = $this->Subjects->newEntity($data);
                    $res = $this->Subjects->save($entity);
                }
            }

            $this->Cookie->write('select_catalog_id', $this->request->data['catalog_id']);

            if ($res) {
                $this->Flash->success(__('The subject has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The subject could not be saved. Please, try again.'));
            }
        }

        $select_catalog_id = $this->Cookie->read('select_catalog_id');

        $catalogs = $this->Subjects->Catalogs->find('treeList', ['spacer' => '----']);
        $this->set(compact('subject', 'catalogs', 'select_catalog_id'));
        $this->set('_serialize', ['subject']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Catalog id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $catalog = $this->Subjects->get($id);
        $catalog->status = 9;
        if ($this->Subjects->save($catalog)) {
            $this->Flash->success(__('The catalog has been deleted.'));
        } else {
            $this->Flash->error(__('The catalog could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
