<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------


class projectModule extends BaseModule
{
	public function add()
	{			
		if(!$GLOBALS['user_info'])
		app_redirect(url("user#login"));
			
		$GLOBALS['tmpl']->assign("page_title","发起项目");
		$id = intval($_REQUEST['id']);
		
	 	$url = bef_project($id,intval($GLOBALS['user_info']['id']));
	 		
	 	app_redirect(url($url));
	}
	
	public function edit()
	{			
		if(!$GLOBALS['user_info'])
		app_redirect(url("user#login"));
		
		$id = intval($_REQUEST['id']);
		$deal_item = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where id = ".$id." and is_effect = 0 and is_delete = 0 and user_id = ".intval($GLOBALS['user_info']['id']));
		if($deal_item)
		{
			$GLOBALS['tmpl']->assign("page_title",$deal_item['name']);
			$GLOBALS['tmpl']->assign("deal",$deal_item);
			
			$GLOBALS['tmpl']->display("project_edit.html");
		}	
		else
		{
			app_redirect_preview();
		}		
		
	}
	
	
	public function edit1()
	{			
		if(!$GLOBALS['user_info'])
		app_redirect(url("user#login"));
		
		$id = intval($_REQUEST['id']);
		$deal_item = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where id = ".$id." and is_effect = 0 and is_delete = 0 and user_id = ".intval($GLOBALS['user_info']['id']));
		if($deal_item)
		{
			
			$GLOBALS['tmpl']->assign("page_title",$deal_item['name']);
			
			
			$region_pid = 0;
			$region_lv2 = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."region_conf where region_level = 2 order by py asc");  //二级地址
			foreach($region_lv2 as $k=>$v)
			{
				if($v['name'] == $deal_item['province'])
				{
					$region_lv2[$k]['selected'] = 1;
					$region_pid = $region_lv2[$k]['id'];
					break;
				}
			}
			$GLOBALS['tmpl']->assign("region_lv2",$region_lv2);
			
			
			if($region_pid>0)
			{
				$region_lv3 = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."region_conf where pid = ".$region_pid." order by py asc");  //三级地址
				foreach($region_lv3 as $k=>$v)
				{
					if($v['name'] == $deal_item['city'])
					{
						$region_lv3[$k]['selected'] = 1;
						break;
					}
				}
				$GLOBALS['tmpl']->assign("region_lv3",$region_lv3);
			}
			
			$deal_item['faq_list'] = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal_faq where deal_id = ".$deal_item['id']." order by sort asc");
			$cate_list = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal_cate order by sort asc");
			$GLOBALS['tmpl']->assign("cate_list",$cate_list);
			$GLOBALS['tmpl']->assign("deal_item",$deal_item);
			
			$GLOBALS['tmpl']->display("project_edit1.html");
		}	
		else
		{
			app_redirect_preview();
		}		
		
	}
	
	
	public function save()
	{
		$ajax = intval($_REQUEST['ajax']);
		if(!check_ipop_limit(get_client_ip(),"project_save",5))
		showErr("提交太频繁",$ajax,"");	
			
		if(!$GLOBALS['user_info'])
		{
			showErr("",$ajax,url("user#login"));
		}
		$id =  intval($_REQUEST['id']);
		$is_edit = $GLOBALS['db']->getOne("select is_edit from ".DB_PREFIX."deal where id = ".$id);
		if($id>0&&!$is_edit)
		{
			showErr("项目已提交，不能更改",$ajax,"");
		}
		
		$data['name'] = strim($_REQUEST['name']);
		if($data['name']=="")
		{
			showErr("请填写项目名称",$ajax,"");
		}
		if(msubstr($data['name'],0,50)!=$data['name'])
		{			
			showErr("项目名称不超过50个字",$ajax,"");
		}
		
		$data['cate_id'] = intval($_REQUEST['cate_id']);
		if($data['cate_id']==0)
		{
			showErr("请选择项目分类",$ajax,"");
		}
		
		$data['brief'] = strim($_REQUEST['brief']);
		if(replace_public(addslashes(trim($_REQUEST['image'])))!="")
		{
			$data['image'] = replace_public(addslashes(trim($_REQUEST['image'])));
		}
		
		require_once APP_ROOT_PATH."system/libs/words.php";	
		$data['tags'] = implode(" ",words::segment($data['name']));


		//$data['description'] = replace_public(addslashes(trim(valid_tag($_REQUEST['description']))));	
	
		$data['vedio'] = strim($_REQUEST['vedio']);
		
		if($data['vedio']!="")
		{
			require_once APP_ROOT_PATH."system/utils/vedio.php";
			$vedio = fetch_vedio_url($data['vedio']);		
			if($vedio!="")
			{
				$data['source_vedio'] =  $vedio;
			}
			else
			{
				showErr("非法的视频地址",$ajax,"");
			}
		}
		
		$data['limit_price'] = doubleval($_REQUEST['limit_price']);
		if($data['limit_price']<=0)
		{
			showErr("请输入正确的目标金额",$ajax,"");
		}
		$data['deal_days'] = doubleval($_REQUEST['deal_days']);
		if($data['deal_days']<=0)
		{
			showErr("请输入正确的上线天数",$ajax,"");
		}
		$data['is_edit'] = 1;
		
		$savenext = intval($_REQUEST['savenext']);
		$GLOBALS['db']->autoExecute(DB_PREFIX."deal",$data,"UPDATE","id=".$id,"SILENT");
		
		//追加faq
		$GLOBALS['db']->query("delete from ".DB_PREFIX."deal_faq where deal_id = ".$id);
		$sort = 1;
		foreach($_REQUEST['question'] as $kk=>$question_item)
		{
			if(strim($_REQUEST['question'][$kk])!=""&&strim($_REQUEST['answer'][$kk])!=""&&strim($_REQUEST['question'][$kk])!="请输入问题"&&strim($_REQUEST['answer'][$kk])!="请输入答案")
			{
				$faq_item['deal_id'] = $id;
				$faq_item['question'] = strim($_REQUEST['question'][$kk]);
				$faq_item['answer'] = strim($_REQUEST['answer'][$kk]);
				$faq_item['sort'] = $sort;
				$GLOBALS['db']->autoExecute(DB_PREFIX."deal_faq",$faq_item);
				$sort++;
			}
		}
		$GLOBALS['db']->query("update ".DB_PREFIX."deal set deal_extra_cache = '' where id = ".$id);
		if($savenext==0)
		{
			showSuccess($id,$ajax,"");
		}
		else
		{
			showSuccess("",$ajax,url("project#add_jieshao",array("id"=>$id)));
		}	
		
	}
	
	

	public function save1()
	{
		$ajax = intval($_REQUEST['ajax']);
		if(!check_ipop_limit(get_client_ip(),"project_save",5))
		showErr("提交太频繁",$ajax,"");	
			
		if(!$GLOBALS['user_info'])
		{
			showErr("",$ajax,url("user#login"));
		}
		$id =  intval($_REQUEST['id']);
		$is_edit = $GLOBALS['db']->getOne("select is_edit from ".DB_PREFIX."deal where id = ".$id);
		if($id>0&&!$is_edit)
		{
			showErr("项目已提交，不能更改",$ajax,"");
		}
		
		$data['name'] = strim($_REQUEST['name']);
		if($data['name']=="")
		{
			showErr("请填写项目名称",$ajax,"");
		}
		if(msubstr($data['name'],0,50)!=$data['name'])
		{			
			showErr("项目名称不超过50个字",$ajax,"");
		}
		
		$data['cate_id'] = intval($_REQUEST['cate_id']);
		if($data['cate_id']==0)
		{
			showErr("请选择项目分类",$ajax,"");
		}
		
		$data['brief'] = strim($_REQUEST['brief']);
		if(replace_public(addslashes(trim($_REQUEST['image'])))=="")
		{
			showErr("请选择封面图片",$ajax,"");
		}
		$data['image'] = replace_public(addslashes(trim($_REQUEST['image'])));
		
		require_once APP_ROOT_PATH."system/libs/words.php";	
		$data['tags'] = implode(" ",words::segment($data['name']));
	
		$data['vedio'] = strim($_REQUEST['vedio']);
		
		if($data['vedio']!="")
		{
			require_once APP_ROOT_PATH."system/utils/vedio.php";
			$vedio = fetch_vedio_url($data['vedio']);		
			if($vedio!="")
			{
				$data['source_vedio'] =  $vedio;
			}
			else
			{
				showErr("非法的视频地址",$ajax,"");
			}
		}
		
		$data['limit_price'] = doubleval($_REQUEST['limit_price']);
		if($data['limit_price']<=0)
		{
			showErr("请输入正确的目标金额",$ajax,"");
		}
		$data['deal_days'] = doubleval($_REQUEST['deal_days']);
		if($data['deal_days']<=0)
		{
			showErr("请输入正确的上线天数",$ajax,"");
		}
		$data['is_edit'] = 1;
		
		
		$data['user_id'] = intval($GLOBALS['user_info']['id']);
		$data['user_name'] = $GLOBALS['user_info']['user_name'];
		$data['create_time'] = NOW_TIME;
		$savenext = intval($_REQUEST['savenext']);
		$GLOBALS['db']->autoExecute(DB_PREFIX."deal",$data,"INSERT","","SILENT");
		$data_id = intval($GLOBALS['db']->insert_id());
		if($data_id==0)
		{
			showErr("保存失败，请联系管理员",$ajax,"");
		}
		else
		{
			es_session::delete("deal_image");
			
			//追加faq
			$sort = 1;
			foreach($_REQUEST['question'] as $kk=>$question_item)
			{
				if(strim($_REQUEST['question'][$kk])!=""&&strim($_REQUEST['answer'][$kk])!=""&&strim($_REQUEST['question'][$kk])!="请输入问题"&&strim($_REQUEST['answer'][$kk])!="请输入答案")
				{
					$faq_item['deal_id'] = $data_id;
					$faq_item['question'] = strim($_REQUEST['question'][$kk]);
					$faq_item['answer'] = strim($_REQUEST['answer'][$kk]);
					$faq_item['sort'] = $sort;
					$GLOBALS['db']->autoExecute(DB_PREFIX."deal_faq",$faq_item);
					$sort++;
				}
			}
			if($savenext==0)
			{
				showSuccess($data_id,$ajax,"");
			}
			else
			{
				showSuccess("",$ajax,url("project#add_jieshao",array("id"=>$data_id)));
			}
		}	
	}
	
	public function saveXx()
    {
    	$ajax = intval($_REQUEST['ajax']);
		if(!check_ipop_limit(get_client_ip(),"project_saveXx",5))
		showErr("提交太频繁",$ajax,"");
		
		if(!$GLOBALS['user_info'])
		{
			showErr("",$ajax,url("user#login"));
		}
        $id =  intval($_REQUEST['id']);
        $savenext = intval($_REQUEST['savenext']);

        $data['description']      = strim($_REQUEST['descrip']);
        $data['xmdo']           = strim($_REQUEST['xmdo']);
        $data['xmld']           = strim($_REQUEST['xmld']);
		
        //$GLOBALS['db']->query("update ".DB_PREFIX."deal set description = '".$data['description']."',xmdo='".$data['xmdo']."',xmld='".$data['xmld']."' where id = ".$id);
        
        $GLOBALS['db']->autoExecute(DB_PREFIX."deal",$data,"UPDATE","id=".$id);
        if($GLOBALS['db']->affected_rows()<1)
        {
             showErr("保存失败，请联系管理员",$ajax,"");
        }else{
        	 if($savenext==0) showSuccess($id,$ajax,"");
             showSuccess("",$ajax,url("project#zhixing",array("id"=>$id)));
        }
    }
    public function zhixing()
    {
    	if(!$GLOBALS['user_info'])
		app_redirect(url("user#login"));			
		
		
		$id = intval($_REQUEST['id']);
		$deal = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where is_effect = 0 and is_delete = 0 and id = ".$id." and user_id = ".intval($GLOBALS['user_info']['id']));
		if($deal)
		{
			$GLOBALS['tmpl']->assign("deal",$deal);
			$GLOBALS['tmpl']->display("project_add_zhixing.html");
		}
		else
		{
			app_redirect_preview();
		}
    }
    
    
    
    public function add_jieshao()
	{
		if(!$GLOBALS['user_info'])
		app_redirect(url("user#login"));			
		
		
		$id = intval($_REQUEST['id']);
		$deal = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where is_effect = 0 and is_delete = 0 and id = ".$id." and user_id = ".intval($GLOBALS['user_info']['id']));
		if($deal)
		{
			$GLOBALS['tmpl']->assign("deal",$deal);
			$GLOBALS['tmpl']->display("project_add_jieshao.html");
		}
		else
		{
			app_redirect_preview();
		}
    }
    
    public function add_easy()
    {
    	if(!$GLOBALS['user_info'])
			app_redirect(url("user#login"));			
		
		
		$id = intval($_REQUEST['id']);
		
		
		$deal = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where is_effect = 0 and is_delete = 0 and id = ".$id." and user_id = ".intval($GLOBALS['user_info']['id']));
		
		
		if($deal)
		{
			$GLOBALS['tmpl']->assign("deal",$deal);
		}
		
    	$GLOBALS['tmpl']->display("project_add_easy.html");
    }
    
    
    public function saveEasy()
    {
    	$ajax = intval($_REQUEST['ajax']);
		if(!check_ipop_limit(get_client_ip(),"project_save",5))
		showErr("提交太频繁",$ajax,"");	
			
		if(!$GLOBALS['user_info'])
		{
			showErr("",$ajax,url("user#login"));
		}
		$id =  intval($_REQUEST['id']);
		if($id > 0){
			$is_edit = $GLOBALS['db']->getOne("select is_edit from ".DB_PREFIX."deal where id = ".$id);
			if($id>0&&!$is_edit)
			{
				showErr("项目已提交，不能更改",$ajax,"");
			}
			$data['brief'] = replace_public(addslashes(trim($_REQUEST['brief'])));
			$data['id'] = $id;
			
			$savenext = intval($_REQUEST['savenext']);
			$GLOBALS['db']->autoExecute(DB_PREFIX."deal",$data,"UPDATE","id=".$id,"SILENT");
			
			if($savenext==0)
			{
				showSuccess($id,$ajax,"");
			}
			else
			{
				showSuccess("",$ajax,url("project#add_explain",array("id"=>$id)));
			}
		}
		else
		{
			$data['brief'] = replace_public(addslashes(trim($_REQUEST['brief'])));
			$data['is_edit'] = 1;
			$data['user_id'] = intval($GLOBALS['user_info']['id']);
			$data['user_name'] = $GLOBALS['user_info']['user_name'];
			$data['create_time'] = NOW_TIME;
			$savenext = intval($_REQUEST['savenext']);
			$GLOBALS['db']->autoExecute(DB_PREFIX."deal",$data,"INSERT","","SILENT");
			$data_id = intval($GLOBALS['db']->insert_id());
			if($data_id==0)
			{
				showErr("保存失败，请联系管理员",$ajax,"");
			}
			else
			{
				es_session::delete("deal_image");
				
				if($savenext==0)
				{
					showSuccess($data_id,$ajax,"");
				}
				else
				{
					showSuccess("",$ajax,url("project#add_explain",array("id"=>$data_id)));
				}
			}	
		}
    }
    
    
    public function add_explain()
    {
    	if(!$GLOBALS['user_info'])
		app_redirect(url("user#login"));			
		
		
		$id = intval($_REQUEST['id']);
		$deal = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where is_effect = 0 and is_delete = 0 and id = ".$id." and user_id = ".intval($GLOBALS['user_info']['id']));
		if($deal)
		{
			$GLOBALS['tmpl']->assign("deal",$deal);
			$GLOBALS['tmpl']->display("project_add_explain.html");
		}
		else
		{
			app_redirect_preview();
		}
    }
    
	public function saveExplain()
    {
    	$ajax = intval($_REQUEST['ajax']);
		if(!check_ipop_limit(get_client_ip(),"project_saveExplain",5))
		showErr("提交太频繁",$ajax,"");
		
		if(!$GLOBALS['user_info'])
		{
			showErr("",$ajax,url("user#login"));
		}
        $id =  intval($_REQUEST['id']);
        $savenext = intval($_REQUEST['savenext']);

        $data['description']    = replace_public(addslashes(trim($_REQUEST['descrip'])));
        $data['xmdo']           = replace_public(addslashes(trim($_REQUEST['xmdo'])));
        $data['xmld']           = replace_public(addslashes(trim($_REQUEST['xmld'])));
		
        $GLOBALS['db']->autoExecute(DB_PREFIX."deal",$data,"UPDATE","id=".$id);
        if($GLOBALS['db']->affected_rows()<1)
        {
             showErr("保存失败，请联系管理员",$ajax,"");
        }else{
        	 if($savenext==0) showSuccess($id,$ajax,"");
             showSuccess("",$ajax,url("project#zhixing",array("id"=>$id)));
        }
    }
    
    public function add_info()
    {
    	
    	if(!$GLOBALS['user_info'])
		app_redirect(url("user#login"));
		
		$id = intval($_REQUEST['id']);
		$deal_item = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where id = ".$id." and is_effect = 0 and is_delete = 0 and user_id = ".intval($GLOBALS['user_info']['id']));
		if($deal_item)
		{
			$GLOBALS['tmpl']->assign("page_title",$deal_item['name']);
			
			
			$region_pid = 0;
			$region_lv2 = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."region_conf where region_level = 2 order by py asc");  //二级地址
			foreach($region_lv2 as $k=>$v)
			{
				if($v['name'] == $deal_item['province'])
				{
					$region_lv2[$k]['selected'] = 1;
					$region_pid = $region_lv2[$k]['id'];
					break;
				}
			}
			$GLOBALS['tmpl']->assign("region_lv2",$region_lv2);
			
			
			if($region_pid>0)
			{
				$region_lv3 = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."region_conf where pid = ".$region_pid." order by py asc");  //三级地址
				foreach($region_lv3 as $k=>$v)
				{
					if($v['name'] == $deal_item['city'])
					{
						$region_lv3[$k]['selected'] = 1;
						break;
					}
				}
				$GLOBALS['tmpl']->assign("region_lv3",$region_lv3);
			}
			
			$deal_item['faq_list'] = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal_faq where deal_id = ".$deal_item['id']." order by sort asc");
			$cate_list = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal_cate order by sort asc");
			$GLOBALS['tmpl']->assign("cate_list",$cate_list);
			$GLOBALS['tmpl']->assign("deal",$deal_item);
			
			$GLOBALS['tmpl']->display("project_add_info.html");
		}	
		else
		{
			app_redirect_preview();
		}	
		
//    	if(!$GLOBALS['user_info'])
//			app_redirect(url("user#login"));			
//		
//		
//		$id = intval($_REQUEST['id']);
//		$deal = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where is_effect = 0 and is_delete = 0 and id = ".$id." and user_id = ".intval($GLOBALS['user_info']['id']));
//		if($deal)
//		{
//			$region_lv2 = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."region_conf where region_level = 2 order by py asc");  //二级地址
//			$GLOBALS['tmpl']->assign("region_lv2",$region_lv2);
//		
//			$cate_list = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal_cate order by sort asc");
//			$GLOBALS['tmpl']->assign("cate_list",$cate_list);
//			
//			$deal_image =  es_session::get("deal_image");
//			$GLOBALS['tmpl']->assign("deal_image",$deal_image);
//			
//			$GLOBALS['tmpl']->assign("deal",$deal);
//			$GLOBALS['tmpl']->display("project_add_info.html");
//		}
//		else
//		{
//			app_redirect_preview();
//		}
    }
    
    public function saveInfo()
    {
    	$ajax = intval($_REQUEST['ajax']);
		if(!check_ipop_limit(get_client_ip(),"project_saveInfo",5))
		showErr("提交太频繁",$ajax,"");	
			
		if(!$GLOBALS['user_info'])
		{
			showErr("",$ajax,url("user#login"));
		}
		$id =  intval($_REQUEST['id']);
		$deal = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where is_effect = 0 and is_delete = 0 and id = ".$id." and user_id = ".intval($GLOBALS['user_info']['id']));
		if($deal)
		{
			$is_edit = $GLOBALS['db']->getOne("select is_edit from ".DB_PREFIX."deal where id = ".$id);
			if($id>0&&!$is_edit)
			{
				showErr("项目已提交，不能更改",$ajax,"");
			}
			
			$data['name'] = strim($_REQUEST['name']);
			if($data['name']=="")
			{
				showErr("请填写项目名称",$ajax,"");
			}
			if(msubstr($data['name'],0,50)!=$data['name'])
			{			
				showErr("项目名称不超过50个字",$ajax,"");
			}
			
			$data['cate_id'] = intval($_REQUEST['cate_id']);
			if($data['cate_id']==0)
			{
				showErr("请选择项目分类",$ajax,"");
			}
	//		$data['brief'] = strim($_REQUEST['brief']);
			if(replace_public(addslashes(trim($_REQUEST['image'])))=="")
			{
				showErr("请选择封面图片",$ajax,"");
			}
			$data['image'] = replace_public(addslashes(trim($_REQUEST['image'])));
			
			require_once APP_ROOT_PATH."system/libs/words.php";	
			$data['tags'] = implode(" ",words::segment($data['name']));
		
			$data['vedio'] = strim($_REQUEST['vedio']);
			
			if($data['vedio']!="")
			{
				require_once APP_ROOT_PATH."system/utils/vedio.php";
				$vedio = fetch_vedio_url($data['vedio']);		
				if($vedio!="")
				{
					$data['source_vedio'] =  $vedio;
				}
				else
				{
					showErr("非法的视频地址",$ajax,"");
				}
			}
			
			$data['limit_price'] = doubleval($_REQUEST['limit_price']);
			if($data['limit_price']<=0)
			{
				showErr("请输入正确的目标金额",$ajax,"");
			}
			$data['deal_days'] = doubleval($_REQUEST['deal_days']);
			if($data['deal_days']<=0)
			{
				showErr("请输入正确的上线天数",$ajax,"");
			}
			$data['is_edit'] = 1;
			
			
			$data['user_id'] = intval($GLOBALS['user_info']['id']);
			$data['user_name'] = $GLOBALS['user_info']['user_name'];
			$data['create_time'] = NOW_TIME;
			$savenext = intval($_REQUEST['savenext']);
			//$GLOBALS['db']->autoExecute(DB_PREFIX."deal",$data,"INSERT","","SILENT");
			$GLOBALS['db']->autoExecute(DB_PREFIX."deal",$data,"UPDATE","id=".$id);
			
			if($GLOBALS['db']->affected_rows()<1)
	        {
	             showErr("保存失败，请联系管理员",$ajax,"");
	        }else{
				es_session::delete("deal_image");
				
				//追加faq
				$sort = 1;
				foreach($_REQUEST['question'] as $kk=>$question_item)
				{
					if(strim($_REQUEST['question'][$kk])!=""&&strim($_REQUEST['answer'][$kk])!=""&&strim($_REQUEST['question'][$kk])!="请输入问题"&&strim($_REQUEST['answer'][$kk])!="请输入答案")
					{
						$faq_item['deal_id'] = $id;
						$faq_item['question'] = strim($_REQUEST['question'][$kk]);
						$faq_item['answer'] = strim($_REQUEST['answer'][$kk]);
						$faq_item['sort'] = $sort;
						$GLOBALS['db']->autoExecute(DB_PREFIX."deal_faq",$faq_item);
						$sort++;
					}
				}
				if($savenext==0)
				{
					showSuccess($id,$ajax,"");
				}
				else
				{
					showSuccess("",$ajax,url("project#add_item",array("id"=>$id)));
				}
			}	
		}
		else
		{
			app_redirect_preview();
		}
    }
    
    
    
    
	public function add_action()
	{
		if(!$GLOBALS['user_info'])
		app_redirect(url("user#login"));			
		
		
		$id = intval($_REQUEST['id']);
		$deal = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where is_effect = 0 and is_delete = 0 and id = ".$id." and user_id = ".intval($GLOBALS['user_info']['id']));
		if($deal)
		{
			$GLOBALS['tmpl']->assign("deal",$deal);
			$GLOBALS['tmpl']->display("project_add_action.html");
		}
		else
		{
			app_redirect_preview();
		}
    }
    
    public function save_action() {
    	$ajax = intval($_REQUEST['ajax']);
		if(!check_ipop_limit(get_client_ip(),"project_save_action",5))
		showErr("提交太频繁",$ajax,"");

		if(!$GLOBALS['user_info'])
		{
			showErr("",$ajax,url("user#login"));
		}
        $id =  intval($_REQUEST['id']);
        $savenext = intval($_REQUEST['savenext']);
        
        $data['jihua'] = strim($_REQUEST['jihua']);
        $data['youshi'] = strim($_REQUEST['youshi']);
        $GLOBALS['db']->autoExecute(DB_PREFIX."deal",$data,"UPDATE","id=".$id);
        
        
        //if($GLOBALS['db']->affected_rows()<1)
        //{
            //showErr("保存失败，请联系管理员" ,$ajax,"");
        //}else{
        	if($savenext==0) showSuccess($id,$ajax,"");
            showSuccess("",$ajax,url("project#add_item",array("id"=>$id)));
        //}
    }
    
    public function savezhixing()
    {
		$ajax = intval($_REQUEST['ajax']);
		if(!check_ipop_limit(get_client_ip(),"project_savezhixing",5))
		showErr("提交太频繁",$ajax,"");

		if(!$GLOBALS['user_info'])
		{
			showErr("",$ajax,url("user#login"));
		}
        $id =  intval($_REQUEST['id']);
        $savenext = intval($_REQUEST['savenext']);
        $data['yusuan'] = replace_public(addslashes(trim($_REQUEST['yusuan'])));
        $data['jihua'] = replace_public(addslashes(trim($_REQUEST['jihua'])));
        $data['youshi'] = replace_public(addslashes(trim($_REQUEST['youshi'])));
        $GLOBALS['db']->autoExecute(DB_PREFIX."deal",$data,"UPDATE","id=".$id);
        //$GLOBALS['db']->query("update ".DB_PREFIX."deal set description = '".$data['description']."',xmdo='".$data['xmdo']."',xmld='".$data['xmld']."' where id = ".$id);
        
        if($GLOBALS['db']->affected_rows()<1)
        {
            showErr("保存失败，请联系管理员" ,$ajax,"");
        }else{
        	if($savenext==0) showSuccess($id,$ajax,"");
            showSuccess("",$ajax,url("project#add_info",array("id"=>$id)));
        }
    }
    public function tiaozhan()
    {
    	if(!$GLOBALS['user_info'])
		app_redirect(url("user#login"));			
		
		
		$id = intval($_REQUEST['id']);
		$deal = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where is_effect = 0 and is_delete = 0 and id = ".$id." and user_id = ".intval($GLOBALS['user_info']['id']));
		if($deal)
		{
			$GLOBALS['tmpl']->assign("deal",$deal);
			$GLOBALS['tmpl']->display("project_add_tiaozhan.html");
		}
		else
		{
			app_redirect_preview();
		}
    }
        
    public function savetiaozhan()
    {
		$ajax = intval($_REQUEST['ajax']);
		if(!check_ipop_limit(get_client_ip(),"project_savetiaozhan",5))
		showErr("提交太频繁",$ajax,"");
			
		if(!$GLOBALS['user_info'])
		{
			showErr("",$ajax,url("user#login"));
		}
        $id =  intval($_REQUEST['id']);
        $savenext = intval($_REQUEST['savenext']);
        
        $data = array();
        $data['fengxian'] = strval($_REQUEST['fengxian']);
        $data['tiaozhan'] = strval($_REQUEST['tiaozhan']);

        $GLOBALS['db']->autoExecute(DB_PREFIX."deal",$data,"UPDATE","id=".$id);
        if($GLOBALS['db']->affected_rows()<1)
        {
            showErr("保存失败，请联系管理员",$ajax,"");
        }else{
        	if($savenext==0) showSuccess($id,$ajax,"");
            showSuccess("",$ajax,url("project#add_item",array("id"=>$id)));
        }
    }
	
	public function del()
	{
		$ajax = intval($_REQUEST['ajax']);	
		

		if(!$GLOBALS['user_info'])
		{
			showErr("",$ajax,url("user#login"));
		}
		
		$id = intval($_REQUEST['id']);
		
		$GLOBALS['db']->query("delete from ".DB_PREFIX."deal where id = ".$id." and is_edit = 1 and user_id = ".intval($GLOBALS['user_info']['id']." and is_effect = 0 and is_delete = 0"));
		if($GLOBALS['db']->affected_rows()>0)
		{
			$GLOBALS['db']->query("delete from ".DB_PREFIX."deal_item where deal_id = ".$id);
			$GLOBALS['db']->query("delete from ".DB_PREFIX."deal_item_image where deal_id = ".$id);
			$GLOBALS['db']->query("delete from ".DB_PREFIX."deal_comment where deal_id = ".$id);
			$GLOBALS['db']->query("delete from ".DB_PREFIX."deal_faq where deal_id = ".$id);
			$GLOBALS['db']->query("delete from ".DB_PREFIX."deal_focus_log where deal_id = ".$id);
			$GLOBALS['db']->query("delete from ".DB_PREFIX."deal_log where deal_id = ".$id);
			$GLOBALS['db']->query("delete from ".DB_PREFIX."deal_pay_log where deal_id = ".$id);
			$GLOBALS['db']->query("delete from ".DB_PREFIX."deal_support_log where deal_id = ".$id);
			$GLOBALS['db']->query("delete from ".DB_PREFIX."deal_visit_log where deal_id = ".$id);
			showSuccess("",$ajax,get_gopreview());
		}
		else
		{
			showErr("删除失败",$ajax);
		}
		
	
	}
	
	public function add_item()
	{			
		if(!$GLOBALS['user_info'])
		app_redirect(url("user#login"));			
		
		
		$id = intval($_REQUEST['id']);
		$deal_item = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where is_effect = 0 and is_delete = 0 and id = ".$id." and user_id = ".intval($GLOBALS['user_info']['id']));
		if($deal_item)
		{		

			$deal_item_list = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal_item where deal_id = ".$deal_item['id']." order by price asc");
			$GLOBALS['tmpl']->assign("deal_item_list",$deal_item_list);
			
			$GLOBALS['tmpl']->assign("deal_item",$deal_item);
			$GLOBALS['tmpl']->assign("page_title","回报设置 - ".$deal_item['name']);
			$GLOBALS['tmpl']->display("project_add_item.html");
		}
		else
		{
			app_redirect_preview();
		}
	}
	
	public function edit_item()
	{			
		if(!$GLOBALS['user_info'])
		app_redirect(url("user#login"));			
		
		
		$id = intval($_REQUEST['id']);
		$item = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal_item where id = ".$id);
		$deal_item = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where is_edit = 1 and is_effect = 0 and is_delete = 0 and id = ".$item['deal_id']." and user_id = ".intval($GLOBALS['user_info']['id']));
		if($deal_item&&$item)
		{		
			$deal_item_images = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."deal_item_image where deal_id = ".$deal_item['id']." and deal_item_id = ".$item['id']);
			$GLOBALS['tmpl']->assign("deal_item_images",$deal_item_images);
			
			$GLOBALS['tmpl']->assign("deal_item",$deal_item);
			$GLOBALS['tmpl']->assign("item",$item);
			$GLOBALS['tmpl']->assign("page_title","回报设置 - ".$deal_item['name']);
			$GLOBALS['tmpl']->display("project_edit_item.html");
		}
		else
		{
			app_redirect_preview();
		}
	}
	
	public function del_item()
	{			
		$ajax = intval($_REQUEST['ajax']);	
		

		if(!$GLOBALS['user_info'])
		{
			showErr("",$ajax,url("user#login"));
		}		
		
		
		$id = intval($_REQUEST['id']);
		$item = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal_item where id = ".$id);
		$deal_item = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal where is_edit = 1 and is_effect = 0 and is_delete = 0 and id = ".$item['deal_id']." and user_id = ".intval($GLOBALS['user_info']['id']));
		if($deal_item&&$item)
		{		
			$GLOBALS['db']->query("delete from ".DB_PREFIX."deal_item where id = ".$id);
			$GLOBALS['db']->query("delete from ".DB_PREFIX."deal_item_image where deal_item_id = ".$id);
			showErr("",$ajax,get_gopreview());
			
		}
		else
		{
			showErr("删除失败",$ajax);
		}
	}
	
	public function save_deal_item()
	{
		$ajax = intval($_REQUEST['ajax']);	
		if(!$GLOBALS['user_info'])
		{
			showErr("",$ajax,url("user#login"));
		}
		
		$id = intval($_REQUEST['id']);
		
		$data['price'] = doubleval($_REQUEST['price']);
		if($data['price']<=0)
		showErr("请输入正确的价格",$ajax);
		
		$data['description'] = strim($_REQUEST['description']);
		$data['is_delivery'] = intval($_REQUEST['is_delivery']);
		$data['delivery_fee'] = doubleval($_REQUEST['delivery_fee']);
		$data['is_limit_user'] = intval($_REQUEST['is_limit_user']);
		$data['limit_user'] = intval($_REQUEST['limit_user']);
		$data['repaid_day'] = intval($_REQUEST['repaid_day']);
		$data['deal_id'] = intval($_REQUEST['deal_id']);
		
		if(count($_REQUEST['image'])>4)
		{
			showErr("图片不能超过四张",$ajax);
		}
		
		if($id==0)
		{
			$GLOBALS['db']->autoExecute(DB_PREFIX."deal_item",$data,"INSERT","","SILENT");
			$result_id = intval($GLOBALS['db']->insert_id());
			if($result_id>0)
			{
				if(count($_REQUEST['image'])>=0)
				{
					foreach($_REQUEST['image'] as $k=>$v)
					{
						$image_data['deal_id'] = $data['deal_id'];
						$image_data['deal_item_id'] = $result_id;
						$image_data['image'] = replace_public($v);
						$GLOBALS['db']->autoExecute(DB_PREFIX."deal_item_image",$image_data);
					}					
				}
				$GLOBALS['db']->query("update ".DB_PREFIX."deal set deal_extra_cache = '' where id = ".$data['deal_id']);
				showSuccess("保存成功",$ajax,get_gopreview());
			}
			else
			{
				showErr("保存失败",$ajax);
			}
		}
		else
		{
			$GLOBALS['db']->autoExecute(DB_PREFIX."deal_item",$data,"UPDATE","id=".$id,"SILENT");
			if(count($_REQUEST['image'])>=0)
			{
					$GLOBALS['db']->query("delete from ".DB_PREFIX."deal_item_image where deal_item_id = ".$id);
					foreach($_REQUEST['image'] as $k=>$v)
					{
						$image_data['deal_id'] = $data['deal_id'];
						$image_data['deal_item_id'] = $id;
						$image_data['image'] = replace_public(strim($v));
						$GLOBALS['db']->autoExecute(DB_PREFIX."deal_item_image",$image_data);
					}					
			}
			$GLOBALS['db']->query("update ".DB_PREFIX."deal set deal_extra_cache = '' where id = ".$data['deal_id']);
			showSuccess("保存成功",$ajax,get_gopreview());
		}
		
	}
	
	public function submit_deal()
	{
		$id = intval($_REQUEST['id']);
		$ajax = 1;
		if(!$GLOBALS['user_info'])
		{
			showErr("",$ajax,url("user#login"));
		}
		$vo = $GLOBALS['db']->getRow("select is_edit from ".DB_PREFIX."deal where user_id = ".intval($GLOBALS['user_info']['id'])." and is_delete = 0 and is_effect = 0 and id= ".$id);
		$deal_item_count = $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."deal_item where deal_id = ".$id);
		
		if($vo['is_edit']==0)
		{
			showErr("项目审核中，请勿重复提交！",$ajax);
		}
		if($deal_item_count==0)
		{
			showErr("请先添加至少一项回报设置! ",$ajax);
		}
		$GLOBALS['db']->query("update ".DB_PREFIX."deal set is_edit = 0 where id = ".$id);
		showSuccess("提交成功，等待管理员审核！",$ajax);
	}
	
}
?>