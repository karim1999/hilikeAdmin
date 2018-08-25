<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('/users', 'UserController');
    $router->resource('/services', 'ServiceController');
    $router->resource('/settings', 'SettingController');
    $router->resource('/tickets', 'TicketController');
    $router->resource('/services', 'ServiceController');
    $router->resource('/coupons', 'CouponController');
    $router->resource('/features', 'FeatureController');
    $router->resource('/permissions', 'PermissionController');
    $router->resource('/messages', 'MessageController');
    $router->resource('/payments', 'PaymentController');
    $router->resource('/memberships', 'MembershipController');

});
