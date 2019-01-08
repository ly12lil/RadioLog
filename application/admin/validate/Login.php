<?php
/**
 * Created by PhpStorm.
 * User: administator
 * Date: 2018/10/16
 * Time: 10:58
 */

namespace app\admin\validate;


use think\Validate;

class Login extends Validate
{
    protected $rule = [
        '__token__'=>'token',
        'name'  =>  'require|max:20',
        'password' =>  'require|max:20',
    ];
}