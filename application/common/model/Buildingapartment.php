<?php

namespace app\common\model;

use think\Model;


class Buildingapartment extends Model
{

    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $name = 'building_apartment';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'room_text',
        'saloon_text',
        'toilet_text'
    ];
    

    
    public function getRoomList()
    {
        return ['10' => __('Room 10'), '20' => __('Room 20'), '30' => __('Room 30'), '40' => __('Room 40'), '50' => __('Room 50')];
    }

    public function getSaloonList()
    {
        return ['10' => __('Saloon 10'), '20' => __('Saloon 20'), '30' => __('Saloon 30'), '40' => __('Saloon 40'), '50' => __('Saloon 50')];
    }

    public function getToiletList()
    {
        return ['10' => __('Toilet 10'), '20' => __('Toilet 20'), '30' => __('Toilet 30'), '40' => __('Toilet 40'), '50' => __('Toilet 50')];
    }


    public function getRoomTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['room']) ? $data['room'] : '');
        $list = $this->getRoomList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getSaloonTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['saloon']) ? $data['saloon'] : '');
        $list = $this->getSaloonList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getToiletTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['toilet']) ? $data['toilet'] : '');
        $list = $this->getToiletList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    public function building(){
        return $this->belongsTo('Building','building_id','building_id',[],'LEFT')->setEagerlyType(0);
    }




}
