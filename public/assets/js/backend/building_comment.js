define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'building_comment/index' + location.search,
                    add_url: 'building_comment/add',
                    edit_url: 'building_comment/edit',
                    del_url: 'building_comment/del',
                    multi_url: 'building_comment/multi',
                    table: 'building_comment',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'building_comment_id',
                sortName: 'building_comment_id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'building_comment_id', title: __('Building_comment_id')},
                        {field: 'reply', title: __('Reply')},
                        {field: 'building_id', title: __('Building_id')},
                        {field: 'building.name', title: __('Building.name')},
                        {field: 'user_id', title: __('User_id')},
                        {field: 'user.nickname', title: __('User.nickname')},
                        {field: 'pid', title: __('Pid')},
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