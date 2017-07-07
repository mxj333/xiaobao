<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Configs Model
 *
 * @method \App\Model\Entity\Config get($primaryKey, $options = [])
 * @method \App\Model\Entity\Config newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Config[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Config|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Config patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Config[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Config findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ConfigsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('configs');
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
            ->requirePresence('con_name', 'create')
            ->notEmpty('con_name');

        $validator
            ->requirePresence('con_title', 'create')
            ->notEmpty('con_title');

        $validator
            ->allowEmpty('con_value');

        $validator
            ->integer('con_type')
            ->allowEmpty('con_type');

        $validator
            ->integer('status')
            ->allowEmpty('status');

        return $validator;
    }

}
