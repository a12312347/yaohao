define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'answer/index' + location.search,
                    add_url: 'answer/add',
                    edit_url: 'answer/edit',
                    del_url: 'answer/del',
                    multi_url: 'answer/multi',
                    table: 'answer',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'answer_id',
                sortName: 'answer_id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'answer_id', title: __('Answer_id')},
                        {field: 'ans', title: __('Ans'), searchList: {"A":__('A'),"B":__('B'),"C":__('C'),"D":__('D')}, formatter: Table.api.formatter.normal},
                        {field: 'title', title: __('Title')},
                        {field: 'is_answer', title: __('Is_answer'), searchList: {"0":__('Is_answer 0'),"1":__('Is_answer 1')}, formatter: Table.api.formatter.normal},
                        {field: 'question_id', title: __('Question_id')},
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