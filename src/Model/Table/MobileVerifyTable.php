<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * MobileVerify Model
 *
 * @method \App\Model\Entity\MobileVerify get($primaryKey, $options = [])
 * @method \App\Model\Entity\MobileVerify newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MobileVerify[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MobileVerify|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MobileVerify patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MobileVerify[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MobileVerify findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MobileVerifyTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('mobile_verify');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('mv_content', 'create')
            ->notEmpty('mv_content');

        $validator
            ->requirePresence('mv_mobile', 'create')
            ->notEmpty('mv_mobile');

        $validator
            ->requirePresence('mv_verify', 'create')
            ->notEmpty('mv_verify');

        $validator
            ->integer('mv_type')
            ->requirePresence('mv_type', 'create')
            ->notEmpty('mv_type');

        $validator
            ->integer('mv_status')
            ->requirePresence('mv_status', 'create')
            ->notEmpty('mv_status');

        return $validator;
    }

    /**
     * 生成验证码
     *
     */
    public function generateVerify($mv_mobile) {

        $mobileVerifyTable = TableRegistry::get('MobileVerify');
        $mobileVerify = $mobileVerifyTable->newEntity();

        $mobileVerify->mv_mobile = trim($mv_mobile);
        $mobileVerify->mv_verify = rand(1111, 9999);
        //短信内容
        // $mobileVerify->mv_content = '你正在注册' . C('WEB_SITENAME') . ', 校验码为[' . $mobileVerify->mv_verify . ']，15分钟内有效！';

        //默认值
        $mobileVerify->mv_type = 1;
        $mobileVerify->mv_status = 1;
        $mobileVerify->mv_date = time();

        if ($mobileVerifyTable->save($mobileVerify)) {
            // $id = $mobileVerify->id;
            //调用接口发送验证码
            $data['mobile'] = $mobileVerify->mv_mobile;
            $data['verify'] = $mobileVerify->mv_verify;
            sendSMS($data);
            $result = array('status' => 1, 'info' => '短信已发送');
        } else {
            $result = array('status' => 0, 'info' => '发送失败');
        }
        return $result;
    }

    //校验验证码
    public function checkVerify($data) {
        $mobileVerify = $this->find('all')
            ->select(['id', 'mv_mobile', 'mv_verify', 'mv_date', 'mv_status'])
            ->where(['mv_mobile' => trim($data['mv_mobile']), 'mv_verify' => trim($data['mv_verify'])])
            ->order(['MobileVerify.id' => 'DESC'])
            ->limit(1)
            ->toArray();

        $verify = isset($mobileVerify[0]) ? $mobileVerify[0]->toArray() : '';

        if (!$verify) {
            return array('status' => 0, 'info' => '验证码错误1');exit;
        }

        if ($verify['mv_status'] == 9) {
            return array('status' => 0, 'info' => '验证码已失效');exit;
        }

        //更新验证码数据
        $mobileVerifyTable = TableRegistry::get('MobileVerify');
        $mobileVerify = $mobileVerifyTable->newEntity();
        $mobileVerify->id = $verify['id'];
        $mobileVerify->mv_status = 9;

        //验证码已效,15分钟内有效
        if ((time() - $verify['mv_date']) > intval(C('VERIFY_DATE')) * 60) {
            $mobileVerifyTable->save($mobileVerify);
            return array('status' => 0, 'info' => '验证码已失效');exit;
        }

        if ($verify['mv_verify'] != trim($data['mv_verify'])) {
            return array('status' => 0, 'info' => '验证码错误2');exit;
        }

        $mobileVerifyTable->save($mobileVerify);
        return array('status' => 1, 'info' => '验证通过');
    }
}
