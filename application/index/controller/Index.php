<?php
namespace app\index\controller;

use app\common\model\User;
use app\index\common\Base;
use think\App;
use think\facade\Request;

class Index extends Base
{

    public function index()
    {
        $k = Request::get('k');
        if($k !== null){
            $log = \app\common\model\Log::where('d_call_sign','Like','%'.$k.'%')->where('status','1')->order('create_time', 'desc')->paginate(9);
        }else{
            $log = \app\common\model\Log::where('status','1')->order('create_time', 'desc')->paginate(10);
        }
        $this->assign('data',$log);
        return $this->fetch();
    }

    public function discuss()
    {
        return $this->fetch();
    }

    public function page($call_sign,$unique_id)
    {
        \app\common\model\Log::where('d_call_sign',$call_sign)->where('unique_id',$unique_id)->setInc('pv',1);
        $data =  \app\common\model\Log::cache($unique_id)->where('d_call_sign',$call_sign)->where('unique_id',$unique_id)->find();
        if ($data == null){
            return '日志不存在';
        }else{
            $this->assign('data',$data);
            return $this->fetch();
        }

    }
}
