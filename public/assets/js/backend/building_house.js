define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'building_house/index' + location.search,
                    add_url: 'building_house/add',
                    edit_url: 'building_house/edit',
                    del_url: 'building_house/del',
                    multi_url: 'building_house/multi',
                    table: 'building_house',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'building_house_id',
                sortName: 'building_house_id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'building_house_id', title: __('Building_house_id')},
                        {field: 'tung', title: __('Tung')},
                        {field: 'unit', title: __('Unit')},
                        {field: 'floor', title: __('Floor')},
                        {field: 'number', title: __('Number')},
                        {field: 'room', title: __('Room')},
                        {field: 'saloon', title: __('Saloon')},
                        {field: 'toilet', title: __('Toilet')},
                        {field: 'balcony', title: __('Balcony')},
                        {field: 'area', title: __('Area'), operate:'BETWEEN'},
                        {field: 'category', title: __('Category'), searchList: {"10":__('Category 10'),"20":__('Category 20'),"30":__('Category 30'),"40":__('Category 40'),"50":__('Category 50')}, formatter: Table.api.formatter.normal},
                        {field: 'renovation', title: __('Renovation'), searchList: {"10":__('Renovation 10'),"20":__('Renovation 20'),"3":__('Renovation 3')}, formatter: Table.api.formatter.normal},
                        {field: 'price', title: __('Price'), operate:'BETWEEN'},
                        {field: 'total_price', title: __('Total_price'), operate:'BETWEEN'},
                        {field: 'three_price', title: __('Three_price'), operate:'BETWEEN'},
                        {field: 'six_price', title: __('Six_price'), operate:'BETWEEN'},
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