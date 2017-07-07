<?php
namespace App\Model\Table;

use App\Model\Entity\Article;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Articles Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Columns
 */
class ArticlesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('articles');
        $this->displayField('art_title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Columns', [
            'foreignKey' => 'column_id',
        ]);

        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'art_cover' => [
                'path' => 'webroot{DS}files{DS}{model}{DS}{field}{DS}{yes}{DS}{month}{days}',
                'fields' => [
                    // if these fields or their defaults exist
                    // the values will be set.
                    'dir' => 'art_cover_path', // defaults to `dir`
                    // 'size' => 'photo_size', // defaults to `size`
                    // 'type' => 'photo_type', // defaults to `type`
                ],

                // 'nameCallback' => 'filename',
                'keepFilesOnDelete' => false,

                // This can also be in a class that implements
                // the TransformerInterface or any callable type.
                'transformer' => function (\Cake\Datasource\RepositoryInterface $table, \Cake\Datasource\EntityInterface $entity, $data, $field, $settings) {
                    // get the extension from the file
                    // there could be better ways to do this, and it will fail
                    // if the file has no extension
                    $extension = pathinfo($data['name'], PATHINFO_EXTENSION);

                    // $data['name'] = uniqid() . '.' . $extension;

                    // var_dump($data);
                    // Store the thumbnail in a temporary file

                    // $_tmp = tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;
                    // // Use the Imagine library to DO THE THING
                    // $size = new \Imagine\Image\Box(400, 300);
                    // $mode = \Imagine\Image\ImageInterface::THUMBNAIL_INSET;
                    // $imagine = new \Imagine\Gd\Imagine();
                    // // Save that modified file to our temp file
                    // $imagine->open($data['tmp_name'])
                    //     ->thumbnail($size, $mode)
                    //     ->save($_tmp);

                    $tmp = tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;
                    // var_dump($tmp);exit;
                    // Use the Imagine library to DO THE THING
                    $size = new \Imagine\Image\Box(150, 120);
                    $mode = \Imagine\Image\ImageInterface::THUMBNAIL_INSET;
                    $imagine = new \Imagine\Gd\Imagine();
                    // Save that modified file to our temp file
                    $imagine->open($data['tmp_name'])
                        ->thumbnail($size, $mode)
                        ->save($tmp);
                    // Now return the original *and* the thumbnail
                    return [
                        $data['tmp_name'] => $data['name'],
                        $tmp => 'thumbnail-' . $data['name'],
                    ];
                },
            ],
            'art_video' => [
                'path' => 'webroot{DS}files{DS}{model}{DS}{field}{DS}{yes}{DS}{month}{days}',
                'fields' => [
                    'dir' => 'art_video_path', // defaults to `dir`
                ],
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
            ->allowEmpty('art_cover');
        $validator
            ->allowEmpty('art_video');
        $validator
            ->notEmpty('art_title');
        $validator
            ->notEmpty('art_body');
        return $validator;
    }

    function filename($data = null, $settings = null) {
        return microtime();
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['column_id'], 'Columns'));
        return $rules;
    }

    //告诉用户是否被授权编辑的文章
    // public function isOwnedBy($articleId, $userId) {
    //     return $this->exists(['id' => $articleId, 'user_id' => $userId]);
    // }

    public function findTagged(Query $query, array $options) {
        return $this->find()
            ->distinct(['Articles.id'])
            ->matching('Tags', function ($q) use ($options) {
                return $q->where(['Tags.title IN' => $options['tags']]);
            });
    }

    public function addHits($upData) {
        if (empty($upData)) {
            exit(0);
        }

        return $this->updateAll(
            array('art_hits' => $upData['art_hits'] + 1),
            array('id' => $upData['id'])
        );
    }

    public function setThumbnail($data, $width, $height) {
        $tmp = tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;
        // Use the Imagine library to DO THE THING
        $size = new \Imagine\Image\Box(150, 120);
        $mode = \Imagine\Image\ImageInterface::THUMBNAIL_INSET;
        $imagine = new \Imagine\Gd\Imagine();
        // Save that modified file to our temp file
        $imagine->open($data['tmp_name'])
            ->thumbnail($size, $mode)
            ->save($tmp);
    }
}
