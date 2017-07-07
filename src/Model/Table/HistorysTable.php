<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Historys Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Catalogs
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\History get($primaryKey, $options = [])
 * @method \App\Model\Entity\History newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\History[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\History|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\History patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\History[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\History findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class HistorysTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('historys');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        // $this->belongsTo('Catalogs', [
        //     'foreignKey' => 'catalog_id',
        // ]);
        // $this->belongsTo('Users', [
        //     'foreignKey' => 'user_id',
        //     'joinType' => 'INNER',
        // ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    // public function validationDefault(Validator $validator) {
    //     $validator
    //         ->integer('id')
    //         ->allowEmpty('id', 'create');

    //     $validator
    //         ->integer('type')
    //         ->allowEmpty('type');

    //     $validator
    //         ->allowEmpty('title');

    //     $validator
    //         ->allowEmpty('body');

    //     $validator
    //         ->allowEmpty('answer');

    //     $validator
    //         ->integer('status')
    //         ->requirePresence('status', 'create')
    //         ->notEmpty('status');

    //     return $validator;
    // }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    // public function buildRules(RulesChecker $rules) {
    //     $rules->add($rules->existsIn(['catalog_id'], 'Catalogs'));
    //     $rules->add($rules->existsIn(['user_id'], 'Users'));
    //     return $rules;
    // }
}
