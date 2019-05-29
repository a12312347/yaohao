<?php

namespace app\common\model;

use think\Model;


class Answer extends Model
{

    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $name = 'answer';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'ans_text',
        'is_answer_text'
    ];
    

    
    public function getAnsList()
    {
        return ['A' => __('A'), 'B' => __('B'), 'C' => __('C'), 'D' => __('D')];
    }

    public function getIsAnswerList()
    {
        return ['0' => __('Is_answer 0'), '1' => __('Is_answer 1')];
    }


    public function getAnsTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['ans']) ? $data['ans'] : '');
        $list = $this->getAnsList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getIsAnswerTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['is_answer']) ? $data['is_answer'] : '');
        $list = $this->getIsAnswerList();
        return isset($list[$value]) ? $list[$value] : '';
    }




}
