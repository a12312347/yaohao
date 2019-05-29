define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'building/index' + location.search,
                    add_url: 'building/add',
                    edit_url: 'building/edit',
                    del_url: 'building/del',
                    multi_url: 'building/multi',
                    table: 'building',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'building_id',
                sortName: 'building_id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'building_id', title: __('Building_id')},
                        {field: 'category', title: __('Category'), searchList: {"10":__('Category 10'),"20":__('Category 20'),"30":__('Category 30'),"40":__('Category 40'),"50":__('Category 50'),"60":__('Category 60')}, formatter: Table.api.formatter.normal},
                        {field: 'name', title: __('Name')},
                        {field: 'alias', title: __('Alias')},
                        {field: 'detail_img', title: __('Detail_img'),events:Table.api.events.image,formatter:Table.api.formatter.image},
                        {field: 'thumbnail_img', title: __('Thumbnail_img'),events:Table.api.events.image,formatter:Table.api.formatter.image},
                        {field: 'status', title: __('Status'), searchList: {"10":__('Status 10'),"20":__('Status 20'),"30":__('Status 30'),"40":__('Status 40'),"50":__('Status 50')}, formatter: Table.api.formatter.status},
                        {field: 'renovation', title: __('Renovation'), searchList: {"10":__('Renovation 10'),"20":__('Renovation 20'),"30":__('Renovation 30')}, formatter: Table.api.formatter.normal},
                        {field: 'class', title: __('Class'), searchList: {"10":__('Class 10'),"20":__('Class 20'),"30":__('Class 30'),"40":__('Class 40'),"50":__('Class 50')}, formatter: Table.api.formatter.normal},
                        {field: 'sale', title: __('Sale'), searchList: {"10":__('Sale 10'),"20":__('Sale 20'),"30":__('Sale 30')}, formatter: Table.api.formatter.normal},
                        {field: 'is_hot', title: __('Is_hot'), searchList: {"10":__('Is_hot 10'),"20":__('Is_hot 20')}, formatter: Table.api.formatter.normal},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate,buttons:[
                            {
                                name:'show_apartment',
                                text:'',
                                title:'查看楼盘户型',
                                icon:'fa fa-list',
                                classname:'btn btn-xs btn-primary btn-dialog',
                                url:'buildingapartment?building_id={row.building_id}'
                            }
                        ]}
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