<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Navigation Entity
 *
 * @property int $id
 * @property int $parent_id
 * @property string $title
 * @property string $url
 * @property string $target
 * @property int $position
 *
 * @property \App\Model\Entity\ParentNavigation $parent_navigation
 * @property \App\Model\Entity\ChildNavigation[] $child_navigations
 */
class Navigation extends Entity {

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
        'id' => false,
    ];
}
