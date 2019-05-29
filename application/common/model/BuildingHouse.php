<?php

namespace app\common\model;

use think\Model;


class BuildingHouse extends Model
{

    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $name = 'building_house';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'category_text',
        'renovation_text'
    ];
    

    
    public function getCategoryList()
    {
        return ['10' => __('Category 10'), '20' => __('Category 20'), '30' => __('Category 30'), '40' => __('Category 40'), '50' => __('Category 50')];
    }

    public function getRenovationList()
    {
        return ['10' => __('Renovation 10'), '20' => __('Renovation 20'), '3' => __('Renovation 3')];
    }


    public function getCategoryTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['category']) ? $data['category'] : '');
        $list = $this->getCategoryList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getRenovationTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['renovation']) ? $data['renovation'] : '');
        $list = $this->getRenovationList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    public function building(){
        return $this->belongsTo('Building','building_id','building_id',[],'LEFT')->setEagerlyType(0);
    }




}
