<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Catalog Entity.
 *
 * @property int $id
 * @property int $parent_id
 * @property \App\Model\Entity\ParentCatalog $parent_catalog
 * @property int $lft
 * @property int $rght
 * @property string $name
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\ChildCatalog[] $child_catalogs
 * @property \App\Model\Entity\Subject[] $subject
 */
class Catalog extends Entity
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
        'id' => false,
    ];
}
