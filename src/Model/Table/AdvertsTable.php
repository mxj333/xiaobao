<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Adverts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $AdvertsPositions
 *
 * @method \App\Model\Entity\Advert get($primaryKey, $options = [])
 * @method \App\Model\Entity\Advert newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Advert[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Advert|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Advert patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Advert[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Advert findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AdvertsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('adverts');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('AdvertPositions', [
            'foreignKey' => 'advert_position_id',
            'joinType' => 'INNER',
        ]);

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'adv_savename' => [
                'path' => "webroot{DS}files{DS}{model}{DS}{field}{DS}" . date('Y') . "{DS}{month}" . date('d'),
                'fields' => [
                    'dir' => 'adv_savepath', // defaults to `dir`
                ],

                'transformer' => function (\Cake\Datasource\RepositoryInterface $table, \Cake\Datasource\EntityInterface $entity, $data, $field, $settings) {
                    $param['width'] = 700;
                    $param['height'] = 432;

                    // 后缀
                    $extension = pathinfo($data['name'], PATHINFO_EXTENSION);

                    $tmp = tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;

                    // Use the Imagine library to DO THE THING
                    $size = new \Imagine\Image\Box($param['width'], $param['height']);
                    $mode = \Imagine\Image\ImageInterface::THUMBNAIL_INSET;
                    $imagine = new \Imagine\Gd\Imagine();
                    // Save that modified file to our temp file
                    $imagine->open($data['tmp_name'])
                        ->thumbnail($size, $mode)
                        ->save($tmp);

                    return [
                        $data['tmp_name'] => $data['name'],
                        $tmp => 'thumbnail-' . $data['name'],
                    ];
                },
            ],
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('adv_title', 'create')
            ->notEmpty('adv_title');

        $validator
            ->requirePresence('adv_url', 'create')
            ->notEmpty('adv_url');

        $validator
            ->integer('adv_status')
            ->requirePresence('adv_status', 'create')
            ->notEmpty('adv_status');

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
        $rules->add($rules->existsIn(['advert_position_id'], 'AdvertPositions'));
        return $rules;
    }

    /*
     *
     * 根据广告位获取广告
     *
     *
     *
     */
    public function getPositionAdverts($advert_position_id, $num) {
        $res = $this->find('all')
            ->where(['adv_status' => 1, 'advert_position_id' => intval($advert_position_id)])
            ->order(['adv_sort' => 'ASC'])
            ->toArray();

        $result = [];
        foreach ($res as $key => $val) {
            $result[$key]['id'] = $val->id;
            $result[$key]['adv_title'] = $val->adv_title;
            $result[$key]['adv_url'] = $val->adv_url;
            $result[$key]['adv_img'] = substr($val->adv_savepath, 7) . DS . 'thumbnail-' . $val->adv_savename;
        }
        return $result;
    }
}
