<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if ($this->_var['page_title'] != ''): ?><?php echo $this->_var['page_title']; ?> - <?php endif; ?><?php echo $this->_var['site_name']; ?> - <?php echo $this->_var['seo_title']; ?></title>
<meta name="keywords" content="<?php echo $this->_var['seo_keyword']; ?>" />
<meta name="description" content="<?php echo $this->_var['seo_description']; ?>" />
<?php
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/style.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/site.css";
$this->_var['pagecss'][] = $this->_var['TMPL_REAL']."/css/weebox.css";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/jquery-1.8.2.min.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/jquery.bgiframe.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/jquery.weebox.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/jquery.pngfix.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/lazyload.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/script.js";
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/backtop.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/script.js";

if(app_conf("APP_MSG_SENDER_OPEN")==1)
{
$this->_var['pagejs'][] = $this->_var['TMPL_REAL']."/js/msg_sender.js";
$this->_var['cpagejs'][] = $this->_var['TMPL_REAL']."/js/msg_sender.js";
}
if(HAS_DEAL_NOTIFY>0)
{
$this->_var['notifypagejs'][] = $this->_var['TMPL_REAL']."/js/notify_sender.js";
$this->_var['cnotifypagejs'][] = $this->_var['TMPL_REAL']."/js/notify_sender.js";	
}
?>
<link rel="stylesheet" type="text/css" href="<?php 
$k = array (
  'name' => 'parse_css',
  'v' => $this->_var['pagecss'],
);
echo $k['name']($k['v']);
?>" />
<script type="text/javascript">
var APP_ROOT = '<?php echo $this->_var['APP_ROOT']; ?>';
var LOADER_IMG = '<?php echo $this->_var['TMPL']; ?>/images/lazy_loading.gif';
var ERROR_IMG = '<?php echo $this->_var['TMPL']; ?>/images/image_err.gif';
<?php if (app_conf ( "APP_MSG_SENDER_OPEN" ) == 1): ?>
var send_span = <?php 
$k = array (
  'name' => 'app_conf',
  'v' => 'SEND_SPAN',
);
echo $k['name']($k['v']);
?>000;
<?php endif; ?>
</script>
<script type="text/javascript" src="<?php 
$k = array (
  'name' => 'parse_script',
  'v' => $this->_var['pagejs'],
  'c' => $this->_var['cpagejs'],
);
echo $k['name']($k['v'],$k['c']);
?>"></script>
<?php if (HAS_DEAL_NOTIFY > 0): ?>
<script type="text/javascript" src="<?php 
$k = array (
  'name' => 'parse_script',
  'v' => $this->_var['notifypagejs'],
  'c' => $this->_var['cnotifypagejs'],
);
echo $k['name']($k['v'],$k['c']);
?>"></script>
<?php endif; ?>
<script type="text/javascript" src="<?php echo $this->_var['TMPL']; ?>/js/project_input_tip.js"></script>
</head>
<body>
<div class="pulish_header">
  <div class="wrap clear">
    <div class="logo f_l"> <a class="link" href="<?php echo $this->_var['APP_ROOT']; ?>/" target="_blank">
      <?php
					$this->_var['logo_image'] = app_conf("SITE_LOGO");
				?>
      <?php 
$k = array (
  'name' => 'load_page_png',
  'v' => $this->_var['logo_image'],
);
echo $k['name']($k['v']);
?> </a> </div>
    <div class="f_r"></div>
    <div class="pulish_project_header">
      <ul>
        <li><a href="<?php
echo parse_url_tag("u:project#edit|"."id=".$this->_var['deal']['id']."".""); 
?>">简易发布</a></li>
		<li><a href="<?php
echo parse_url_tag("u:project#add_explain|"."id=".$this->_var['deal']['id']."".""); 
?>">项目介绍</a></li>
		<li class="current"><a href="<?php
echo parse_url_tag("u:project#zhixing|"."id=".$this->_var['deal']['id']."".""); 
?>">执行计划</a></li>
      </ul>
    </div>
    <div class="f_r" style="margin-top:16px;"> <a href="<?php
echo parse_url_tag("u:project#add|"."".""); 
?>" class="add_project_header f_r"></a> 
      <!--<div class="login_tip f_r">
				<?php 
$k = array (
  'name' => 'login_tip',
);
echo $this->_hash . $k['name'] . '|' . base64_encode(serialize($k)) . $this->_hash;
?>
			</div>--> 
    </div>
  </div>
</div>


<script type="text/javascript">
	var ROOT = '<?php echo $this->_var['APP_ROOT']; ?>/keupload.php';
</script>
<?php
$this->_var['dpagejs'][] = $this->_var['TMPL_REAL']."/js/deal_publish.js";
$this->_var['dcpagejs'][] = $this->_var['TMPL_REAL']."/js/deal_publish.js";
$this->_var['dpagejs'][] = $this->_var['TMPL_REAL']."/js/upload_deal_image.js";
$this->_var['dcpagejs'][] = $this->_var['TMPL_REAL']."/js/upload_deal_image.js";
$this->_var['dpagejs'][] = $this->_var['TMPL_REAL']."/js/ajaxupload.js";
$this->_var['dpagejs'][] = $this->_var['TMPL_REAL']."/js/switch_city.js";
$this->_var['dcpagejs'][] = $this->_var['TMPL_REAL']."/js/switch_city.js";
$this->_var['dpagejs'][] = APP_ROOT_PATH."/system/region.js";
$this->_var['dcpagejs'][] = APP_ROOT_PATH."/system/region.js";
?>
<script type="text/javascript" src="<?php 
$k = array (
  'name' => 'parse_script',
  'v' => $this->_var['dpagejs'],
  'c' => $this->_var['dcpagejs'],
);
echo $k['name']($k['v'],$k['c']);
?>"></script> 
<script type='text/javascript' src='<?php echo $this->_var['APP_ROOT']; ?>/admin/public/kindeditor/kindeditor.js'></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_var['TMPL']; ?>/css/pulish.css" />
<style>

.white_box{background:none repeat scroll 0 0 #F9F9F9;border:none;}
.my_label{width:330px;height:35px;background-color:#1AA9D1;border-radius:3px;line-height:35px;color:#ffffff;font-size:14px;text-align:center;}
.ke_form{border:none;}
.ke-container{background-color:#fff;border:1px solid #1AA9D1;border-radius:3px;padding-top:5px;}
</style>
<style>
.deal-input-box{border:5px dashed red;}
</style>
<script>
function form_submit(obj){
	
	var ajaxurl = $(obj).attr("action");
	$("textarea").each(function(){
		if($(this) != null && $(this) != undefined){
			var _id = $(this).attr('class');
			if(_id != undefined && _id == "ke_html_editor"){
				KE.util.setData($(this).attr('id'));
			}
		}
	});
	var query = $(obj).serialize();
	//query+="&description="+ encodeURIComponent(KE.util.getData("jihua"));
	$.ajax({ 
			url: ajaxurl,
			dataType: "json",
			data:query,
			type: "POST",
			success: function(ajaxobj){
				if(ajaxobj.status==1)
				{
					if(ajaxobj.info!="")
					{
						$("input[name='id']").val(ajaxobj.info);
						$.showSuccess("保存成功",function(){
							if(ajaxobj.jump!="")
							{
								location.href = ajaxobj.jump;
							}
						});	
					}
					else
					{
						if(ajaxobj.jump!="")
						{
							location.href = ajaxobj.jump;
						}
					}
				}
				else
				{
					if(ajaxobj.info!="")
					{
						$.showErr(ajaxobj.info,function(){
							if(ajaxobj.jump!="")
							{
								location.href = ajaxobj.jump;
							}
						});	
					}
					else
					{
						if(ajaxobj.jump!="")
						{
							location.href = ajaxobj.jump;
						}
					}							
				}
			},
			error:function(ajaxobj)
			{
				if(ajaxobj.responseText!='')
				alert(ajaxobj.responseText);
			}
		});
		return false;
}
<!--
jQuery(function($){

	
	

	$("#savenow").bind("click",function(){
		$("input[name='savenext']").val("0");
		$("#next_two_project_form").submit();
	});
	$("#savenext").bind("click",function(){
		$("input[name='savenext']").val("1");
		$("#next_two_project_form").submit();
	});

})
--></script>
<div class="blank"></div>
<div class="shadow_bg">
  <div class="wrap white_box" >
    <div class="blank"></div>
    <div class="deal-publish-left">
      <form id="next_two_project_form" onsubmit="return form_submit(this)" action="<?php
echo parse_url_tag("u:project#savezhixing|"."".""); 
?>" method="post">
        <div class="form_row my_form_row">
          <label class="title w100 my_title cc-tip-control" ref="tip6" style="height:40px;line-height:50px;width:280px; float:none;">尽量详细的介绍项目的执行计划</label>
          <div class="clearfix"></div>
          <div class="form_row">
            <div class="ke_form" style=" margin-left:20px; *margin-top:-20px;">
              <div class="prompttext" style="display:none;" id="tip6">
                <p>在这里，我们希望您能够提到您的项目具体如何执行？分几个阶段？您现在做到了哪一阶段？预计什么时候项目能够完成？以及执行回报的大致时间。</p>
                <p>一方面，项目计划可以让您的受众了解到项目的具体执行情况，让他们觉得这个项目是经过您充分准备的；另一方面，如果您之前没有花心思在这上面，这时候也可以认真的打算一下。相信我们，项目计划对您自己的执行也是有帮助的。</p>
              </div>
              <div class="blank"></div>
              <?php 
$k = array (
  'name' => 'show_ke_form',
  'text_name' => 'jihua',
  'width' => '360',
  'height' => '300',
  'ctn' => $this->_var['deal']['jihua'],
);
echo $k['name']($k['text_name'],$k['width'],$k['height'],$k['ctn']);
?> </div>
            <div class="blank15"></div>
          </div>
        </div>
        <div class="form_row my_form_row">
          <label class="title w100 my_title cc-tip-control" ref="tip7" style="height:40px;line-height:50px;width:280px; float:none;">如果可能，请尽量详细的公开项目预算</label>
          <div class="clearfix"></div>
          <div class="form_row">
            <div class="ke_form" style=" margin-left:20px; *margin-top:-20px;">
              <div class="prompttext" style="display:none;" id="tip7">
                <p><strong>项目预算中应该尽量说明以下要点：</strong>
                  1、执行项目所需要的各种成本费用，
                  2、执行回报所需要的各种成本费用，
                  3、资金缺口（您总共需要多少钱，除去自有投入和已有融资还需要多少钱）。项目预算也是您在方舟上设置目标总金额的参考因素之一。</p><p><strong>项目预算不是必须的要求。但是我们非常希望您在编辑项目的时候认真考虑预算的以下几个优点：</strong>
                  1、让您对自己的项目有更深的了解，以便更好的做这件事（同执行计划）；
                  2、显示出足够的诚意，让潜在的支持者感觉您更加“靠谱”；
                  3、给您的筹款总金额设置做一个参考</p>
              </div>
              <div class="blank"></div>
              <?php 
$k = array (
  'name' => 'show_ke_form',
  'text_name' => 'yusuan',
  'width' => '360',
  'height' => '300',
  'ctn' => $this->_var['deal']['yusuan'],
);
echo $k['name']($k['text_name'],$k['width'],$k['height'],$k['ctn']);
?> </div>
            <div class="blank15"></div>
          </div>
        </div>
        <div class="form_row my_form_row" style=" height:520px;" >
          <label class="title w100 my_title cc-tip-control" ref="tip8" style="height:40px;line-height:50px;width:340px; float:none;">请介绍一下您自己或您的团队，突出您/团队的优势</label>
          <div class="clearfix"></div>
          <div class="form_row">
            <div class="ke_form" style=" margin-left:20px;">
              <div class="prompttext" style="display:none;" id="tip8">
                <p>个人/团队简介是一个展示自己的机会。为什么你/你们要做这个项目？你/你们以前做过什么？这些东西会帮您赢得支持者的信任。（强烈建议发起人在我们网站上的昵称使用真实姓名、现实中团队的名字或常用网名，虽然这不是一个强制实名制的网站，但是想象一下您如何能够获得别人的信任？一个谁也没听说过的昵称绝对没有真实姓名来的更加有诚意。）</p>
              </div>
              <div class="blank"></div>
              <?php 
$k = array (
  'name' => 'show_ke_form',
  'text_name' => 'youshi',
  'width' => '360',
  'height' => '301',
  'ctn' => $this->_var['deal']['youshi'],
);
echo $k['name']($k['text_name'],$k['width'],$k['height'],$k['ctn']);
?> </div>
            <div class="blank15"></div>
          </div>
        </div>
        <div class="submit_btn_row">
          <input type="hidden" name="image" value="<?php echo $this->_var['deal_image']['url']; ?>" />
          <input type="hidden" name="savenext" value="0" />
          <div class="ui-button gray" rel="gray" id="savenow">
            <div> <span>先保存一下</span> </div>
          </div>
          <div class="ui-button green" rel="green" id="savenext" style="margin-left:5px;">
            <div> <span>下一步</span> </div>
          </div>
          <input type="hidden" value="1" name="ajax" />
          <input type="hidden" name="id" value="<?php echo $this->_var['deal']['id']; ?>" />
          <div class="blank15"></div>
        </div>
      </form>
    </div>
    <div class="deal-publish-right">
      <div class="page_title"> <span id="deal_title"><?php if ($this->_var['deal']['name'] == ''): ?>DreamerHouse梦中家一起来打造我们的世外桃源吧<?php else: ?><?php echo $this->_var['deal']['name']; ?><?php endif; ?></span> </div>
      <div class="blank"></div>
      <div class="switch2_nav" style="position:relative;"> <a class="ui-button green" style="float:right;" rel="green" href="#">
        <div> <span>支持项目</span> </div>
        </a>
        <div class="ui-button blue focus_deal" rel="blue" >
          <div> <span>立即关注</span> </div>
        </div>
        <a class="ui-button green" style="float:right;" rel="green">
        <div> <span>转发</span> </div>
        </a>
        <ul>
          <li class="current"><a href="#">项目主页</a></li>
          <li><a href="#">回报</a></li>
        </ul>
      </div>
      <div class="deal-show">
        <div class="deal-title"></div>
        <div class="blank"></div>
        <div class="deal-info clear">
          <div class="deal-info-left">
            <div class="deal-remark box">
              <div class="deal-info-title">项目简介</div>
              <div class="blank"></div>
              <div class="deal-tags clear"> <span> <a href="#" >项目标签（发布完后自动提取）</a></span> </div>
              <div class="blank"></div>
              <div class="content"> <span id="deal_brief"><?php if ($this->_var['deal']['brief'] == ''): ?>项目的简介与定位<?php else: ?><?php echo $this->_var['deal']['brief']; ?><?php endif; ?></span> </div>
            </div>
            <div class="blank"></div>
            <div class="deal-news box">
              <div class="deal-info-title"> <span class="f_l">动态更新</span> <span class="f_r deal-news-date"> 发起日期： <?php 
$k = array (
  'name' => 'to_date',
  'v' => $this->_var['deal_info']['begin_time'],
  'f' => 'Y年m月d日H:i',
);
echo $k['name']($k['v'],$k['f']);
?><br/>
                结束日期： <?php 
$k = array (
  'name' => 'to_date',
  'v' => $this->_var['deal_info']['end_time'],
  'f' => 'Y年m月d日H:i',
);
echo $k['name']($k['v'],$k['f']);
?> </span> </div>
              <div class="blank" style="height:115px;"></div>
              <a class="ui-button green" rel="green">
              <div> <span>查看更多内容</span> </div>
              </a>
              <div class="blank1"></div>
            </div>
          </div>
          <div class="deal-info-right">
            <div class="deal-anthor box">
              <div class="deal_user_box clear">
                <div class="deal-info-title">团队介绍</div>
                <div class="blank"></div>
                <div class="deal_user_avatar"> <a href="<?php
echo parse_url_tag("u:home|"."id=".$this->_var['user_info']['id']."".""); 
?>"><img class="user_pic" src="<?php 
$k = array (
  'name' => 'get_user_avatar',
  'uid' => $this->_var['user_info']['id'],
  'type' => 'middle',
);
echo $k['name']($k['uid'],$k['type']);
?>"/></a> </div>
                <div class="deal_user_info clear">
                  <div class="deal_user_name"><?php echo $this->_var['user_info']['user_name']; ?></div>
                  <div class="deal__zijin_t">本项目所需资金 </div>
                  <div class="deal__zijin"> <span class=" f_l">¥<font id="price">0</font>元</span> <a class="ui-button green f_r" style="float:right; margin-top:5px;" id="add_update" rel="green">
                    <div> <span>发送私信</span> </div>
                    </a> </div>
                </div>
              </div>
            </div>
            <div class="blank"></div>
            <div class="deal-video"> <img alt="" src="<?php echo $this->_var['TMPL']; ?>/images/07.jpg" width="360" height="200"></div>
          </div>
        </div>
        <div class="blank"></div>
        <div class="deal-other">
          <div class="deal-other-tabs clear">
            <ul class="deal-desc-tabs clear">
              <li class="curr"> <a href="javascript:;" title="项目详情" ref="project_detial">项目详情</a> </li>
              <li> <a href="javascript:;" title="风险声明OR问答" ref="project_question">风险声明OR问答</a> </li>
              <li> <a href="javascript:;" title="支持者" ref="project_zhichizhe">支持者</a> </li>
              <li> <a href="javascript:;" title="评论" ref="project_pinglun">评论</a> </li>
            </ul>
            <div class="deal-tabs-press">
              <div class="project-progress-container">
                <div class="progress-bar fl" title="0%"> </div>
              </div>
              <div class=""> <span class="support_amount">已筹得0元</span> <span class="remain_days">剩余<font id="deal_days">0</font>天</span> </div>
            </div>
          </div>
          <div class="deal-bottom">
            <div id="project_detial" class="deal-show-item clear" style="display:block;">
              <div class="deal-detial-other deal-input-box" style="width:737px;">
              	<p class="detial-desc"><?php echo $this->_var['deal']['description']; ?></p>
                <p class="detial-desc"><?php echo $this->_var['deal']['xmdo']; ?></p><p class="detial-desc">&nbsp;</p>
                <p class="detial-desc"><?php echo $this->_var['deal']['xmld']; ?></p><p class="detial-desc">&nbsp;</p>
                <p class="detial-desc"><?php echo $this->_var['deal']['jihua']; ?></p><p class="detial-desc">&nbsp;</p>
                <p class="detial-desc"><?php echo $this->_var['deal']['yusuan']; ?></p><p class="detial-desc">&nbsp;</p>
                <p class="detial-desc"><?php echo $this->_var['deal']['youshi']; ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="blank"></div>
  </div>
</div>
<div class="blank"></div>
<?php echo $this->fetch('inc/footer.html'); ?> 