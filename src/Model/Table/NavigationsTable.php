<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Navigations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParentNavigations
 * @property \Cake\ORM\Association\HasMany $ChildNavigations
 *
 * @method \App\Model\Entity\Navigation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Navigation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Navigation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Navigation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Navigation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Navigation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Navigation findOrCreate($search, callable $callback = null)
 */
class NavigationsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('navigations');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsTo('ParentNavigations', [
            'className' => 'Navigations',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('ChildNavigations', [
            'className' => 'Navigations',
            'foreignKey' => 'parent_id',
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('url', 'create')
            ->notEmpty('url');

        $validator
            ->add('target', 'inList', [
                'rule' => ['inList', ['_blank' => '_blank', 'new' => 'new', '_parent' => '_parent', '_self' => '_self', '_top' => '_top']],
                'message' => 'Please enter a valid target',
            ]);

        $validator
            ->integer('position')
            ->requirePresence('position', 'create')
            ->notEmpty('position');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentNavigations'));
        return $rules;
    }

    //获取全部数据
    public function all() {
        return $this->find('all')
            ->where(['status' => 1])
            ->order(['position' => 'ASC'])
            ->toArray();
    }
}
