<?php
namespace App\Controller\Ucenter;

use App\Controller\Ucenter\AppController;
use Cake\Event\Event;

class UsersController extends AppController {

    public $components = ['Cookie'];
    public $headimgurl = '';
    public function initialize() {
        parent::initialize();
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['add', 'login', 'wxlogin', 'logout']);
        $this->set('activeNav', 4);
        $this->set('controller_name', $this->request->params['controller']);
    }

    public function login() {
        $this->viewBuilder()->layout('ajax');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            // pr($user);exit;
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function add() {
        $this->viewBuilder()->layout('default');
        $page_title = __('Register');
        $this->set(compact('page_title'));

        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {

            $data['mv_verify'] = $this->request->data['verify'];
            $data['mv_mobile'] = $this->request->data['mobile'];
            $this->loadModel('MobileVerify');
            $verify = $this->MobileVerify->checkVerify($data);

            if ($verify['status'] != 1) {
                echo json_encode($verify);exit;
            }

            $user = $this->Users->patchEntity($user, $this->request->data);

            $user->username = $this->request->data['mobile'];
            $user->password = $this->request->data['password'];
            $user->group_id = 4;
            $user->u_start = time();
            $user->u_end = time() + intval(C('GIVE_N_DAY_VIP')) * 24 * 3600;

            if ($users = $this->Users->save($user)) {
                $_user = $this->Auth->identify();
                echo json_encode(array('status' => 1, 'info' => '注册成功'));exit;
            }
            echo json_encode(array('status' => 0, 'info' => '注册失败'));exit;
        }
        //$this->set('user', $user);
    }

    public function index() {

    }

    /**
     * Edit method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->viewBuilder()->layout('ucenter');

        // if ($this->request->is(['post', 'put'])) {
        //     $this->Users->patchEntity($user, $this->request->data);
        //     if ($this->Users->save($user)) {
        //         $this->Flash->success(__('The user has been updated.'));
        //     }
        //     $this->Flash->error(__('Unable to update the user.'));
        // }
    }

    public function view($id = null) {
        $user = $this->Users->get($id);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    //设置Cookie
    protected function _setCookie() {
        if (!$this->request->data('remember_me')) {
            return false;
        }
        $data = [
            'username' => $this->request->data('username'),
            'password' => $this->request->data('password'),
        ];
        $this->Cookie->write('RememberMe', $data, true, '+1 week');
        unset($this->request->data['remember_me']);
        return true;
    }

    //微信登录
    public function wxlogin() {
        $this->viewBuilder()->layout('weui');
        $appid = 'wx2b89da9a0aa762ef';
        $appsecret = '686f1c5440c8c6a8e5358fc7dcf5f303';
        // urlencode

        if (!isset($_GET['code'])) {
            header("Location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx2b89da9a0aa762ef&redirect_uri=http%3A%2F%2Fwww.xiaobao.org.cn/ucenter/users/wxlogin&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect");
            // ECHO 1213;
            // var_dump($_GET);
        }
        $code = $_GET['code'];

        // var_dump($_GET);
        // exit()
        //获取code后，请求以下链接获取access_token：
        // $url = 'https: //api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appid . '&secret=' . $appsecret . '&code=' . $code . '&grant_type=authorization_code';

        // 2 第二步：通过code换取网页授权access_token
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appid . '&secret=' . $appsecret . '&code=' . $code . '&grant_type=authorization_code';

        $result = https_request($url);
        // var_dump($result);

        // 3 第三步：刷新access_token（如果需要）

        // 4 第四步：拉取用户信息(需scope为 snsapi_userinfo)
        $snsapi_userinfo_url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $result['access_token'] . '&openid=' . $result['openid'] . '&lang=zh_CN';

        $userinfo = https_request($snsapi_userinfo_url);
        // var_dump($userinfo);exit;
        $this->headimgurl = $userinfo['headimgurl'];

        //是否已经登录过
        $users = $this->Users->checkerUserName($userinfo['openid'], 1);

        // $user = $this->Users->patchEntity($user, $this->request->data);
        // $user = $this->Users->newEntity();

        // $users = $this->Users->newEntity();
        // $users = (object) array();
        // var_dump($users);
        // exit;
        if (!$users) {
            // echo 11111111;
            //     $users->id = $res->id;
            // } else {
            // var_dump($user);exit;
            // $data['username'] = 'wx-' . time();
            $data['nickname'] = $userinfo['nickname'];
            $data['openid'] = $userinfo['openid'];
            $data['unionid'] = $userinfo['unionid'];
            $data['group_id'] = 4;
            $data['u_start'] = time();
            $data['u_end'] = time() + intval(C('GIVE_N_DAY_VIP')) * 24 * 3600;

            if ($userinfo['openid']) {
                $_users = $this->Users->newEntity($data);
                $users = $this->Users->save($_users);
            }

            // var_dump($users);exit;
        }

        // $users = $this->Users->newEntity($user);
        // var_dump($users->toArray());EXIT;
        $this->Auth->setUser($users->toArray());
        // var_dump($this->Auth->user());
        return $this->redirect($this->Auth->redirectUrl());
        // $this->set(compact('userinfo'));
    }
}
