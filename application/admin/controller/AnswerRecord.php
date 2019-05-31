<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Db;

/**
 * 答题记录管理
 *
 * @icon fa fa-circle-o
 */
class AnswerRecord extends Backend
{
    
    /**
     * AnswerRecord模型对象
     * @var \app\common\model\AnswerRecord
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\common\model\AnswerRecord;
        $this->view->assign("statusList", $this->model->getStatusList());
        $this->view->assign("categoryList", $this->model->getCategoryList());
    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */



    /**
     * 查看
     */
    public function index()
    {
        //当前是否为关联查询
        $this->relationSearch = true;
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                ->with(['user'])
                ->where($where)
                ->order($sort, $order)
                ->count();

            $list = $this->model
                ->with(['user'])
                ->where($where)
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();
            foreach ($list as $row) {
                $row->visible(['answer_record_id','answers_id','questions_id','status','createtime','category','user_id']);
                $row->visible(['user']);
                $row->getRelation('user')->visible(['nickname']);

            }

            $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }


    public function show($ids =NULL){
        $row=$this->model->get(['answer_record_id'=>$ids]);
        $questions_id=explode(',',$row['questions_id']);
        $answers_id=explode(',',$row['answers_id']);
        $questions=[];
        $answers=[];
        foreach($questions_id as $k=>$v){
            $questions[$k]=Db::table('fa_question')->where('question_id',$v)->field(['title'])->find()['title'];
        }
        foreach($answers_id as $k=>$v){
            $answers[$k]['title']=Db::table('fa_answer')->where('answer_id',$v)->field(['title','details'])->find()['title'];
            $answers[$k]['details']=Db::table('fa_answer')->where('answer_id',$v)->field(['title','details'])->find()['details'];
        }
        $this->view->assign('questions',$questions);
        $this->view->assign('answers',$answers);
        $this->view->assign('row',$row);
        return $this->view->fetch();
    }

}
