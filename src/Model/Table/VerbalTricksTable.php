<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VerbalTricks Model
 *
 * @method \App\Model\Entity\VerbalTrick get($primaryKey, $options = [])
 * @method \App\Model\Entity\VerbalTrick newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VerbalTrick[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VerbalTrick|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VerbalTrick patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VerbalTrick[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VerbalTrick findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VerbalTricksTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('verbal_tricks');
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
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('vt_body');

        return $validator;
    }
}
