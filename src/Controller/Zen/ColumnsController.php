<?php
namespace App\Controller\Zen;

use App\Controller\Zen\AppController;

/**
 * Columns Controller
 *
 * @property \App\Model\Table\ColumnsTable $Columns
 */
class ColumnsController extends AppController {
    public $paginate = [
        'page' => 1,
        'limit' => 10,
        'maxLimit' => 100,
    ];

}
