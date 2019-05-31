<?php

namespace app\common\model;

use think\Model;


class AnswerRecord extends Model
{

    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $name = 'answer_record';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'status_text',
        'category_text'
    ];
    

    
    public function getStatusList()
    {
        return ['10' => __('Status 10'), '20' => __('Status 20')];
    }

    public function getCategoryList()
    {
        return ['10' => __('Category 10'), '20' => __('Category 20')];
    }


    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getCategoryTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['category']) ? $data['category'] : '');
        $list = $this->getCategoryList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function user(){
        return $this->belongsTo('User','user_id','user_id',[],'LEFT')->setEagerlyType(0);
    }


}
