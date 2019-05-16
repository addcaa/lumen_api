<?php

namespace App\Http\Controllers\User;
header('Access-Control-Allow-Methods:OPTIONS,GET,PSOT');
header('Access-Control-Allow-Headers:x-requested-with');
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class UserController extends Controller
{
    //接受注册信息
    public function reg(Request $request){
        $data=$request->input();
        $data['u_pwd']=password_hash($data['u_pwd'],PASSWORD_DEFAULT);
        $data['u_time']=time();
        $url="http://passport.highyr.com/api/reg";
        // echo $url;die;
        echo $this->postcurl($url,$data);
    }

    //接受登陆信息
    public function login(Request $request){
        $arr=$request->input();
        //dd($arr);
        $url="http://passport.highyr.com/api/log";
        echo $this->postcurl($url,$arr);
    }

    //个人中心(获得用户信息)
    public function user(){
        $u_id=$_GET['u_id'];
        $url="http://passport.highyr.com/api/index?u_id=$u_id";
        $ch=curl_init();
        //通过 curl_setopt() 设置需要的全部选项
        curl_setopt($ch, CURLOPT_URL,$url);
        //禁止浏览器输出 ，使用变量接收
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //执行会话
        $res=curl_exec($ch);
        echo $res;
    }

    //curl方法
    function postcurl($url,$info){
        //初始化curl
        $ch=curl_init();
        //通过 curl_setopt() 设置需要的全部选项
        curl_setopt($ch, CURLOPT_URL,$url);
        //禁止浏览器输出 ，使用变量接收
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST,1);
        //把数据传输过去
        curl_setopt($ch,CURLOPT_POSTFIELDS,$info);
        //执行会话
        $res=curl_exec($ch);
        //结束一个会话
        curl_close($ch);
        return $res;
    }
}
?>
