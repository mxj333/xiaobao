<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * History Entity
 *
 * @property int $id
 * @property int $catalog_id
 * @property int $type
 * @property string $title
 * @property string $body
 * @property string $answer
 * @property int $status
 * @property int $user_id
 * @property \Cake\I18n\Time $created
 *
 * @property \App\Model\Entity\Catalog $catalog
 * @property \App\Model\Entity\User $user
 */
class History extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
