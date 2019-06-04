<?php

namespace app\api\controller;

use app\common\controller\Api;
use think\Db;
use fast\Http;
use wechat\Wechat;
/**
 * 首页接口
 */
class Index extends Api
{
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];

    /**
     * 首页
     *
     */
    public function index()
    {
        $this->success('请求成功');
    }


    /*
     * 获取openid
     *
     * */
    public function openid(){
        $params=$this->request->request();
        if(empty($params['js_code'])){
            return $this->error('请携带参数js_code!');
        }
        $appset=model('Config')->getGroupData('systemset');
        $wechat=new Wechat($appset['appid'],$appset['secret']);
        $res=$wechat->getOpenId($params['js_code']);
        if($res){
            return $this->success('请求成功!',$res);
        }else{
            return $this->error('请求失败!');
        }
    }


    /*
     * 获取用户信息
     * @params openid
     * @params nickname
     * @params avatar
     * @params
     *
     * */
    public function userInfo(){
        $params=$this->request->request();
        if(empty($params['nickname']) || empty($params['avatar']) ||empty($params['openid'])){
            return $this->error('请携带参数nickname,avatar,openid!');
        }
        $user=model('user')->get(['openid'=>$params['openid']]);
        if($user){
            return $this->success('请求成功!',$user);
        }else{
            $params['createtime']=datetime(time());
            $res=model('user')->allowField(true)->save($params);
            $user=model('user')->get(['openid'=>$params['openid']]);
            return $this->success('新增成功!',$user);
        }

    }



	/*
	*首页轮播图
	*
	*
	*/
	public function adList(){
		$list=Db::table('fa_ad')->order('weigh','desc')->field(['ad_id','image'])->select();
		if($list){
			return $this->success('请求成功!',$list);
			
		}else{
			return $this->error('请求失败!');
		}
		
	}
		


    /*
     * 基本设置
     *
     * */
    public function systemset(){
        $info=model('Config')->getGroupData('systemset');
        if($info){
            return $this->success('请求成功!');
        }else{
            return $this->error('请求失败!');
        }
    }


    /*
     * 楼盘列表
     * @params keywords 关键词
     * @params category 楼盘类型 10=热搜楼盘,20=最新推荐,30=即将预售,40=最新摇号,50=摇号剩余,60=其它
     * @params status 楼盘状态 10=在售,20=代售,30=商办,40=不限购,50=即将预购
     * @params renovation 楼盘标签 10=清水房,20=简装,30=精装
     * @params class 楼盘类型2 10=住宅,20=公寓,30=写字楼,40=商铺,50=别墅
     * @params sale 售卖状态 10=待售,20=即将预售,30=在售,40=已清盘
     * @params page 页数 默认为1
     * @params pagesize 页码 默认为10
     *
     * */
    public function buildingList(){
        $params=$this->request->request();
        empty($params['page'])?$page=1:$page=$params['page'];
        empty($params['pagesize'])?$pagesize=10:$pagesize=$params['pagesize'];
        $where=[];
        if(!empty($params['category'])){
            $where['category']=$params['category'];
        }
        if(!empty($params['status'])){
            $where['status']=$params['status'];
        }
        if(!empty($params['renovation'])){
            $where['renovation']=$params['renovation'];
        }
        if(!empty($params['class'])){
            $where['class']=$params['class'];
        }
        if(!empty($params['sale'])){
            $where['sale']=$params['sale'];
        }
        if(!empty($params['keywords'])){
            $where['name']=array('like',"%{$params['keywords']}%");
        }

        $list=Db::table('fa_building')->where($where)->field(['building_id','name','thumbnail_img','address'])->limit(($page-1)*$pagesize,$pagesize)->select();
        $list=collection($list)->toArray();
        foreach($list as $k=>$v){
            $list[$k]['comments_number']=Db::table('fa_building_comment')->where(['building_id'=>$v['building_id']])->count();
        }
        
        if($list){
            return $this->success('请求成功!',$list);
        }else{
            return $this->error('请求失败!');
        }
    }


    /*
     * 楼盘详情
     * @params building_id 楼盘id
     * @params user_id 用户id
     * */
    public function buildingDetail(){
        $params=$this->request->request();
        if(empty($params['building_id'])){
            return $this->error('请携带参数building_id!');
        }

        //查询楼盘主体信息
        $building=Db::table('fa_building')->where(['building_id'=>$params['building_id']])->find();
        if(empty($building)){
            return $this->error('该楼盘信息不存在!');
        }
        $building['real_images']=explode(',',$building['real_images']);
        $building['periphery_images']=explode(',',$building['periphery_images']);
        $building['template_images']=explode(',',$building['template_images']);
        $building['effect_images']=explode(',',$building['effect_images']);
        $building['bird_images']=explode(',',$building['bird_images']);
        $building_follow=Db::table('fa_user_follow')->where(['user_id'=>$params['user_id'],'building_id'=>$params['building_id']])->find();
        if($building_follow){
            $building['is_follow']=20;//已关注
        }else{
            $building['is_follow']=10;//未关注
        }

        //查询楼盘所有户型信息 主键id 封面图 几室 几厅 几卫 面积 朝向
        $building_apartment=Db::table('fa_building_apartment')
            ->where(['building_id'=>$params['building_id']])
            ->field(['building_apartment_id','image','room','saloon','toilet','area','sale'])
            ->select();

        //查询楼盘动态信息一条 、 该楼盘的动态数量
        $building_dynamic=Db::table('fa_building_dynamic')->where(['building_id'=>$params['building_id']])->find();
        $building_dynamic_count=Db::table('fa_building_dynamic')
            ->where(['building_id'=>$params['building_id']])->count();

        //查询关于楼盘的 三条评论 、 所有评论数量
        $building_comment=Db::table('fa_building_comment')
            ->alias('a')->join('fa_user b','a.user_id=b.user_id','LEFT')
            ->where(['a.building_id'=>$params['building_id']])
            ->field(['a.building_comment_id','b.nickname','b.avatar','a.reply','a.createtime'])
            ->limit(3)->select();
        $building_comment_count=Db::table('fa_building_comment')
            ->where(['building_id'=>$params['building_id']])
            ->count();

        //猜你喜欢 把楼盘的category class renovation sale
        $where=['category'=>10];
        $thinkLikes=Db::table('fa_building')
            ->where(['sale'=>30,'building_id'=>array('neq',$building['building_id'])])
            ->where(function($query)use($building){
                $query->where(['category'=>$building['category']])
                    ->whereOr(['class'=>$building['class']])
                    ->whereOr(['renovation'=>$building['renovation']]);
            })
            ->field(['building_id','name','thumbnail_img','total_price'])
            ->limit(3)
            ->select();
        foreach($thinkLikes as $k=>$v){
            $thinkLikes[$k]['comments_number']=model('building_comment')->where('building_id',$v['building_id'])->count();
        }

        $info['building']=$building;
        $info['apartment']=$building_apartment;
        $info['dynamic']['data']=$building_dynamic;
        $info['dynamic']['count']=$building_dynamic_count;
        $info['comment']['data']=$building_comment;
        $info['comment']['count']=$building_comment_count;
        $info['like']=$thinkLikes;

        return $this->success('请求成功!',$info);

    }



    /*
     * 关注楼盘
     * @params user_id 用户id
     * @params building_id 楼盘id
     *
     * */
    public function followBuilding(){
        $params=$this->request->request();
        if(empty($params['user_id'] || empty($params['building_id']))){
            return $this->error('请携带参数user_id和building_id!');
        }
        $res=Db::table('fa_user_follow')->where(['user_id'=>$params['user_id'],'building_id'=>$params['building_id']])->find();
        if($res){
            $del=Db::table('fa_user_follow')->where(['user_id'=>$params['user_id'],'building_id'=>$params['building_id']])->delete();
            if($del){
                return $this->success('取消关注成功!');
            }else{
                return $this->error('取消管制失败!');
            }
        }
        $params['createtime']=datetime(time());
        Db::startTrans();
        try{
            Db::table('fa_user_follow')->insert($params);
            $id=Db::table('fa_user_follow')->getLastInsID();
            Db::commit();
            $res='success';
        }catch(\Exception $e){
            $msg=$e->getMessage();
            Db::rollback();
            $res='error';
        }
        if($res='success'){

            return $this->success('关注成功!',$id);
        }else{
            return $this->error('关注失败!errCode:'.$msg);
        }
    }



    /*
     * 评论楼盘
     * @params user_id 用户id
     * @params building_id 楼盘id
     * @params reply 回复内容
     * @params pid 上级评论id 如果是一级评论就是0
     *
     * */
    public function commentBuilding(){
        $params=$this->request->request();
        if(empty($params['user_id']) || empty($params['building_id']) || empty($params['reply'])){
            return $this->error('请携带参数user_id,building_id,reply,pid!');
        }
        $params['createtime']=datetime(time());
        $res=model('building_comment')->allowField(true)->save($params);
        $id=model('building_comment')->getLastInsID();
        if($res){
            return $this->success('请求成功!',$id);
        }else{
            return $this->error('请求失败!');
        }
    }



    /*
     * 一房一价
     * @params building_id 楼盘id
     * @params tung 楼栋
     * @params unit 单元
     * $params order 排序字段 area total_price price
     * @params sort 排序规则 asc  desc
     * @params page 页数
     * @params pagesize 页码
     *
     * */
    public function buildingHouse(){
        $params=$this->request->request();
        if(empty($params['building_id'])){
            return $this->error('请携带参数building_id!');
        }
        $where=[];
        $order=[];
        //楼栋
        if(!empty($params['tung'])){
            $where['tung']=$params['tung'];
        }
        //单元
        if(!empty($params['unit'])){
            $where['unit']=$params['unit'];
        }
        //排序  面积 area  参考单价 total_price  参考总价 price
        if(!empty($params['order'])){
            if(!in_array($params['order'],['area','total_price','price'])){
                return $this->error('order参数只能在area、total_price、price中!');
            }

            $order=[$params['order']=>$params['sort']];
        }
        empty($params['page'])?$page=1:$page=intval(max(1,$params['page']));
        empty($params['pagesize'])?$pagesize=10:$pagesize=$params['pagesize'];
        $list=model('building_house')->where(['building_id'=>$params['building_id']])->where($where)->order($order)->page($page,$pagesize)->select();
        $list=collection($list)->toArray();

        $tung=Db::table('fa_building_house')->where(['building_id'=>$params['building_id']])->group('tung')->field('tung')->select();//楼栋
        $unit=Db::table('fa_building_house')->where(['building_id'=>$params['building_id']])->group('unit')->field('unit')->select();//单元
        $data['tung']=$tung;
        $data['unit']=$unit;
        $data['list']=$list;
        if($list){
            return $this->success('请求成功!',$data);
        }else{
            return $this->error('请求失败!');
        }


    }




    /*
     * 相册
     * @params building_id 楼盘id
     *
     *
     * */
    public function album(){
        $params=$this->request->request();
        if(empty($params['building_id'])){
            return $this->error('请携带参数building_id!');
        }
        $album=Db::table('fa_building')
            ->where(['building_id'=>$params['building_id']])
            ->field(['building_id','real_images','periphery_images','template_images','effect_images','	bird_images'])->find();

        $album['real_images']=explode(',',$album['real_images']);
        $album['periphery_images']=explode(',',$album['periphery_images']);
        $album['template_images']=explode(',',$album['template_images']);
        $album['effect_images']=explode(',',$album['effect_images']);
        $album['bird_images']=explode(',',$album['bird_images']);

        if($album){
            return $this->success('请求成功!',$album);
        }else{
            return $this->error('请求失败!');
        }

    }




    /*
     * 楼盘的户型列表
     * @params building_id 楼盘id
     * @params room 室:10=一室,20=二室,30=三室,40=四室,50=五室
     * @params page 页数 不填默认为1
     * @params pagesize 页码 不填默认为10
     *
     *
     * */
    public function apartmentList(){
        $params=$this->request->request();
        if(empty($params['building_id'])){
            return $this->error('请携带参数building_id!');
        }

        $where=[];
        if(!empty($params['room'])){
            $where['room']=$params['room'];
        }
        empty($params['page'])?$page=1:$page=intval($params['page']);
        empty($params['pagesize'])?$pagesize=10:$pagesize=intval($params['pagesize']);
        $list=Db::table('fa_building_apartment')->alias('a')
            ->join('fa_building b','a.building_id=b.building_id','LEFT')
            ->where(['a.building_id'=>$params['building_id']])
            ->where($where)
            ->field(['a.building_apartment_id','a.image','a.room','a.saloon','a.toilet','a.area','a.sale','b.name'])->page($page,$pagesize)->select();

        if($list){
            return $this->success('请求成功!',$list);
        }else{
            return $this->error('请求失败!');
        }
    }


    /*
     * 户型详情
     * @params building_apartment_id 户型id
     * */
    public function apartmentDetails(){
        $params=$this->request->request();
        if(empty($params['building_apartment_id'])){
            return $this->error('请携带参数building_apartment_id!');
        }

        $info=Db::table('fa_building_apartment')->where(['building_apartment_id'=>$params['building_apartment_id']])->find();
        if($info){
            return $this->success('请求成功!',$info);
        }else{
            return $this->error('请求失败!');
        }
    }



    /*
     * 楼盘的动态列表
     * @params building_id 楼盘id
     * @params category 10=楼盘动态,20=预售证,30=开盘,40=摇号动态
     *
     * */
    public function dynamicList(){
        $params=$this->request->request();
        if(empty($params['building_id'])){
            return $this->error('请携带参数building_id!');
        }
        $where=[];
        if(!empty($params['category'])){
            $where['category']=$params['category'];
        }
        $list=model('building_dynamic')->where($where)->select();
        if($list){
            return $this->success('请求成功!',$list);
        }else{
            return $this->error('请求失败!');
        }
    }



    /*
     * 楼盘的评论列表
     * @params building_id 楼盘id
     * @params page
     * @params pagesize
     *
     * */
    public function commentList(){
        $params=$this->request->request();
        if(empty($params['building_id'])){
            return $this->error('请携带参数building_id!');
        }

        empty($params['page']) ? $page=1 : $page=intval($params['page']);
        empty($params['pagesize']) ? $pagesize=10 : $pagesize=intval($params['pagesize']);

        //$list=model('building_comment')->where(['building_id'=>$params['building_id']])->select();
        $plist=Db::table('fa_building_comment')->alias('a')
            ->join('fa_user b','a.user_id=b.user_id','LEFT')
            ->where(['a.building_id'=>$params['building_id'],'a.pid'=>0])
            ->field(['a.building_comment_id','a.reply','a.createtime','b.nickname','b.avatar'])
            ->page($page,$pagesize)
            ->select();
        foreach($plist as $k=>$v){
            $plist[$k]['child']=Db::table('fa_building_comment')->alias('a')
                ->join('fa_user b','a.user_id=b.user_id','LEFT')
                ->where(['pid'=>$v['building_comment_id']])
                ->field(['a.reply,a.createtime','b.nickname','b.avatar'])
                ->select();
        }
        //$plist=collection($plist)->toArray();
        if($plist){
            return $this->success('请求成功!',$plist);
        }else{
            return $this->error('请求失败!');
        }

    }



    /*
     * 地图找房
     * @params sale 售卖:10=待售,20=即将预售,30=在售,40=已清盘
     * @params area 区域 比如青羊区、武侯区、高新区
     *
     * */
    public function mapBuildingList(){
        $params=$this->request->request();
        $where=[];
        if(!empty($params['sale'])){
            $where['sale']=$params['sale'];
        }
        if(!empty($params['area'])){
            $where['address']=array('like',"%{$params['area']}%");
        }
        $list=Db::table('fa_building')->where($where)->field(['building_id','name','longitude','latitude'])->select();
        if($list){
            return $this->success('请求成功!',$list);
        }else{
            return $this->error('请求失败!');
        }
    }



    /*
     * 资格测试题
     * @params category 10=购房资格,20=刚需资格
     *
     * */
    public function questionTest(){
        $params=$this->request->request();
        if(empty($params['category'])){
            return $this->error('请携带参数category!');
        }
        $list=Db::table('fa_question')->where(['category'=>$params['category']])->order('weigh','ASC')->field(['question_id','title'])->select();
        foreach($list as $k=>$v){
            $list[$k]['answer']=Db::table('fa_answer')->where(['question_id'=>$v['question_id']])->field(['answer_id','title','details','is_answer'])->select();
            if(count($list[$k]['answer'])==0){
                unset($list[$k]);
            }
        }

        if($list){
            return $this->success('请求成功!',$list);
        }else{
            return $this->error('请求失败!');
        }
    }



    /*
     * 文章列表
     *
     * @params is_recommend 是否热门:10=不热门,20=热门
     *
     * */
    public function articleList(){
        $params=$this->request->request();

        $where=[];
        if(!empty($params['is_recommend'])){
            $where['is_recommend']=$params['is_recommend'];
        }

        $list=Db::table('fa_article')->where($where)->field(['article_id','image','title','author','author_avatar','createtime'])->order('article_id','desc')->select();
        if($list){
            return $this->success('请求成功!',$list);
        }else{
            return $this->error('请求失败!');
        }

    }



    /*
     * 文章详情
     * @params article_id 文章id
     *
     * */
    public function articleDetails(){
        $params=$this->request->request();
        if(empty($params['article_id'])){
            return $this->error('请携带参数article_id!');
        }

        $info=Db::table('fa_article')->where(['article_id'=>$params['article_id']])->find();
        if($info){
            return $this->success('请求成功!',$info);
        }else{
            return $this->error('请求失败!');
        }
    }



    /*
     * 我的关注
     * @params user_id 用户id
     *
     * */
    public function followList(){
        $params=$this->request->request();
        $list=Db::table('fa_user_follow')->alias('a')
            ->join('fa_building b','a.building_id=b.building_id','LEFT')
            ->where(['a.user_id'=>$params['user_id']])
            ->field(['a.user_follow_id','b.name','thumbnail_img','b.sale','b.house_price'])
            ->select();

        if($list){
            return $this->success('请求成功!',$list);
        }else{
            return $this->error('请求失败!');
        }
    }



    /*
     * 意见反馈
     * @params user_id 用户id
     * @params details 反馈内容
     * @params category 反馈类型:10=操作不流畅,20=界面不太美观,30=功能不太完善
     *
     * */
    public function addFeedback(){
        $params=$this->request->request();
        $params['createtime']=datetime(time());
        $res=model('user_feedback')->allowField(true)->save($params);
        if($res){
            return $this->success('反馈成功!');
        }else{
            return $this->error('反馈失败!');
        }

    }


}
