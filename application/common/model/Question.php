<?php

namespace app\common\model;

use think\Model;


class Question extends Model
{

    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $name = 'question';
    
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
    

    protected static function init()
    {
        self::afterInsert(function ($row) {
            $pk = $row->getPk();
            $row->getQuery()->where($pk, $row[$pk])->update(['weigh' => $row[$pk]]);
        });
    }

    
    public function getCategoryList()
    {
        return ['10' => __('Category 10'), '20' => __('Category 20')];
    }


    public function getCategoryTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['category']) ? $data['category'] : '');
        $list = $this->getCategoryList();
        return isset($list[$value]) ? $list[$value] : '';
    }




}
