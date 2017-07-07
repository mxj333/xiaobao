<?php
namespace App\Controller\Api;
use App\Controller\AppController;

class ArticlesController extends AppController {
    public $paginate = [
        'page' => 1,
        'limit' => 3,
        'maxLimit' => 100,
        'fields' => [
            'id', 'title', 'created',
        ],
        'sortWhitelist' => [
            'id', 'title', 'created',
        ],
    ];
}