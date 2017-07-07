<?php
namespace App\Controller;

use App\Controller\AppController;

class UsersController extends AppController {

    public $components = ['Cookie'];

    public function initialize() {
        parent::initialize();

        $this->loadComponent('Auth');
    }

    public function login() {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
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
                echo json_encode(array('status' => 1, 'info' => '注册成功'));exit;
            }
            echo json_encode(array('status' => 0, 'info' => '注册失败'));exit;
        }
        //$this->set('user', $user);
    }

    //微信登录
    public function wxlogin() {
        $this->viewBuilder()->layout('weui');
        $appid = 'wx2b89da9a0aa762ef';
        $appsecret = '686f1c5440c8c6a8e5358fc7dcf5f303';
        // urlencode

        // var_dump($_REQUEST);
        $code = $_REQUEST['code'];

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
        // var_dump($userinfo);

        //是否已经登录过
        $res = $this->Users->checkerUserName($userinfo['openid'], 1);

        // $user = $this->Users->patchEntity($user, $this->request->data);
        $user = $this->Users->newEntity();
        $user['username'] = 'wx-' . time();
        $user['nickname'] = $userinfo['nickname'];
        $user['openid'] = $userinfo['openid'];
        $user['unionid'] = $userinfo['unionid'];

        // $user['password'] = $this['request['data['password'];
        $user['group_id'] = 4;
        $user['u_start'] = time();
        $user['u_end'] = time() + intval(C('GIVE_N_DAY_VIP')) * 24 * 3600;

        if (empty($res)) {
            if ($users = $this->Users->save($user)) {
                var_dump($users);
                // $_user = $this->Auth->identify();
            }
        }
        $_user = $this->Auth->identify();
        if ($_user) {
            $this->Auth->setUser($_user);
            return $this->redirect($this->Auth->redirectUrl());
        }
        // var_dump($_user);
        $this->set(compact('userinfo'));
    }

    //BASE授权
    public function snsapi_base($appid) {
        $snsapi_base_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appid . '&redirect_uri=http%3A%2F%2Fwww.xiaobao.org.cn/users/wxlogin&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect';

        // https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx2b89da9a0aa762ef&redirect_uri=http%3A%2F%2Fwww.xiaobao.org.cn/users/wxlogin&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect

        // 1 第一步：用户同意授权，获取code
        // 2 第二步：通过code换取网页授权access_token
        // 3 第三步：刷新access_token（如果需要）
        // 4 第四步：拉取用户信息(需scope为 snsapi_userinfo)
        // 5 附：检验授权凭证（access_token）是否有效

    }

}