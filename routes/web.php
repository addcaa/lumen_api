<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


 $router->post('/test','Test\TestController@encrypt'); //对称加密
 $router->post('/openssl','Test\TestController@openssl'); //非对称加密
 $router->post('/sgin','Test\TestController@sgin'); //验证签名

 $router->post('/loginadd','Test\TestController@loginadd'); //接受注册信息

 $router->post('/logina','Test\TestController@logina'); //登录执行

 $router->get('/redis','Test\TestController@redis');  //测试redis
 $router->get('/script','Test\TestController@script');  //测试script 路径解决跨域

//hbui
$router->post('api/reg','User\UserController@reg');  //接受注册信息
$router->post('api/log','User\UserController@login');  //接受登陆信息
//$router->get('/user','User\UserController@user');

//个人中心
$router->group(['middleware' => 'logintoken'], function () use ($router) {
 $router->get('api/user',['uses'=>'User\UserController@user']);
});


$router->get('goods/list','Goods\GoodsController@list');//商品列表

$router->get('goods/catr','Goods\GoodsController@catr');//商品展示


$router->get('goods/car','Goods\GoodsController@car');//加入购物车

$router->get('goods/shopping','Goods\GoodsController@shopping');//购物车列表
$router->get('goods/shopping','Goods\GoodsController@shopping');//生成订单
$router->get('goods/buy','Goods\GoodsController@buy');//生成订单

$router->get('goods/drop','Goods\GoodsController@drop');//代发货
$router->get('goods/submitorder','Goods\GoodsController@submitorder');//代发货
