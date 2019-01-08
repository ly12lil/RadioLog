<?php
/**
 * Created by PhpStorm.
 * User: administator
 * Date: 2018/10/16
 * Time: 10:52
 */

namespace app\admin\controller;

use app\admin\common\Base;
use app\common\model\User;
use think\facade\Config;
use think\facade\Request;
use think\facade\Session;

class Login extends Base
{
    protected function islogin(){
        if (Session::has('user_name')){
            return $this->error('您已登录过了','admin/index/index');
        }
    }
    public function index()
    {
        $this->islogin();
        return $this->fetch();
    }

    public function loginCheck()
    {
        $this->islogin();
        if (!Request::isAjax()){
            return json(['status'=>'400','msg'=>'非ajax请求']);
        }
        $data = Request::param();
        $res = $this->validate($data,'\app\admin\validate\Login');
        if (true !== $res){
            return json(['status'=>'400','msg'=>$res]);
        }
        $user = User::get(function ($query) use($data){
            $query->where('name',$data['name'])
                ->where('password',md5(Config::get('public_key').$data['password']));
        });
        if ($user !== null){
            Session::set('user_id',$user['id']);
            Session::set('user_name',$user['name']);
            Session::set('user_sign',$user['call_sign']);
            Session::set('user_email',$user['email']);
            return json(['status'=>'200','msg'=>'登录成功 '.$user['name']]);
        }else{
            return json(['status'=>'400','msg'=>'用户名或密码错误 '.$user['name']]);
        }
    }

    public function out()
    {
        Session::delete('user_id');
        Session::delete('user_name');
        Session::delete('user_sign');
        Session::delete('user_email');
        return $this->success('退出成功','index/index/index');
    }
}