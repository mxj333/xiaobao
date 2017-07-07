<?php
namespace App\Controller\Zen;
use App\Controller\Zen\AppController;
use Cake\Utility\Inflector;

// use Cake\I18n\Time;

class ArticlesController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->set('art_status', [1 => '发布', 0 => '草稿', 8 => '采集']);
    }

    public function index() {
        $this->loadModel('Columns');
        $columns = $this->Columns->find('treeList');

        $condition = ['art_status <>' => 8];
        $column_id = $this->request->params['pass'] ? intval($this->request->params['pass'][0]) : 0;
        if ($column_id) {
            $condition['column_id'] = $column_id;
        }
        $this->paginate = array(
            'conditions' => $condition,
            'page' => $this->params['page'],
            'limit' => 20,
            'order' => array(
                'Articles.modified' => 'desc'),
        );
        $articles = $this->paginate($this->Articles);

        $this->set(compact('columns', 'articles', 'column_id'));
        $this->set('_serialize', ['columns', 'articles']);
    }

    public function add() {

        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->data);
            if (!strval($article->art_url_alias)) {
                $article->art_url_alias = getShortTitle(strtolower(Inflector::slug(pinyin($article->art_title, 1))), 30);
            }

            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your article.'));
        }

        $this->loadModel('Columns');
        $columns = $this->Columns->find('treeList');

        $article->cover = 'http://placehold.it/150x120?text=坐妹网';
        $user_id = $this->Auth->user()['id'];
        $this->set(compact('article', 'columns', 'user_id'));
        $this->set('_serialize', ['article']);
    }

    public function edit($id = null) {
        $article = $this->Articles->get($id);

        if ($article->art_cover) {
            $article->cover = substr($article->art_cover_path, 7) . '/thumbnail-' . $article->art_cover;
        } else {
            $article->cover = '/img/default.png';
        }

        if ($this->request->is(['post', 'put'])) {
            $this->Articles->patchEntity($article, $this->request->data);
            if (empty($article->art_url_alias)) {
                $article->art_url_alias = getShortTitle(strtolower(Inflector::slug(pinyin($article->art_title, 1))), 30);
            }

            if (empty($article->art_cover)) {
                $thumb = autoThumb($article->art_body);
                $article->art_cover = $thumb['name'];
                $article->art_cover_path = $thumb['path'];
            }

            // var_dump($article);exit;
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your article.'));
        }

        $this->loadModel('Columns');
        $columns = $this->Columns->find('treeList');
        $user_id = $this->Auth->user()['id'];
        $this->set(compact('article', 'columns', 'user_id'));
    }

    public function delete($id) {
        $this->request->allowMethod(['post', 'delete']);

        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article with id: {0} has been deleted.', h($id)));
            return $this->redirect(['action' => 'index']);
        }
    }

    public function tags() {
        // The 'pass' key is provided by CakePHP and contains all
        // the passed URL path segments in the request.
        $tags = $this->request->params['pass'];

        // Use the BookmarksTable to find tagged bookmarks.
        $articles = $this->Articles->find('tagged', [
            'tags' => $tags,
        ]);

        // Pass variables into the view template context.
        $this->set([
            'articles' => $articles,
            'tags' => $tags,
        ]);
    }

}