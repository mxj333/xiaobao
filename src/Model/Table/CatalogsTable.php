<?php
namespace App\Model\Table;

use App\Model\Entity\Catalog;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Catalogs Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParentCatalogs
 * @property \Cake\ORM\Association\HasMany $ChildCatalogs
 * @property \Cake\ORM\Association\HasMany $Subject
 */
class CatalogsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('catalogs');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree');

        $this->belongsTo('ParentCatalogs', [
            'className' => 'Catalogs',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('ChildCatalogs', [
            'className' => 'Catalogs',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('Subjects', [
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
            ->add('lft', 'valid', ['rule' => 'numeric'])
            // ->requirePresence('lft', 'create')
            ->notEmpty('lft');

        $validator
            ->add('rght', 'valid', ['rule' => 'numeric'])
            // ->requirePresence('rght', 'create')
            ->notEmpty('rght');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentCatalogs'));
        return $rules;
    }
}
