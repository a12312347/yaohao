define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'answer_record/index' + location.search,
                    add_url: 'answer_record/add',
                    //edit_url: 'answer_record/edit',
                    del_url: 'answer_record/del',
                    show_url: 'answer_record/show',
                    multi_url: 'answer_record/multi',
                    table: 'answer_record',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'answer_record_id',
                sortName: 'answer_record_id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'answer_record_id', title: __('Answer_record_id')},


                        {field: 'user_id', title: __('User_id')},
                        {field: 'user.nickname', title: __('User.Nickname')},
                        {field: 'category', title: __('Category'), searchList: {"10":__('Category 10'),"20":__('Category 20')}, formatter: Table.api.formatter.normal},
                        {field: 'questions_id', title: __('Questions_id')},
                        {field: 'answers_id', title: __('Answers_id')},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'status', title: __('Status'), searchList: {"10":__('Status 10'),"20":__('Status 20')}, formatter: Table.api.formatter.status},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate,buttons:[
                            {
                                name:'show',
                                icon:'fa fa-info',
                                title:'查看问题和答案',
                                classname:'btn-xs btn btn-info btn-dialog',
                                url:'answer_record/show'

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