<?php
namespace App\Controller\Ucenter;

use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends \Cake\Controller\Controller {

    public function initialize() {
        parent::initialize();
        // $this->viewBuilder()->layout('ucenter');
        // I18n::locale('zh_CN');
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Cookie');
        $this->set('activeNav', 1);
        $this->set('is_vip_alert', 1);
        $this->set('is_breadcrumb', 1);
        $this->set('controller_name', $this->request->params['controller']);
        $this->loadComponent(
            'Auth', [
                'authorize' => 'Controller',
                'loginAction' => [
                    'plugin' => false,
                    'controller' => 'Users',
                    'action' => 'login',
                    'prefix' => 'ucenter',
                ],
                'loginRedirect' => [
                    'plugin' => false,
                    'prefix' => 'ucenter',
                    'controller' => 'Dashboards',
                    'action' => 'index',
                ],
                'logoutRedirect' => [
                    'plugin' => false,
                    'prefix' => false,
                    'controller' => 'Home',
                    'action' => 'index',
                ],
                'unauthorizedRedirect' => [
                    'plugin' => false,
                    'prefix' => 'ucenter',
                    'controller' => 'Users',
                    'action' => 'login',
                ],
                'authError' => 'Did you really think you are allowed to see that?',
                'flash' => [
                    'element' => 'error',
                ],
                'storage' => 'Session',
            ]);

        if ($this->Auth->user()) {
            $this->user = $this->Auth->user();
        }
    }

    //在视图呈现之前,调用控制器操作逻辑。
    public function beforeRender(Event $event) {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('Weixin');

        //自动登录.
        if (!$this->Auth->user() && $this->Cookie->read('RememberMe')) {
            if ($user = $this->Cookie->read('RememberMe')) {

                $user = $this->Auth->identify();
                // debug($user);
                if ($user) {
                    $this->Auth->setUser($user);
                } else {
                    $this->Cookie->delete('RememberMe');
                }
            }
        }

        $this->set('user', $this->Auth->user());
    }

    //简单的授权或您需要使用模型和组件的组合来做您的授权，是否允许用户访问请求的资源,
    public function isAuthorized($user = null) {

        //只有VIP会员可以访问会员中心
        if ($this->request->params['prefix'] === 'ucenter') {
            return (bool) ($user['group_id'] === 4);
        }

        //默认拒绝
        return false;
    }
}
