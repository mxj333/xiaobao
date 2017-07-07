<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AttachmentsFixture
 *
 */
class AttachmentsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'product_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => true, 'default' => '0', 'comment' => '商品ID', 'precision' => null, 'autoIncrement' => null],
        'at_name' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => '', 'comment' => '图片名称', 'precision' => null, 'fixed' => null],
        'at_description' => ['type' => 'string', 'length' => 500, 'null' => true, 'default' => '', 'comment' => '图片描述', 'precision' => null, 'fixed' => null],
        'at_sort' => ['type' => 'integer', 'length' => 4, 'unsigned' => true, 'null' => true, 'default' => '0', 'comment' => '排序', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'product_id' => 1,
            'at_name' => 'Lorem ipsum dolor sit amet',
            'at_description' => 'Lorem ipsum dolor sit amet',
            'at_sort' => 1,
            'created' => '2016-07-02 08:38:37',
            'modified' => '2016-07-02 08:38:37'
        ],
    ];
}
