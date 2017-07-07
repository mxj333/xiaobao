<?php
namespace App\Controller;

use Cake\Cache\Cache;
use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends \Cake\Controller\Controller {
    public function initialize() {
        $this->loadComponent('Flash');
        // $this->loadComponent('Auth', [
        //     'loginRedirect' => [
        //         'controller' => 'Articles',
        //         'action' => 'index',
        //     ],
        //     'logoutRedirect' => [
        //         'controller' => 'Pages',
        //         'action' => 'display',
        //         'home',
        //     ],
        // ]);
    }

    public function beforeFilter(Event $event) {

        // $this->Auth->allow(['index', 'view', 'video', 'display', 'loadPages']);
        // pr(Configure::read('site_title'));

        // 缓存数据
        $this->cacheData();

        //导航
        $this->set('navigations', json_decode(Cache::read('navigations')));

        //breadcrumb 二级链接
        $this->set('page_breadcrumb_url', $this->request->params['controller']);
    }

    // 缓存数据
    public function cacheData() {

        $arr = array('Navigations');
        foreach ($arr as $value) {
            $this->reCache($value);
        }
    }

    // 重载缓存数据
    public function reCache($name, $config = array()) {
        $_name = strtolower($name);
        if (($result = Cache::read("$_name")) === false) {
            $this->loadModel("$name");

            $default = [
                'where' => ['status' => 1],
                'order' => ['position' => 'ASC'],
            ];
            $config = array_merge($default, $config);

            $json = $this->$name->find('all')
                ->where($config['where'])
                ->order($config['order'])
                ->toArray();
            $result = json_encode($json);

            Cache::write('' . $_name, $result);
        }
    }
}
