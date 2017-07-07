<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Catalogs Controller
 *
 * @property \App\Model\Table\CatalogsTable $Catalogs
 */
class HomeController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        $page_title = '';
        // 轮播图
        // $this->loadModel('Adverts');
        // $adverts = $this->Adverts->getPositionAdverts(1, 5);
        // $this->set('adverts', $adverts);

        $this->loadModel('Articles');
        $this->paginate = array(
            'conditions' => ['column_id in' => [1, 3], 'art_status' => 1, 'art_position' => 1],
            'page' => $this->params['page'],
            'limit' => 5,
            'order' => array(
                'Articles.modified' => 'desc'),
        );
        $articles = $this->paginate($this->Articles);

        $this->set(compact('page_title', 'articles'));
        $this->set('_serialize', ['adverts', 'articles']);
    }

    public function vip() {
        $page_title = 'VIP会员';
        $this->set(compact('page_title'));
    }

    /**
     * start method
     *
     * @return void
     */
    public function start() {
        if (!is_weixin()) {
            echo header("Content-type: text/html; charset=utf-8");
            echo "请使用微信客户端打开！";
            exit;
        }
        $this->set('title', '');
        $this->viewBuilder()->layout('default.home');
        $this->loadModel('Subjects');
        $subjects = $this->Subjects->generate();

        $this->set('subjects', $subjects);
    }

    /**
     * gene method
     * 生成试卷
     * @return void
     */
    public function gene() {
        $this->autoRender = false;
        $this->loadModel('Subjects');
        $subjects = $this->Subjects->generate();
        echo json_encode(compact('subjects'));

    }

    /**
     * exam method
     * 考试
     * @return void
     */
    public function exam() {
        $this->viewBuilder()->layout('default.home');
        $this->loadModel('Subjects');
        $this->set('subjects', array());
    }

    /**
     * done method
     * 查看答案
     * @return void
     */
    public function done() {
        $this->viewBuilder()->layout('default.home');
    }

}
