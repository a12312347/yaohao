define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'building_dynamic/index' + location.search,
                    add_url: 'building_dynamic/add',
                    edit_url: 'building_dynamic/edit',
                    del_url: 'building_dynamic/del',
                    multi_url: 'building_dynamic/multi',
                    table: 'building_dynamic',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'building_dynamic_id',
                sortName: 'building_dynamic_id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'building_dynamic_id', title: __('Building_dynamic_id')},
                        {field: 'category', title: __('Category'), searchList: {"10":__('Category 10'),"20":__('Category 20'),"30":__('Category 30'),"40":__('Category 40')}, formatter: Table.api.formatter.normal},
                        {field: 'title', title: __('Title')},
                        {field: 'author', title: __('Author')},
                        {field: 'author_avatar', title: __('Author_avatar'), events: Table.api.events.image, formatter: Table.api.formatter.image},
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