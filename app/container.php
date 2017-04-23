<?php

$container = $app->getContainer();

$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();
$container['db'] = function ($c) use ($capsule) {
    return $capsule;
};

$container['auth'] = function ($c) {
    return new App\Auth\Auth;
};

$container['view'] = function ($c) {
    $settings = $c->get('settings');

    $view = new Slim\Views\Twig(
        $settings['view']['template_path'],
        $settings['view']['twig']
    );
    $view->addExtension(new Slim\Views\TwigExtension(
        $c->get('router'),
        $c->get('request')->getUri())
    );
    $view->addExtension(new Twig_Extension_Debug());

    return $view;
};

$container['validator'] = function ($c) {
    $settings = $c->get('settings');

    $params = $c['request']->getParams();

    return new Valitron\Validator($params, [], $settings['lang']['default']);
};

$container['flash'] = function ($c) {
    return new Slim\Flash\Messages();
};

$container['csrf'] = function ($c) {
    return new Slim\Csrf\Guard;
};