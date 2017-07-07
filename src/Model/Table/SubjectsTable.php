<?php
namespace App\Model\Table;

use App\Model\Entity\Subject;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use MajaLin\Webbot\Parse as MS_Parse;

/**
 * Subjects Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Catalogs
 */
class SubjectsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('subjects');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Catalogs', [
            'foreignKey' => 'catalog_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('title');

        $validator
            ->allowEmpty('body');

        $validator
        // ->add('type', 'valid', ['rule' => 'boolean'])
        ->allowEmpty('type');

        $validator
            ->allowEmpty('answer');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['catalog_id'], 'Catalogs'));
        return $rules;
    }

    //生成考题
    public function generate() {

        //单选题数量
        $subjects = $this->questionTypes(1, intval(C('EXAM_RADIO_NUM')));

        //多选题数量
        $multiselect = $this->questionTypes(2, intval(C('EXAM_MULTISELECT_NUM')));
        // $subjects2 = $this->questionTypes(2, 5); //intval(C('EXAM_MULTISELECT_NUM'))

        //判断题数量
        $judgement = $this->questionTypes(3, intval(C('EXAM_JUDGEMENT_NUM')));
        // $subjects3 = $this->questionTypes(3, 2); //intval(C('EXAM_JUDGEMENT_NUM'))

        $subjects = array_merge($subjects, $multiselect, $judgement);
        return $subjects;
    }

    //题型数量
    public function questionTypes($type, $nume) {
        $conn = ConnectionManager::get('default');

        //从数据库中随机获取某个类型的N条数据
        $subjects = $conn->prepare('SELECT Subjects.id AS subject_id, Subjects.catalog_id, Subjects.type, Subjects.title, Subjects.body, Subjects.answer FROM subjects AS Subjects JOIN ( SELECT CEIL( RAND() * (SELECT MAX(id) FROM subjects)) AS id ) AS s WHERE Subjects.id >= s.id AND Subjects.type = ' . intval($type) . ' ORDER BY RAND() LIMIT ' . $nume);

        //整理返回数据格式
        $result = [];
        $i = 0;
        foreach ($subjects as $value) {
            $result[$i]['subject_id'] = $value['subject_id'];
            $result[$i]['catalog_id'] = $value['catalog_id'];
            $result[$i]['type'] = $value['type'];
            $result[$i]['title'] = $value['title'];
            $result[$i]['body'] = $value['body'];
            $result[$i]['answer'] = $value['answer'];
            $i++;
        }
        return $result;
    }

    public function getType($id = 0) {
        $arr = [
            1 => '单选题',
            2 => '多选题',
            3 => '判断题',
        ];
        if ($id) {
            return $arr[$id];exit;
        }
        return $arr;
    }

    //一次录入一题
    public function oneSubject($array) {
        // use \MajaLin\Webbot\DownloadImages;

        $body = delete_special_mark($array['body']);
        $data['catalog_id'] = intval($array['catalog_id']);

        $parse = new MS_Parse();

        //单选题
        $type = $parse->return_between($body, '试题类型：', '试题答案：', 'EXCL');
        if (trim($type) == '单选题') {
            $data['type'] = 1;
        }
        if (trim($type) == '多选题') {
            $data['type'] = 2;
        }
        if (trim($type) == '判断题') {
            $data['type'] = 3;
        }

        //试题答案：
        $data['answer'] = strtolower($parse->return_between($body, '试题答案：', '试题描述：', EXCL));

        // 试题描述：
        $data['title'] = trim($parse->return_between($body, '试题描述：', 'A：', EXCL));

        // 试题选项
        if ($data['type'] == 3) {

            $data['title'] = $parse->remove($body, '试题类型：', '试题描述：');

            $data['body'] = null;
            if (trim($data['answer']) == '对') {
                $data['answer'] = 1;
            } else {
                $data['answer'] = 0;
            }
        } else {
            $data['body'] = 'A：' . $parse->remove($body, '试题类型：', 'A：');
            $data['body'] = str_replace('B：', '###B：', $data['body']);
            $data['body'] = str_replace('C：', '###C：', $data['body']);
            $data['body'] = str_replace('D：', '###D：', $data['body']);
            $data['body'] = str_replace('E：', '###E：', $data['body']);
        }
        $data['status'] = 0;
        return $data;
    }
}
