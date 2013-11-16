<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------

require APP_ROOT_PATH.'app/Lib/page.php';
class homeModule extends BaseModule
{
	public function index()
	{		

		$id = intval($_REQUEST['id']);
		
		$home_user_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id = ".$id." and is_effect = 1");
		if(!$home_user_info)
		{
			app_redirect(url("index"));	
		}
		
		$home_user_info['weibo_list'] = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."user_weibo where user_id = ".$home_user_info['id']);
		$GLOBALS['tmpl']->assign("home_user_info",$home_user_info);
		
		$page_size = DEAL_PAGE_SIZE;
		$step_size = DEAL_STEP_SIZE;
		
		$step = intval($_REQUEST['step']);
		if($step==0)$step = 1;
		$page = intval($_REQUEST['p']);
		if($page==0)$page = 1;		
		$limit = (($page-1)*$page_size+($step-1)*$step_size).",".$step_size	;
		
		$GLOBALS['tmpl']->assign("current_page",$page);
		
		$condition = " is_delete = 0 and is_effect = 1 and user_id = ".intval($home_user_info['id'])." "; 
		
		
		$deal_list = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal where ".$condition." order by sort asc limit ".$limit);
		$deal_count = $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."deal where ".$condition);
		foreach($deal_list as $k=>$v)
		{
			$deal_list[$k]['remain_days'] = floor(($v['end_time'] - get_gmtime())/(24*3600));
			$deal_list[$k]['percent'] = round($v['support_amount']/$v['limit_price']*100);
		}
		$GLOBALS['tmpl']->assign("deal_list",$deal_list);
		
		$page = new Page($deal_count,$page_size);   //初始化分页对象 		
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign('pages',$p);		
		
		$GLOBALS['tmpl']->display("home_index.html");
	}
	
	
	public function support()
	{		

		$id = intval($_REQUEST['id']);
		
		$home_user_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id = ".$id." and is_effect = 1");
		if(!$home_user_info)
		{
			app_redirect(url("index"));	
		}
		
		$home_user_info['weibo_list'] = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."user_weibo where user_id = ".$home_user_info['id']);
		$GLOBALS['tmpl']->assign("home_user_info",$home_user_info);
		
		$page_size = DEAL_PAGE_SIZE;
		$step_size = DEAL_STEP_SIZE;
		
		$step = intval($_REQUEST['step']);
		if($step==0)$step = 1;
		$page = intval($_REQUEST['p']);
		if($page==0)$page = 1;		
		$limit = (($page-1)*$page_size+($step-1)*$step_size).",".$step_size	;
		
		$GLOBALS['tmpl']->assign("current_page",$page);
		
		$sql = "select distinct(d.id) as id,d.* from ".DB_PREFIX."deal as d left join ".DB_PREFIX."deal_support_log as dsl on d.id = dsl.deal_id ".
			   " where dsl.user_id = ".$home_user_info['id']." order by d.sort asc limit ".$limit;
	
		$sql_count = "select count(distinct(d.id)) from ".DB_PREFIX."deal as d left join ".DB_PREFIX."deal_support_log as dsl on d.id = dsl.deal_id ".
			   " where dsl.user_id = ".$home_user_info['id'];
		
		$deal_list = $GLOBALS['db']->getAll($sql);
		$deal_count = $GLOBALS['db']->getOne($sql_count);

		foreach($deal_list as $k=>$v)
		{
			$deal_list[$k]['remain_days'] = floor(($v['end_time'] - NOW_TIME)/(24*3600));
			$deal_list[$k]['percent'] = round($v['support_amount']/$v['limit_price']*100);
		}
		$GLOBALS['tmpl']->assign("deal_list",$deal_list);
		
		$page = new Page($deal_count,$page_size);   //初始化分页对象 		
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign('pages',$p);		
		
		$GLOBALS['tmpl']->display("home_support.html");
	}
	
	
    public function news()
	{
		
		$id = intval($_REQUEST['id']);
		
		$home_user_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id = ".$id." and is_effect = 1");
		if(!$home_user_info)
		{
			app_redirect(url("index"));	
		}
		$home_user_info['weibo_list'] = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."user_weibo where user_id = ".$home_user_info['id']);
		$GLOBALS['tmpl']->assign("home_user_info",$home_user_info);
		
		$GLOBALS['tmpl']->assign("page_title","ta的动态");
		if($cate_result===false)
		{
			$cate_list = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal_cate order by sort asc");
			$cate_result= array();
			foreach($cate_list as $k=>$v)
			{
				$cate_result[$v['id']] = $v;
			}
		}
		$GLOBALS['tmpl']->assign("cate_list",$cate_result);
		
		$rand_deals = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal where is_delete = 0 and is_effect = 1 and begin_time < ".NOW_TIME." and (end_time >".NOW_TIME." or end_time = 0) order by rand() limit 3");
		$GLOBALS['tmpl']->assign("rand_deals",$rand_deals);
		
		$page_size = DEALUPDATE_PAGE_SIZE;
		$step_size = DEALUPDATE_STEP_SIZE;
		
		$step = intval($_REQUEST['step']);
		if($step==0)$step = 1;
		$page = intval($_REQUEST['p']);
		if($page==0)$page = 1;		
		$limit = (($page-1)*$page_size+($step-1)*$step_size).",".$step_size	;
		
		$GLOBALS['tmpl']->assign("current_page",$page);
		
		$sql = "select dl.* from ".DB_PREFIX."deal_log as dl where dl.user_id = ".$id." order by dl.create_time desc limit ".$limit;
		$sql_count = "select count(*) from ".DB_PREFIX."deal_log as dl where dl.user_id = ".$id;
		
		$log_list = $GLOBALS['db']->getAll($sql);
		$log_count = $GLOBALS['db']->getOne($sql_count);
		
		foreach($log_list as $k=>$v)
		{
			$log_list[$k]['pass_time'] = pass_date($v['create_time']);
			$log_list[$k] = cache_log_comment($log_list[$k]);
			$log_list[$k] = cache_log_deal($log_list[$k]);
		}
		$GLOBALS['tmpl']->assign('log_list',$log_list);
		
		$pager = new Page($log_count,$page_size);   //初始化分页对象 		
		$p  =  $pager->show();
		$GLOBALS['tmpl']->assign('pages',$p);		
		
		$GLOBALS['tmpl']->assign("ajaxurl",url("ajax#newsfav",array("p"=>$page)));		
		$GLOBALS['tmpl']->display("home_news.html");
	}

	
	
}
?>