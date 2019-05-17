<?php

namespace App\Http\Controllers\Goods;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class GoodsController extends Controller
{
    //商品列表
    public function list(){
        $info=DB::table("goods")->get();
        return json_encode($info,JSON_UNESCAPED_UNICODE);
    }
    //商品详情
    public function catr(){
        $goods_id=$_GET['goods_id'];
        $url='http://'.env('CAP_URL')."/goods/cart?goods_id=$goods_id";
        $ch=curl_init();
        //通过 curl_setopt() 设置需要的全部选项
        curl_setopt($ch, CURLOPT_URL,$url);
        //禁止浏览器输出 ，使用变量接收
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //执行会话
        $res=curl_exec($ch);
        echo $res;
    }
    //加入购物车
    public function car(){
        $goods_id=$_GET['goods_id'];
        $u_id=$_GET['u_id'];
        $url='http://'.env('CAP_URL')."/goods/car?goods_id=$goods_id&u_id=$u_id";
        echo $this->getcurl($url);
    }

    //购物车展示
    public function shopping(){
        $u_id=$_GET['u_id'];
        $url='http://'.env('CAP_URL')."/goods/shopping?u_id=$u_id";
        echo $this->getcurl($url);

    }

    //生成订单
    public function buy(){
        $u_id=$_GET['u_id'];
        $cart_id=$_GET['cart_id'];
        $url='http://'.env('CAP_URL')."/goods/buy?cart_id=$cart_id&u_id=$u_id";
        echo $this->getcurl($url);
    }

    //添加购买商品
    public function drop(){
        $u_id=$_GET['u_id'];
        $goods_id=$_GET['goods_id'];
        $url='http://'.env('CAP_URL')."/goods/drop?u_id=$u_id&goods_id=$goods_id";
        echo $this->getcurl($url);
    }

    /**
     * 提交订单
     */

    public function submitorder(){
        $u_id=$_GET['u_id'];
        $goods_price=$_GET['goods_price'];
        $on_order=$_GET['on_order'];
        $url='http://'.env('CAP_URL')."/goods/submitorder?u_id=$u_id&goods_price=$goods_price&on_order=$on_order";
        echo $this->getcurl($url);
    }

    
    // curl
    function getcurl($url){
        $ch=curl_init();
        //通过 curl_setopt() 设置需要的全部选项
        curl_setopt($ch, CURLOPT_URL,$url);
        //禁止浏览器输出 ，使用变量接收
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //执行会话
        $res=curl_exec($ch);
        echo $res;
    }
}
