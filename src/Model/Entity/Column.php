<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Column Entity.
 *
 * @property int $id
 * @property int $parent_id
 * @property \App\Model\Entity\Column $parent_column
 * @property int $lft
 * @property int $rght
 * @property string $name
 * @property \App\Model\Entity\Article[] $articles
 * @property \App\Model\Entity\Column[] $child_columns
 */
class Column extends Entity
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
