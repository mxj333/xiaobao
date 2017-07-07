<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Advert Entity
 *
 * @property int $id
 * @property string $adv_title
 * @property int $adv_start_time
 * @property int $adv_stop_time
 * @property int $adverts_position_id
 * @property int $adv_hits
 * @property string $adv_url
 * @property string $adv_savepath
 * @property string $adv_savename
 * @property int $adv_sort
 * @property string $adv_people
 * @property string $adv_tel
 * @property string $adv_email
 * @property int $adv_status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\AdvertPosition $advert_position
 */
class Advert extends Entity
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
