<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AdvertPosition Entity
 *
 * @property int $id
 * @property string $ap_title
 * @property int $ap_width
 * @property int $ap_height
 * @property int $ap_ad_num
 * @property string $ap_description
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Advert[] $adverts
 */
class AdvertPosition extends Entity
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
