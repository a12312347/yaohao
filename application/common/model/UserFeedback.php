<?php

namespace app\common\model;

use think\Model;


class UserFeedback extends Model
{

    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $name = 'user_feedback';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'category_text'
    ];
    

    
    public function getCategoryList()
    {
        return ['10' => __('Category 10'), '20' => __('Category 20'), '30' => __('Category 30')];
    }





    public function getCategoryTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['category']) ? $data['category'] : '');
        $valueArr = explode(',', $value);
        $list = $this->getCategoryList();
        return implode(',', array_intersect_key($list, array_flip($valueArr)));
    }

    protected function setCategoryAttr($value)
    {
        return is_array($value) ? implode(',', $value) : $value;
    }


    public function user()
    {
        return $this->belongsTo('User', 'user_id', 'user_id', [], 'LEFT')->setEagerlyType(0);
    }
}
