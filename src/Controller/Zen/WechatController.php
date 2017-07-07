<?php
namespace App\Controller\Zen;
use App\Controller\Zen\AppController;

/**
 * Tags Controller
 *
 * @property \App\Model\Table\TagsTable $Tags
 */
class WechatController extends AppController {

    public $uses = false;

    public function initialize() {
        parent::initialize();
        $this->set('art_status', [1 => '发布', 0 => '草稿', 8 => '采集']);
    }

    public function index() {
        $this->loadModel('Articles');
        $this->loadModel('Columns');
        $columns = $this->Columns->find('treeList');

        $condition = [];
        $column_id = $this->request->params['pass'] ? intval($this->request->params['pass'][0]) : 0;
        if ($column_id) {
            $condition['column_id'] = $column_id;

        }
        $condition['art_status'] = 8;
        $this->paginate = array(
            'conditions' => $condition,
            'page' => $this->params['page'],
            'limit' => 20,
            'order' => array(
                'Articles.id' => 'desc'),
        );
        $articles = $this->paginate($this->Articles);

        $this->set(compact('columns', 'articles', 'column_id'));
        $this->set('_serialize', ['columns', 'articles']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        // require_once ROOT . DS . 'vendor' . DS . "Gather.php";
        $this->loadModel('Articles');
        $article = $this->Articles->newEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {

            $target = $this->request->data['url'];
            $res = wechat($target);
            $data['column_id'] = 1;
            $data['art_status'] = 8;
            $data['art_title'] = $res['title'];
            $data['art_body'] = $res['content'];
            $data['art_source'] = $res['nickname'];

            $article = $this->Articles->patchEntity($article, $data);
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

        }

    }

    /**
     * Edit method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $tag = $this->Tags->get($id, [
            'contain' => ['Articles'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tag = $this->Tags->patchEntity($tag, $this->request->data);
            if ($this->Tags->save($tag)) {
                $this->Flash->success(__('The tag has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The tag could not be saved. Please, try again.'));
            }
        }
        $articles = $this->Tags->Articles->find('list', ['limit' => 200]);
        $this->set(compact('tag', 'articles'));
        $this->set('_serialize', ['tag']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $tag = $this->Tags->get($id);
        if ($this->Tags->delete($tag)) {
            $this->Flash->success(__('The tag has been deleted.'));
        } else {
            $this->Flash->error(__('The tag could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
