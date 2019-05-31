<?php

namespace app\common\model;

use think\Model;


class Building extends Model
{

    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $name = 'building';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'category_text',
        'status_text',
        'renovation_text',
        'class_text',
        'sale_text',
        'is_hot_text',
        'use_time_text',
        'is_user_text'
    ];
    

    
    public function getCategoryList()
    {
        return ['10' => __('Category 10'), '20' => __('Category 20'), '30' => __('Category 30'), '40' => __('Category 40'), '50' => __('Category 50'), '60' => __('Category 60')];
    }

    public function getStatusList()
    {
        return ['10' => __('Status 10'), '20' => __('Status 20'), '30' => __('Status 30'), '40' => __('Status 40'), '50' => __('Status 50')];
    }

    public function getRenovationList()
    {
        return ['10' => __('Renovation 10'), '20' => __('Renovation 20'), '30' => __('Renovation 30')];
    }

    public function getClassList()
    {
        return ['10' => __('Class 10'), '20' => __('Class 20'), '30' => __('Class 30'), '40' => __('Class 40'), '50' => __('Class 50')];
    }

    public function getSaleList()
    {
        return ['10' => __('Sale 10'), '20' => __('Sale 20'), '30' => __('Sale 30'),'40'=>__('Sale 40')];
    }

    public function getIsHotList()
    {
        return ['10' => __('Is_hot 10'), '20' => __('Is_hot 20')];
    }

    public function getIsUserList()
    {
        return ['10' => __('Is_user 10'), '20' => __('Is_user 20')];
    }


    public function getCategoryTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['category']) ? $data['category'] : '');
        $list = $this->getCategoryList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getRenovationTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['renovation']) ? $data['renovation'] : '');
        $list = $this->getRenovationList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getClassTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['class']) ? $data['class'] : '');
        $list = $this->getClassList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getSaleTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['sale']) ? $data['sale'] : '');
        $list = $this->getSaleList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getIsHotTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['is_hot']) ? $data['is_hot'] : '');
        $list = $this->getIsHotList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getUseTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['use_time']) ? $data['use_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getIsUserTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['is_user']) ? $data['is_user'] : '');
        $list = $this->getIsUserList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    protected function setUseTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


}
