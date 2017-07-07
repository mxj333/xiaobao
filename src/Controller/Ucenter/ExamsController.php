<?php
namespace App\Controller\Ucenter;

use App\Controller\Ucenter\AppController;
use Cake\Event\Event;

class ExamsController extends AppController {

    // public $uses = false;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->set('is_vip_alert', 0);
        $this->set('is_breadcrumb', 0);
        $this->set('activeNav', 2);
        $this->viewBuilder()->layout('ucenter');
    }

    public function index() {
        $this->set('is_breadcrumb', 1);
        if (!is_weixin()) {
            echo header("Content-type: text/html; charset=utf-8");
            echo "请使用微信客户端打开！";
            exit;
        }
    }

    /**
     * gene method
     * 生成试卷
     * @return void
     */
    public function gene() {
        $this->autoRender = false;
        $this->Cookie->write('exam_time_end', '');
        //会员到期时间
        $user_vip_ent = $this->request->session()->read('Auth.User.u_end');
        if (time() > $user_vip_ent) {
            echo json_encode(array('status' => 9, 'info' => '你的VIP已到期'));exit;
        }

        $this->loadModel('Subjects');
        $subjects = $this->Subjects->generate();

        foreach ($subjects as $key => $value) {
            $subjects[$key]['user_id'] = $this->request->session()->read('Auth.User.id');
            $subjects[$key]['exam_date'] = time();
        }

        //考试结束时间
        $exam_time_end = time() + intval(C('EXAM_TIME')) * 60; //date('Y-m-d H:i:s', time() + intval(C('EXAM_TIME')) * 60);
        // $this->Cookie->write('exam_time_end', $exam_time_end);
        echo json_encode(compact('subjects', 'exam_time_end'));
    }

    /**
     * start method
     * 开始考试
     * @return void
     */
    public function start() {
        //考试结束时间
        $exam_time = intval($this->request->params['pass'][0]) ? intval($this->request->params['pass'][0]) : time() + intval(C('EXAM_TIME')) * 60;
        $exam_time_end = date('Y-m-d H:i:s', $exam_time);
        $this->set('exam_time_end', $exam_time_end);

        //总题数
        $exam_count = intval(C('EXAM_RADIO_NUM')) + intval(C('EXAM_MULTISELECT_NUM')) + intval(C('EXAM_JUDGEMENT_NUM'));
        $this->set('exam_count', $exam_count);

    }

    /**
     * done method
     * 查看答案
     * @return void
     */
    public function done() {

    }

    /**
     * historys method
     * 写入历史表
     * @return void
     */
    public function historys() {
        $this->autoRender = false;
        $this->loadModel('Historys');
        foreach ($this->request->data['result'] as $key => $value) {
            unset($value['id']);
            $history = $this->Historys->newEntity();
            $historys = $this->Historys->patchEntity($history, $value);
            $res = $this->Historys->save($historys);
        }

        if ($res) {
            echo 1;exit;
        }

    }
}
