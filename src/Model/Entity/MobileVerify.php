<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MobileVerify Entity
 *
 * @property int $id
 * @property string $mv_content
 * @property string $mv_mobile
 * @property string $mv_verify
 * @property int $mv_type
 * @property int $mv_status
 * @property int $created
 * @property int $modified
 */
class MobileVerify extends Entity
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
