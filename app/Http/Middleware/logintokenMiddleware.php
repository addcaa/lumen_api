<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;
class logintokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(empty($_GET['token'])||empty($_GET['u_id'])){
            die('无参数');
        }
        $token=$_GET['token'];
        $u_id=$_GET['u_id'];
        $key='laravel_database_login_token'.$u_id;
        $redis_token=Redis::get($key);
        if($redis_token){
            if($redis_token!==$token){
                $arr=[
                    'res'=>50001,
                    'msg'=>'请重新登陆'
                ];
                die(json_encode($arr,JSON_UNESCAPED_UNICODE));
            }
        }else{
            $arr=[
                'res'=>50002,
                'msg'=>'token过期，请重新登陆'
            ];
            die(json_encode($arr,JSON_UNESCAPED_UNICODE));
        }
        return $next($request);
    }
}
