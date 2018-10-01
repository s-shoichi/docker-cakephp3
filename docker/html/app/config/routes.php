<?php
use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;
Router::defaultRouteClass(DashedRoute::class);

//タグ付けされたアクションのために追加された新しいルート
// 末尾の'*'は、このアクションがパラメーターを渡されることをCakePHPに伝える
Router::scope(
    '/articles',
    ['controller' => 'Articles'],
    function($routes) {
        $routes->connect('/tagged/*', ['action' => 'tags']
        );
    }
);

Router::scope('/', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);
    $routes->fallbacks();
    //$routes->fallbacks(DashedRoute::class);
});

//Plugin::routes();
