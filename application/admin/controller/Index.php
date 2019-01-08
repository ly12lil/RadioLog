<?php
/**
 * Created by PhpStorm.
 * User: administator
 * Date: 2018/10/16
 * Time: 10:19
 */

namespace app\admin\controller;

use app\admin\common\Base;
use think\facade\Config;
use think\facade\Request;
use think\facade\Session;
use think\facade\Cache;
use app\common\model\Log;
class Index extends Base
{
    protected function initialize()
    {
        if (!Session::has('user_name')){
            return $this->error('请登录','admin/login/login');
        }
    }


    public function index()
    {
        $log = \app\common\model\Log::where('status','1')->order('create_time', 'desc')->paginate(9);
        $this->assign('data',$log);
        return $this->fetch();
    }

    public function addlog()
    {
        if (!Request::isAjax()){
            return json(['status'=>'400','msg'=>'非ajax请求']);
        }
        $data = Request::param();
        $res = $this->validate($data,'\app\admin\validate\Log');
        if (true !== $res){
            return json(['status'=>'400','msg'=>$res]);
        }
        $data['unique_id']=uniqid();
        if(\app\common\model\Log::create($data)){
            return json(['status'=>'200','msg'=>'添加成功']);
        }else{
            return json(['status'=>'400','msg'=>'失败']);
        }
    }

    public function getlog()
    {

        if (!Request::isAjax()){
            return json(['status'=>'400','msg'=>'非ajax请求']);
        }
        $unique = Request::param('unique');
        $data = \app\common\model\Log::where('unique_id',$unique)->find();
        if($data == null){
            return json(['status'=>'400','msg'=>'失败']);
        }else{
            return json(['status'=>'200','msg'=>'成功','data'=>$data]);
        }
    }

    public function uplog()
    {
        if (!Request::isAjax()){
            return json(['status'=>'400','msg'=>'非ajax请求']);
        }
        $data = Request::param();
        $res = $this->validate($data,'\app\admin\validate\Log');
        if (true !== $res){
            return json(['status'=>'400','msg'=>$res]);
        }
        unset($data['__hash__']);
        if(\app\common\model\Log::where('unique_id',$data['unique_id'])->data($data)->update()){
            Cache::rm($data['unique_id']);
            return json(['status'=>'200','msg'=>'更新成功']);
        }else{
            return json(['status'=>'400','msg'=>'更新失败']);
        }
    }

    public function dellog()
    {
        $unique = Request::param('unique');
        if(\app\common\model\Log::where('unique_id',$unique)->delete()){
            Cache::rm($unique);
            $this->success('删除成功','admin/index/index');
        }else{
            $this->error('删除失败','admin/index/index');
        }
    }
}