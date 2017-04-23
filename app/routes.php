<?php

use App\Middleware\GuestMiddleware;
use App\Middleware\AuthMiddleware;

$app->group('', function () use ($app) {
    $app->post('/api/auth/signin', 'App\Controllers\UserController:postSignIn');
    $app->post('/api/auth/signup', 'App\Controllers\UserController:postSignUp');
})->add(new GuestMiddleware($container));

$app->group('', function () use ($app) {
    $app->post('/api/auth/signout', 'App\Controllers\UserController:postSignOut');

    $app->post('/api/contact/add', 'App\Controllers\ContactController:postAdd');
    $app->get('/api/contact/list', 'App\Controllers\ContactController:getList');
    $app->delete('/api/contact/delete={id}', 'App\Controllers\ContactController:delete');

    $app->post('/api/message/send', 'App\Controllers\MessageController:postSend');
    $app->get('/api/message/conversation={id}', 'App\Controllers\MessageController:getConversation');
})->add(new AuthMiddleware($container));

$app->get('/', 'App\Controllers\HomeController:index')->setName('home');