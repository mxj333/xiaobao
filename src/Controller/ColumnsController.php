<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Columns Controller
 *
 * @property \App\Model\Table\ColumnsTable $Columns
 */
class ColumnsController extends AppController {
    public $paginate = [
        'page' => 1,
        'limit' => 3,
        'maxLimit' => 100,
    ];

}
