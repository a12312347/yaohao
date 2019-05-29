define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'buildingapartment/index' + location.search,
                    add_url: 'buildingapartment/add',
                    edit_url: 'buildingapartment/edit',
                    del_url: 'buildingapartment/del',
                    multi_url: 'buildingapartment/multi',
                    table: 'building_apartment',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'building_apartment_id',
                sortName: 'building_apartment_id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'building_apartment_id', title: __('Building_apartment_id')},
                        {field: 'image', title: __('Image'), events: Table.api.events.image, formatter: Table.api.formatter.image},
                        {field: 'room', title: __('Room'), searchList: {"10":__('Room 10'),"20":__('Room 20'),"30":__('Room 30'),"40":__('Room 40'),"50":__('Room 50')}, formatter: Table.api.formatter.normal},
                        {field: 'saloon', title: __('Saloon'), searchList: {"10":__('Saloon 10'),"20":__('Saloon 20'),"30":__('Saloon 30'),"40":__('Saloon 40'),"50":__('Saloon 50')}, formatter: Table.api.formatter.normal},
                        {field: 'toilet', title: __('Toilet'), searchList: {"10":__('Toilet 10'),"20":__('Toilet 20'),"30":__('Toilet 30'),"40":__('Toilet 40'),"50":__('Toilet 50')}, formatter: Table.api.formatter.normal},
                        {field: 'area', title: __('Area'), operate:'BETWEEN'},
                        {field: 'price', title: __('Price'), operate:'BETWEEN'},
                        {field: 'building_id', title: __('Building_id')},
                        {field: 'building.name', title: __('Building.name')},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});