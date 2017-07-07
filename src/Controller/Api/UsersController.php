<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;

class UsersController extends AppController {

    public function checkerUserName() {
        $this->autoRender = false;
        // echo json_encode(array('status' => 1, 'info' => 'ok'));
        if ($this->request->is('post')) {
            $data = $this->request->data['username'];
            $res = $this->Users->checkerUserName($data);
            if (empty($res)) {
                echo 1;exit;
            } else {
                echo 9;exit;
            }
            // echo json_encode($res);
        }
    }

}