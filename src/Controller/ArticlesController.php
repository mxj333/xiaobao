<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 */
class ArticlesController extends AppController {
    // public $paginate = [
    //     'page' => 1,
    //     'limit' => 20,
    //     'maxLimit' => 100,
    //     'fields' => [
    //         'id', 'title', 'created',
    //     ],
    //     'sortWhitelist' => [
    //         'id', 'title', 'created',
    //     ],
    // ];
    //public $theme = 'Modern';
    public function initialize() {
        parent::initialize();
        $this->loadComponent('Paginator');
        // $this->tree();
    }

    public function beforeRender(\Cake\Event\Event $event) {
        //$this->viewBuilder()->theme('Modern');
    }

    /*
     * 我们需要对我们的isauthorized()方法提供更多的规则。
     * 但是不是在App做它，我们将委托提供这些额外的规则，每个控制器。
     * 应该允许作者创建的文章，防止作者编辑文章不属于自己。
     */
    public function isAuthorized($user) {
        // All registered users can add articles
        if ($this->request->action === 'add') {
            return true;
        }

        // The owner of an article can edit and delete it
        if (in_array($this->request->action, ['edit', 'delete'])) {
            $articleId = (int) $this->request->params['pass'][0];
            if ($this->Articles->isOwnedBy($articleId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    // $components = array('Ajax.Ajax');

    public function index() {
        // sleep(3);
        $page_title = '保险资讯';
        // 轮播图
        $this->loadModel('Adverts');
        $adverts = $this->Adverts->getPositionAdverts(1, 5);
        $this->set('adverts', $adverts);

        $this->paginate = array(
            'conditions' => ['column_id in' => [1, 3], 'art_status' => 1],
            'page' => $this->params['page'],
            'limit' => 10,
            'order' => array(
                'Articles.modified' => 'desc'),
        );
        $articles = $this->paginate($this->Articles);

        $this->set(compact('page_title', 'articles'));
        $this->set('_serialize', ['articles', 'adverts']);
    }

    public function view($id = null) {
        $page_title = '保险资讯';
        $articles = $this->Articles->get($id);

        if ($articles->art_cover) {
            //$articles->art_cover = substr($articles->art_cover_path, 7) . '/' . $articles->art_cover;
        }

        if ($articles->art_video) {
            $articles->art_video = substr($articles->art_video_path, 7) . '/' . $articles->art_video;
        }

        // $now = Time::parse($articles->created);
        // echo $now->i18nFormat('Y-m-d', 'Asia/Shanghai');

        // echo $now->i18nFormat();
        // echo $now->nice();

        $this->Articles->updateAll(
            array('art_hits' => $articles->art_hits + 1),
            array('id' => $id)
        );

        $this->set(compact('page_title', 'articles'));
        $this->set('_serialize', ['articles']);

    }

    public function loadPages($urlAlias = null) {

        $pages = $this->Articles->find('all', array('conditions' => array('art_url_alias' => strval($urlAlias))));
        $page = $pages->first();
        // pr($page);exit;
        $this->set('title_for_layout', $page->art_title);
        if (empty($page)) {
            throw new NotFoundException('Could not find a page with that name.');
        } else {
            $this->set(compact('page'));
        }
        //RENDER THEME VIEW
        $this->render('pages');
    }

    public function addHits() {
        $data['art_hits'] = 23;
        $data['id'] = 43;
        $result = $this->Articles->addHits($data);
        pr($result);
    }

    //话术
    public function verbalTricks() {
        $page_title = '话术与案例';

        //breadcrumb 二级链接
        $this->set('page_breadcrumb_url', $this->request->params['controller'] . '/' . $this->request->params['action']);

        $this->paginate = array(
            'conditions' => ['column_id' => 5, 'art_status' => 1],
            'page' => $this->params['page'],
            'limit' => 1,
            'order' => array(
                'Articles.modified' => 'desc'),
        );
        $articles = $this->paginate($this->Articles);

        $this->set(compact('page_title', 'articles'));
        $this->set('_serialize', ['articles']);
    }

}
