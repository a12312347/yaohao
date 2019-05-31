define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'user_feedback/index' + location.search,
                    add_url: 'user_feedback/add',
                    edit_url: 'user_feedback/edit',
                    del_url: 'user_feedback/del',
                    multi_url: 'user_feedback/multi',
                    table: 'user_feedback',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'user_feedback_id',
                sortName: 'user_feedback_id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'user_feedback_id', title: __('User_feedback_id')},
                        {field: 'category', title: __('Category'), searchList: {"10":__('Category 10'),"20":__('Category 20'),"30":__('Category 30')}, operate:'FIND_IN_SET', formatter: Table.api.formatter.label},
                        {field: 'user_id', title: __('User_id')},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'user.nickname', title: __('User.nickname')},
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