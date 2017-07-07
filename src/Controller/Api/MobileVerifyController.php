<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;

/**
 * MobileVerify Controller
 *
 * @property \App\Model\Table\MobileVerifyTable $MobileVerify
 */
class MobileVerifyController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->autoRender = false;
    }

    public function verify() {
        //$this->request->data['mv_mobile'] = '13693640316';
        $res = $this->MobileVerify->generateVerify($this->request->data['mv_mobile']);
        echo json_encode($res);
    }

    public function checkVerify() {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data['mv_verify'] = $this->request->data['verify'];
            $data['mv_mobile'] = $this->request->data['mobile'];
            $res = $this->MobileVerify->checkVerify($data);
            echo json_encode($res);
        }
    }

    public function test() {
        $data['mv_mobile'] = '13693640316';
        $data['mv_verify'] = '4008';
        $res = $this->MobileVerify->checkVerify($data);
        pr($res);exit;
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $mobileVerify = $this->MobileVerify->newEntity();
        // if ($this->request->is('post')) {
        $mobileVerify = $this->MobileVerify->patchEntity($mobileVerify, $this->request->data);
        $this->request->data['mv_mobile'] = '13693640316';
        // $res = $this->MobileVerify->generateVerify($this->request->data['username']);
        // $mv_mobile = trim($mv_mobile);
        // $mobileVerify['mv_mobile'] = $mv_mobile;

        $mv_verify = rand(1111, 9999);
        $mobileVerify->mv_verify = $mv_verify;

        // //短信内容
        $mv_content = '你正在注册' . C('WEB_SITENAME') . ', 校验码为[' . $mv_verify . ']，15分钟内有效！';
        $mobileVerify->mv_content = $mv_content;
        $mobileVerify->mv_type = 1;
        $mobileVerify->mv_status = 1;
        $mobileVerify->created = time();

        pr($mobileVerify);
        $res = $this->MobileVerify->save($mobileVerify);
        pr($res);
        // }

    }

    /**
     * Edit method
     *
     * @param string|null $id Mobile Verify id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $mobileVerify = $this->MobileVerify->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mobileVerify = $this->MobileVerify->patchEntity($mobileVerify, $this->request->data);
            if ($this->MobileVerify->save($mobileVerify)) {
                $this->Flash->success(__('The mobile verify has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The mobile verify could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('mobileVerify'));
        $this->set('_serialize', ['mobileVerify']);
    }

}
