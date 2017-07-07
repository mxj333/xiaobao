<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AdvertPositions Model
 *
 * @method \App\Model\Entity\AdvertPosition get($primaryKey, $options = [])
 * @method \App\Model\Entity\AdvertPosition newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AdvertPosition[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AdvertPosition|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AdvertPosition patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AdvertPosition[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AdvertPosition findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AdvertPositionsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('advert_positions');
        $this->displayField('ap_title');
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
            ->requirePresence('ap_title', 'create')
            ->notEmpty('ap_title');

        $validator
            ->integer('ap_width')
            ->allowEmpty('ap_width');

        $validator
            ->integer('ap_height')
            ->allowEmpty('ap_height');

        $validator
            ->integer('ap_ad_num')
            ->requirePresence('ap_ad_num', 'create')
            ->notEmpty('ap_ad_num');

        $validator
            ->allowEmpty('ap_description');

        return $validator;
    }
}
