<?php
/**
 * Created by PhpStorm.
 * User: administator
 * Date: 2018/10/16
 * Time: 13:42
 */

namespace app\admin\validate;


use think\Validate;

class Log extends Validate
{
    protected $rule = [
        '__token__'=>'token',
        'd_call_sign|对方呼号'  =>  'require|max:20',
        'd_device|对方设备'  =>  'require|max:20',
        'd_power|对方功率'  =>  'require|max:20',
        'd_signal|对方信号'  =>  'require|max:20',
        'j_rate|频率'  =>  'require|max:20',
        'j_device|己方设备'  =>  'require|max:20',
        'j_power|己方功率'  =>  'require|max:20',
        'j_signal|己方信号'  =>  'require|max:20',
//        'relay'  =>  'require|max:20',
        'date|时间'  =>  'require|max:20',
    ];

}