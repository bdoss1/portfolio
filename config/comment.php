<?php

return [
    'limit' => '10',

    'default_order' => 'desc',

    'models' => [
        'user' => App\Models\User::class,
        'comment' => \Yarmat\Comment\Models\Comment::class
    ],

    'controller' => \Yarmat\Comment\Http\Controllers\CommentController::class,

    'prefix' => 'comments',

    'middleware' => [

        'store' => ['auth'],

        'destroy' => ['auth'],

        'get' => [],

        'update' => [],

        'count' => []
    ]
];
