<?php
/**
 * Created by PhpStorm.
 * User: administator
 * Date: 2018/10/16
 * Time: 9:50
 */

namespace app\common\model;


use think\Model;

class Log extends Model
{
    protected $pk = 'id';
    protected $autoWriteTimestamp = true;
    protected $dateFormat = 'Y年m月d日';
}