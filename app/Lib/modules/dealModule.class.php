<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------


function init_deal_page($deal_info)
{
	$GLOBALS['tmpl']->assign("page_title",$deal_info['name']);
	
	if($deal_info['seo_title']!="")
	$GLOBALS['tmpl']->assign("seo_title",$deal_info['seo_title']);
	if($deal_info['seo_keyword']!="")
	$GLOBALS['tmpl']->assign("seo_keyword",$deal_info['seo_keyword']);
	if($deal_info['seo_description']!="")
	$GLOBALS['tmpl']->assign("seo_description",$deal_info['seo_description']);
	
	$deal_info['tags_arr'] = preg_split("/[ ,]/",$deal_info['tags']);		

	
	$deal_info['support_amount_format'] = number_price_format($deal_info['support_amount']);
	$deal_info['limit_price_format'] = number_price_format($deal_info['limit_price']);
	
	$deal_info['remain_days'] = floor(($deal_info['end_time'] - NOW_TIME)/(24*3600));
	if($deal_info['remain_days']<0)
		$deal_info['remain_days']=0;
	$deal_info['percent'] = round($deal_info['support_amount']/$deal_info['limit_price']*100);
		
	$GLOBALS['tmpl']->assign("deal_info",$deal_info);
	
	$deal_item_list = $deal_info['deal_item_list'];
	$GLOBALS['tmpl']->assign("deal_item_list",$deal_item_list);
	
	if($deal_info['user_id']>0)
	{
		$deal_user_info = $GLOBALS['db']->getRow("select id,user_name,province,city,intro,login_time from ".DB_PREFIX."user where id = ".$deal_info['user_id']." and is_effect = 1");
		if($deal_user_info)
		{
			$deal_user_info['weibo_list'] = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."user_weibo where user_id = ".$deal_user_info['id']);
			$GLOBALS['tmpl']->assign("deal_user_info",$deal_user_info);
		}
	}
	
	if($GLOBALS['user_info'])
	{
		$is_focus = $GLOBALS['db']->getOne("select  count(*) from ".DB_PREFIX."deal_focus_log where deal_id = ".$deal_info['id']." and user_id = ".intval($GLOBALS['user_info']['id']));
		$GLOBALS['tmpl']->assign("is_focus",$is_focus);
	}
}

class dealModule extends BaseModule
{
	public function index()
	{		
		$this->show();
	}
	
	public function show()
	{
		$id = intval($_REQUEST['id']);
		$deal_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where id = ".$id." and is_delete = 0 and (is_effect = 1 or (is_effect = 0 and user_id = ".intval($GLOBALS['user_info']['id'])."))");
		if(!$deal_info)
		{
			app_redirect(url("index"));
		}		
		
		if($deal_info['is_effect']==1)
		{
			log_deal_visit($deal_info['id']);
		}		
		
		$deal_info = cache_deal_extra($deal_info);
		$deal_faq_list = $deal_info['deal_faq_list'];
		$GLOBALS['tmpl']->assign("deal_faq_list",$deal_faq_list);
		
		$log_list = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal_log where deal_id = ".$id." order by create_time desc ");
		foreach($log_list as $k=>$v)
		{
			$log_list[$k]['pass_time'] = pass_date($v['create_time']);
			$online_time = online_date($v['create_time'],$deal_info['begin_time']);
			$log_list[$k]['online_time'] = $online_time['info'];
			if($online_time['key']!=$last_time_key)
			{
				$last_time_key = $log_list[$k]['online_time_key'] = $online_time['key'];				
			}
			
			$log_list[$k] = cache_log_comment($log_list[$k]);
		}
		$GLOBALS['tmpl']->assign("log_list1",$log_list);
		
		init_deal_page($deal_info);		
		
		
		$GLOBALS['tmpl']->display("deal_show.html");
	}
	
	public function comment()
	{
		$id = intval($_REQUEST['id']);
		$deal_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where id = ".$id." and is_delete = 0 and (is_effect = 1 or (is_effect = 0 and user_id = ".intval($GLOBALS['user_info']['id'])."))");
		if(!$deal_info)
		{
			app_redirect(url("index"));
		}		
		$deal_info = cache_deal_extra($deal_info);
		init_deal_page($deal_info);		
		
		
		$page_size = DEAL_COMMENT_PAGE_SIZE;
		$page = intval($_REQUEST['p']);
		if($page==0)$page = 1;		
		$limit = (($page-1)*$page_size).",".$page_size	;

		$comment_list = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal_comment where deal_id = ".$id." and log_id = 0 order by create_time desc limit ".$limit);
		$comment_count = $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."deal_comment where deal_id = ".$id." and log_id = 0");
		
		
		$GLOBALS['tmpl']->assign("comment_list",$comment_list);
		
		require APP_ROOT_PATH.'app/Lib/page.php';
		$page = new Page($comment_count,$page_size);   //初始化分页对象 		
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign('pages',$p);	
		
		
		
		$GLOBALS['tmpl']->display("deal_comment.html");
	}
	
	public function support()
	{
		$id = intval($_REQUEST['id']);
		$deal_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where id = ".$id." and is_delete = 0 and (is_effect = 1 or (is_effect = 0 and user_id = ".intval($GLOBALS['user_info']['id'])."))");
		if(!$deal_info)
		{
			app_redirect(url("index"));
		}		
		$deal_info = cache_deal_extra($deal_info);
		init_deal_page($deal_info);		
		
		$page_size = DEAL_SUPPORT_PAGE_SIZE;
		$page = intval($_REQUEST['p']);
		if($page==0)$page = 1;		
		$limit = (($page-1)*$page_size).",".$page_size	;

		$support_list = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal_support_log where deal_id = ".$id." order by create_time desc limit ".$limit);
		$support_count = $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."deal_support_log where deal_id = ".$id);
		
		$user_list = array();
		foreach($support_list as $k=>$v)
		{
			if($user_list[$v['user_id']])
			{
				$support_list[$k]['user_info'] = $user_list[$v['user_id']];
			}
			else
			{
				$support_list[$k]['user_info'] = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id = ".$v['user_id']);
				$user_list[$v['user_id']] = $support_list[$k]['user_info'];
			}
		}
		$GLOBALS['tmpl']->assign("support_list",$support_list);
		
		require APP_ROOT_PATH.'app/Lib/page.php';
		$page = new Page($support_count,$page_size);   //初始化分页对象 		
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign('pages',$p);	
		
		$GLOBALS['tmpl']->display("deal_support.html");
	}
	public function supports()
	{
		$id = intval($_REQUEST['id']);
		$deal_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where id = ".$id." and is_delete = 0 and (is_effect = 1 or (is_effect = 0 and user_id = ".intval($GLOBALS['user_info']['id'])."))");
		if(!$deal_info)
		{
			app_redirect(url("index"));
		}		
		$deal_info = cache_deal_extra($deal_info);
		init_deal_page($deal_info);		
		
		$page_size = DEAL_SUPPORT_PAGE_SIZE;
		$page = intval($_REQUEST['p']);
		if($page==0)$page = 1;		
		$limit = (($page-1)*$page_size).",".$page_size	;

		$support_list = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal_support_log where deal_id = ".$id." order by create_time desc limit ".$limit);
		$support_count = $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."deal_support_log where deal_id = ".$id);
		
		$user_list = array();
		foreach($support_list as $k=>$v)
		{
			if($user_list[$v['user_id']])
			{
				$support_list[$k]['user_info'] = $user_list[$v['user_id']];
			}
			else
			{
				$support_list[$k]['user_info'] = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id = ".$v['user_id']);
				$user_list[$v['user_id']] = $support_list[$k]['user_info'];
			}
		}
		$GLOBALS['tmpl']->assign("support_list",$support_list);
		
		require APP_ROOT_PATH.'app/Lib/page.php';
		$page = new Page($support_count,$page_size);   //初始化分页对象 		
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign('pages',$p);	
		
		$GLOBALS['tmpl']->display("deal_supports.html");
	}
	
	public function focus()
	{
		if(!$GLOBALS['user_info'])
		{
			$data['status'] = 0;
		}
		else
		{
			$id = intval($_REQUEST['id']);
			$deal_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where id = ".$id." and is_delete = 0 and is_effect = 1");
			if(!$deal_info)
			{
				$data['status'] = 3;	
				$data['info'] = "项目不存在";
				ajax_return($data);
			}
			
			$focus_data = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal_focus_log where deal_id = ".$id." and user_id = ".intval($GLOBALS['user_info']['id']));
			if($focus_data)
			{
				$GLOBALS['db']->query("update ".DB_PREFIX."deal set focus_count = focus_count - 1 where id = ".$id." and is_effect = 1");
				if($GLOBALS['db']->affected_rows()>0)
				{
					$GLOBALS['db']->query("delete from ".DB_PREFIX."deal_focus_log where id = ".$focus_data['id']);
					$GLOBALS['db']->query("update ".DB_PREFIX."user set focus_count = focus_count - 1 where id = ".intval($GLOBALS['user_info']['id']));
					
					//删除准备队列
					$GLOBALS['db']->query("delete from ".DB_PREFIX."user_deal_notify where user_id = ".intval($GLOBALS['user_info']['id'])." and deal_id = ".$id);
					$data['status'] = 2;	
				}	
				else
				{
					$data['status'] = 3;	
					$data['info'] = "项目未上线";
				}		
			}
			else
			{
				$GLOBALS['db']->query("update ".DB_PREFIX."deal set focus_count = focus_count + 1 where id = ".$id." and is_effect = 1");
				if($GLOBALS['db']->affected_rows()>0)
				{
					$focus_data['user_id'] = intval($GLOBALS['user_info']['id']);
					$focus_data['deal_id'] = $id;
					$focus_data['create_time'] = NOW_TIME;
					$GLOBALS['db']->autoExecute(DB_PREFIX."deal_focus_log",$focus_data);
					$GLOBALS['db']->query("update ".DB_PREFIX."user set focus_count = focus_count + 1 where id = ".intval($GLOBALS['user_info']['id']));
					
					//关注项目成功，准备加入准备队列
					if($deal_info['is_success'] == 0 && $deal_info['begin_time'] < NOW_TIME && ($deal_info['end_time']==0 || $deal_info['end_time']>NOW_TIME))
					{
						//未成功的项止准备生成队列
						$notify['user_id'] = $GLOBALS['user_info']['id'];
						$notify['deal_id'] = $deal_info['id'];
						$notify['create_time'] = NOW_TIME;
						$GLOBALS['db']->autoExecute(DB_PREFIX."user_deal_notify",$notify,"INSERT","","SILENT");
					}
					
					$data['status'] = 1;
				}
				else
				{
					$data['status'] = 3;
					$data['info'] = "项目未上线";
				}
			}
		}
		
		
		ajax_return($data);
	}
	
	public function video()
	{
		$id = intval($_REQUEST['id']);
		$deal_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where id = ".$id." and is_delete = 0 and (is_effect = 1 or (is_effect = 0 and user_id = ".intval($GLOBALS['user_info']['id'])."))");
		if(!$deal_info)
		{
			app_redirect(url("index"));
		}		
		
		if($deal_info['is_effect']==1)
		{
			log_deal_visit($deal_info['id']);
		}		
		
		$deal_info = cache_deal_extra($deal_info);
		$deal_faq_list = $deal_info['deal_faq_list'];
		$GLOBALS['tmpl']->assign("deal_faq_list",$deal_faq_list);
		
		$log_list = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal_log where deal_id = ".$id." order by create_time desc ");
		foreach($log_list as $k=>$v)
		{
			$log_list[$k]['pass_time'] = pass_date($v['create_time']);
			$online_time = online_date($v['create_time'],$deal_info['begin_time']);
			$log_list[$k]['online_time'] = $online_time['info'];
			if($online_time['key']!=$last_time_key)
			{
				$last_time_key = $log_list[$k]['online_time_key'] = $online_time['key'];				
			}
			
			$log_list[$k] = cache_log_comment($log_list[$k]);
		}
		$GLOBALS['tmpl']->assign("log_list1",$log_list);
		
		init_deal_page($deal_info);		
		
		
		$GLOBALS['tmpl']->display("deal_video.html");
	}
	
	public function update()
	{
		
		$id = intval($_REQUEST['id']);
		$deal_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where id = ".$id." and is_delete = 0 and (is_effect = 1 or (is_effect = 0 and user_id = ".intval($GLOBALS['user_info']['id'])."))");
		if(!$deal_info)
		{
			app_redirect(url("index"));
		}		
		$deal_info = cache_deal_extra($deal_info);
		init_deal_page($deal_info);	

		$page_size = DEALUPDATE_PAGE_SIZE;
		$step_size = DEALUPDATE_STEP_SIZE;
		
		$step = intval($_REQUEST['step']);
		if($step==0)$step = 1;
		$page = intval($_REQUEST['p']);
		if($page==0)$page = 1;		
		$limit = (($page-1)*$page_size+($step-1)*$step_size).",".$step_size	;
		$GLOBALS['tmpl']->assign("current_page",$page);
		
		$log_list = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal_log where deal_id = ".$deal_info['id']." order by create_time desc limit ".$limit);				
		$log_count = $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."deal_log where deal_id = ".$deal_info['id']);
		
		
		if(!$log_list||(($page-1)*$page_size+($step-1)*$step_size)+count($log_list)>=$log_count)
		{
			//最后一页
			$log_list[] = array("deal_id"=>$deal_info['id'],
								"create_time"=>$deal_info['begin_time']+1,
								"id"=>0);
		}
		
		$last_time_key = "";
		foreach($log_list as $k=>$v)
		{
			$log_list[$k]['pass_time'] = pass_date($v['create_time']);
			$online_time = online_date($v['create_time'],$deal_info['begin_time']);
			$log_list[$k]['online_time'] = $online_time['info'];
			if($online_time['key']!=$last_time_key)
			{
				$last_time_key = $log_list[$k]['online_time_key'] = $online_time['key'];				
			}
			
			$log_list[$k] = cache_log_comment($log_list[$k]);
		}
		
		
		$GLOBALS['tmpl']->assign("log_list",$log_list);		
		
		require APP_ROOT_PATH.'app/Lib/page.php';
		$page = new Page($log_count,$page_size);   //初始化分页对象 		
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign('pages',$p);	
		
		
		
		$GLOBALS['tmpl']->display("deal_update.html");
	}
	
	
	public function getupdates()
	{
		
		$id = intval($_REQUEST['id']);
		
		$log_list = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal_log where deal_id = ".$deal_info['id']." order by create_time desc ");				
		$log_count = $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."deal_log where deal_id = ".$deal_info['id']);
		
//		$last_time_key = "";
//		foreach($log_list as $k=>$v)
//		{
//			$log_list[$k]['pass_time'] = pass_date($v['create_time']);
//			$online_time = online_date($v['create_time'],$deal_info['begin_time']);
//			$log_list[$k]['online_time'] = $online_time['info'];
//			if($online_time['key']!=$last_time_key)
//			{
//				$last_time_key = $log_list[$k]['online_time_key'] = $online_time['key'];				
//			}
//			
//			$log_list[$k] = cache_log_comment($log_list[$k]);
//		}
//		
		$GLOBALS['tmpl']->assign("log_list",$log_list);
		$data['html'] = $GLOBALS['tmpl']->fetch("inc/deal_log_list.html");
		
		
		ajax_return($data);
	}
	
	
	public function updatedetail()
	{
		
		$id = intval($_REQUEST['id']);
		$update_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal_log where id = ".$id);
		$deal_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where id = ".intval($update_info['deal_id'])." and is_delete = 0 and (is_effect = 1 or (is_effect = 0 and user_id = ".intval($GLOBALS['user_info']['id'])."))");
		if(!$deal_info)
		{
			app_redirect(url("index"));
		}		
		$deal_info = cache_deal_extra($deal_info);
		init_deal_page($deal_info);	
		
		$log_list = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal_log where id = ".$id);				
		
		foreach($log_list as $k=>$v)
		{
			$log_list[$k]['pass_time'] = pass_date($v['create_time']);
			$online_time = online_date($v['create_time'],$deal_info['begin_time']);
			$log_list[$k]['online_time'] = $online_time['info'];
			if($online_time['key']!=$last_time_key)
			{
				$last_time_key = $log_list[$k]['online_time_key'] = $online_time['key'];				
			}
			
			
			$log_list[$k]['comment_count'] = $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."deal_comment where log_id = ".$v['id']." and deal_id = ".$deal_info['id']);
			
			$page_size = DEAL_COMMENT_PAGE_SIZE;
			$page = intval($_REQUEST['p']);
			if($page==0)$page = 1;		
			$limit = (($page-1)*$page_size).",".$page_size;
			$log_list[$k]['comment_list'] = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal_comment where log_id = ".$v['id']." and deal_id = ".$deal_info['id']." order by create_time desc limit ".$limit);

			require APP_ROOT_PATH.'app/Lib/page.php';
			$page = new Page($log_list[$k]['comment_count'],$page_size);   //初始化分页对象 		
			$p  =  $page->show();
			$GLOBALS['tmpl']->assign('pages',$p);	
		}
		
		
		$GLOBALS['tmpl']->assign("log_list",$log_list);			
		$GLOBALS['tmpl']->display("deal_updatedetail.html");
	}
	
	
	public function add_update()
	{
		if(!$GLOBALS['user_info'])
		{
			$data['html'] = $GLOBALS['tmpl']->display("inc/user_login_box.html","",true);			
			$data['status'] = 2;
		}
		else
		{
			$id = intval($_REQUEST['id']);
			$deal_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where id = ".$id." and is_delete = 0 and is_effect = 1 and user_id = ".intval($GLOBALS['user_info']['id']));
			if(!$deal_info)
			{
				showErr("不能更新该项目的动态",1);
			}
			else
			{
				$GLOBALS['tmpl']->assign("deal_info",$deal_info);
				$data['html'] = $GLOBALS['tmpl']->fetch("inc/add_update.html");			
				$data['status'] = 1;
			}
		}
		ajax_return($data);
	}
	
	public function save_update()
	{
		$ajax = intval($_REQUEST['ajax']);
		if(!$GLOBALS['user_info'])
		{
			showErr("",$ajax,url("user#login"));
		}

	
		$id = intval($_REQUEST['id']);
		$deal_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where id = ".$id." and is_delete = 0 and is_effect = 1 and user_id = ".intval($GLOBALS['user_info']['id']));
		if(!$deal_info)
		{
			showErr("不能更新该项目的动态",$ajax);
		}
		else
		{
			$data['log_title'] = strim($_REQUEST['log_title']);
			if($data['log_title']=="")
			{
				showErr("请输入更新的标题",$ajax,"");
			}
			$data['log_info'] = strim($_REQUEST['log_info']);
			if($data['log_info']=="")
			{
				showErr("请输入更新的内容",$ajax,"");
			}
			$data['image'] = strim($_REQUEST['image'])!=""?replace_public($_REQUEST['image']):"";
			$data['vedio'] = strim($_REQUEST['vedio']);
			if($data['vedio']!="")
			{
				require_once APP_ROOT_PATH."system/utils/vedio.php";
				$vedio = fetch_vedio_url($_REQUEST['vedio']);		
				if($vedio!="")
				{
					$data['source_vedio'] =  $vedio;
				}
				else
				{
					showErr("非法的视频地址",$ajax,"");
				}
			}
			$data['user_id'] = intval($GLOBALS['user_info']['id']);
			$data['deal_id'] = $id;
			$data['create_time'] = NOW_TIME;
			$data['user_name'] = $GLOBALS['user_info']['user_name'];
			$GLOBALS['db']->autoExecute(DB_PREFIX."deal_log",$data);
			$GLOBALS['db']->query("update ".DB_PREFIX."deal set log_count = log_count + 1 where id = ".$deal_info['id']);
			showSuccess("",$ajax,url("deal#show",array("id"=>$deal_info['id'])));
		}
	}
	
	public function delcomment()
	{
		$ajax = intval($_REQUEST['ajax']);
		if(!$GLOBALS['user_info'])
		{
			showErr("",$ajax,url("user#login"));
		}
		$comment_id = intval($_REQUEST['id']);
		$comment_item = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal_comment where id = ".$comment_id." and user_id = ".intval($GLOBALS['user_info']['id']));
		if($comment_item)
		{
			$GLOBALS['db']->query("delete from ".DB_PREFIX."deal_comment where id = ".$comment_id." and user_id = ".intval($GLOBALS['user_info']['id']));
			if($comment_item['log_id']==0)
			$GLOBALS['db']->query("update ".DB_PREFIX."deal set comment_count = comment_count - 1 where id = ".$comment_item['deal_id']);
			if($ajax==1)
			{
				if($GLOBALS['db']->affected_rows()>0)
				{
					$data['status'] = 1;
					$data['logid'] = $comment_item['log_id'];
					$data['counthtml'] = "评论(".$GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."deal_comment where log_id = ".$comment_item['log_id']).")";
					ajax_return($data);
				}
				else
				{
					showErr("删除失败",$ajax);
				}
			}
			else
			{
				showSuccess("记录删除成功");
			}
		}
		else
		{
			showErr("您无权删除该记录",$ajax);
		}
	}
	
	public function save_comment()
	{
		$ajax = intval($_REQUEST['ajax']);
		if(!$GLOBALS['user_info'])
		{
			showErr("",$ajax,url("user#login"));
		}
		
		$comment['deal_id'] = intval($_REQUEST['deal_id']);
		$deal_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where id = ".$comment['deal_id']." and is_delete = 0 and is_effect = 1 ");
		if(!$deal_info)
		{
			showErr("该项目暂时不能评论",$ajax);
		}
		
		if(!check_ipop_limit(get_client_ip(),"deal_save_comment",3))
		showErr("提交太快",$ajax);	
		
		$comment['content'] = strim($_REQUEST['content']);
		$comment['user_id'] = intval($GLOBALS['user_info']['id']);
		$comment['create_time'] =  NOW_TIME;
		$comment['log_id'] = intval($_REQUEST['log_id']);
		$comment['user_name'] = $GLOBALS['user_info']['user_name'];
		$comment['pid'] = intval($_REQUEST['pid']);
		$comment['deal_user_id'] = intval($GLOBALS['db']->getOne("select user_id from ".DB_PREFIX."deal where id = ".$comment['deal_id']));
		$comment['reply_user_id'] = intval($GLOBALS['db']->getOne("select user_id from ".DB_PREFIX."deal_comment where id = ".$comment['pid']));		
		$comment['deal_user_name'] = $GLOBALS['db']->getOne("select user_name from ".DB_PREFIX."user where id = ".intval($comment['deal_user_id']));
		$comment['reply_user_name'] = $GLOBALS['db']->getOne("select user_name from ".DB_PREFIX."user where id = ".intval($comment['reply_user_id']));
		$GLOBALS['db']->autoExecute(DB_PREFIX."deal_comment",$comment);
		$comment['id'] = $GLOBALS['db']->insert_id();		
		
		if(intval($_REQUEST['syn_weibo'])==1)
		{
			$weibo_info = array();
			$weibo_info['content'] = $comment['content']." ".get_domain().url("deal#show",array("id"=>$comment['deal_id']));
			$img = $GLOBALS['db']->getOne("select image from ".DB_PREFIX."deal where id = ".intval($comment['deal_id']));
			if($img)$weibo_info['img'] = APP_ROOT_PATH."/".$img;
			syn_weibo($weibo_info);
		}
		
		$GLOBALS['db']->query("update ".DB_PREFIX."deal_log set comment_data_cache = '' where id = ".intval($_REQUEST['log_id']));
		
		if($ajax==1)
		{
			$data['status'] = 1;
			$GLOBALS['tmpl']->assign("comment_item",$comment);
			$data['html'] = $GLOBALS['tmpl']->fetch("inc/comment_item.html");
			$data['counthtml'] = "评论(".$GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."deal_comment where log_id = ".$comment['log_id']).")";
			ajax_return($data);
		}
		else
		{
			showSuccess("发表成功");
		}
	}
	
	public function submitcomment()
	{
		$ajax = intval($_REQUEST['ajax']);
		if(!$GLOBALS['user_info'])
		{
			showErr("",$ajax,url("user#login"));
		}
		$deal_id = intval($_REQUEST['id']);
		$deal_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where id = ".$deal_id." and is_delete = 0 and is_effect = 1 ");
		if(!$deal_info)
		{
			showErr("该项目暂时不能评论",$ajax);
		}
		
		if(!check_ipop_limit(get_client_ip(),"deal_submitcomment",3))
		showErr("提交太快",$ajax);	
		
		$comment['deal_id'] = $deal_id;

		$comment['content'] = strim($_REQUEST['content']);
		$comment['user_id'] = intval($GLOBALS['user_info']['id']);
		$comment['create_time'] =  NOW_TIME;
		$comment['log_id'] = intval($_REQUEST['log_id']);
		$comment['user_name'] = $GLOBALS['user_info']['user_name'];
		$comment['pid'] = intval($_REQUEST['pid']);
		$comment['deal_user_id'] = intval($GLOBALS['db']->getOne("select user_id from ".DB_PREFIX."deal where id = ".$comment['deal_id']));
		$comment['reply_user_id'] = intval($GLOBALS['db']->getOne("select user_id from ".DB_PREFIX."deal_comment where id = ".$comment['pid']));		
		$comment['deal_user_name'] = $GLOBALS['db']->getOne("select user_name from ".DB_PREFIX."user where id = ".intval($comment['deal_user_id']));
		$comment['reply_user_name'] = $GLOBALS['db']->getOne("select user_name from ".DB_PREFIX."user where id = ".intval($comment['reply_user_id']));

		$GLOBALS['db']->autoExecute(DB_PREFIX."deal_comment",$comment);
		$data['status'] = 1;
		ajax_return($data);
	}
	
	public function getcomments()
	{
		$deal_id = intval($_REQUEST['id']);
		$page_size = DEAL_COMMENT_PAGE_SIZE;
		$page = intval($_REQUEST['p']);
		if($page==0)$page = 1;		
		$limit = (($page-1)*$page_size).",".$page_size;

		$comment_list = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal_comment where deal_id = ".$deal_id." and log_id = 0 order by create_time desc limit ".$limit);
		$comment_count = $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."deal_comment where deal_id = ".$deal_id." and log_id = 0");

		$GLOBALS['tmpl']->assign("comment_list",$comment_list);
		
		require APP_ROOT_PATH.'app/Lib/page_ajax.php';
		$page = new PageAjax($comment_count,$page_size);   //初始化分页对象 	
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign('pages',$p);
		
		$data['html'] = $GLOBALS['tmpl']->fetch("inc/comment_items.html");
		
		$data['status'] = 1;
		ajax_return($data);
	}
	
	public function getsupports()
	{
		$id = intval($_REQUEST['id']);
		$deal_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where id = ".$id." and is_delete = 0 and (is_effect = 1 or (is_effect = 0 and user_id = ".intval($GLOBALS['user_info']['id'])."))");
		if(!$deal_info)
		{
			app_redirect(url("index"));
		}		
		$deal_info = cache_deal_extra($deal_info);
		init_deal_page($deal_info);		
		
		$page_size = DEAL_SUPPORT_PAGE_SIZE;
		$page = intval($_REQUEST['p']);
		if($page==0)$page = 1;		
		$limit = (($page-1)*$page_size).",".$page_size	;

		$sql="SELECT ".DB_PREFIX."deal_support_log.id, "
		.DB_PREFIX."deal_support_log.deal_id, "
		.DB_PREFIX."deal_support_log.user_id, "
		.DB_PREFIX."deal_support_log.create_time, "
		.DB_PREFIX."deal_support_log.price, "
		.DB_PREFIX."deal_support_log.deal_item_id, "
		.DB_PREFIX."deal_item.price as support_price, "
		.DB_PREFIX."deal_item.support_count, "
		.DB_PREFIX."deal_item.support_amount, "
		.DB_PREFIX."deal_item.description, "
		.DB_PREFIX."deal_item.is_delivery,"
		.DB_PREFIX."deal_item.delivery_fee,"
		.DB_PREFIX."deal_item.is_limit_user,"
		.DB_PREFIX."deal_item.limit_user,"
		.DB_PREFIX."deal_item.repaid_day FROM "
		.DB_PREFIX."deal_support_log left join ".DB_PREFIX."deal_item on ".DB_PREFIX."deal_support_log.deal_item_id = ".DB_PREFIX."deal_item.id where ".DB_PREFIX."deal_support_log.deal_id = ".$id." order by ".DB_PREFIX."deal_support_log.create_time desc limit ".$limit;
		
		$support_list = $GLOBALS['db']->getAll($sql);
		
		$support_count = $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."deal_support_log where deal_id = ".$id);
		
		$user_list = array();
		foreach($support_list as $k=>$v)
		{
			if($user_list[$v['user_id']])
			{
				$support_list[$k]['user_info'] = $user_list[$v['user_id']];
			}
			else
			{
				$support_list[$k]['user_info'] = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."user where id = ".$v['user_id']);
				$user_list[$v['user_id']] = $support_list[$k]['user_info'];
			}
			$support_list[$k]['images'] = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal_item_image where deal_item_id = ".$v['deal_item_id']);
			$support_list[$k]['price_format'] = number_price_format($v['price']);
		}
		$GLOBALS['tmpl']->assign("support_list",$support_list);
		
		require APP_ROOT_PATH.'app/Lib/page_ajax.php';
		$page = new PageAjax($support_count,$page_size);   //初始化分页对象 		
		$p  =  $page->show();
		$GLOBALS['tmpl']->assign('support_pages',$p);	
		$data['html']=$GLOBALS['tmpl']->fetch("inc/deal_ic_supports.html");
		
		ajax_return($data);
	}
	
	public function savedealcomment()
	{
		$ajax = intval($_REQUEST['ajax']);
		if(!$GLOBALS['user_info'])
		{
			showErr("",$ajax,url("user#login"));
		}
		
		$comment['deal_id'] = intval($_REQUEST['id']);
		$deal_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where id = ".$comment['deal_id']." and is_delete = 0 and is_effect = 1 ");
		if(!$deal_info)
		{
			showErr("该项目暂时不能评论",$ajax);
		}
		
		if(!check_ipop_limit(get_client_ip(),"deal_savedealcomment",3))
		showErr("提交太快",$ajax);	
		
		$comment['content'] = strim($_REQUEST['content']);
		$comment['user_id'] = intval($GLOBALS['user_info']['id']);
		$comment['create_time'] =  NOW_TIME;
		$comment['user_name'] = $GLOBALS['user_info']['user_name'];
		$comment['pid'] = intval($_REQUEST['pid']);
		$comment['deal_user_id'] = intval($GLOBALS['db']->getOne("select user_id from ".DB_PREFIX."deal where id = ".$comment['deal_id']));
		$comment['reply_user_id'] = intval($GLOBALS['db']->getOne("select user_id from ".DB_PREFIX."deal_comment where id = ".$comment['pid']));		
		$comment['deal_user_name'] = $GLOBALS['db']->getOne("select user_name from ".DB_PREFIX."user where id = ".intval($comment['deal_user_id']));
		$comment['reply_user_name'] = $GLOBALS['db']->getOne("select user_name from ".DB_PREFIX."user where id = ".intval($comment['reply_user_id']));
		$GLOBALS['db']->autoExecute(DB_PREFIX."deal_comment",$comment);
		$comment['id'] = $GLOBALS['db']->insert_id();		
		
		$GLOBALS['db']->query("update ".DB_PREFIX."deal set comment_count = comment_count+1 where id = ".$comment['deal_id']);
		
		if(intval($_REQUEST['syn_weibo'])==1)
		{
			$weibo_info = array();
			$weibo_info['content'] = $comment['content']." ".get_domain().url("deal#show",array("id"=>$comment['deal_id']));
			$img = $GLOBALS['db']->getOne("select image from ".DB_PREFIX."deal where id = ".intval($comment['deal_id']));
			if($img)$weibo_info['img'] = APP_ROOT_PATH."/".$img;
			syn_weibo($weibo_info);
		}
		
		if($ajax==1)
		{
			$data['status'] = 1;
			ajax_return($data);
		}
		else
		{
			showSuccess("发表成功");
		}
	}
}
?>