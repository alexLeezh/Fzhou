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
<style>
.deal-input-box{border:0px dashed red;}
</style>
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
		<li class="current"><a href="<?php
echo parse_url_tag("u:project#add_explain|"."id=".$this->_var['deal']['id']."".""); 
?>">项目介绍</a></li>
		<li><a href="<?php
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
.ke_form{border:none;}
.ke-container{background-color:#fff;border:1px solid #1AA9D1;border-radius:3px;padding-top:5px;}
</style>
<script type="text/javascript" src="<?php echo $this->_var['TMPL']; ?>/js/project_input_tip.js"></script>
<script>

$(document).ready(function(){

	$("textarea[name='xmdo']").bind("keyup blur",function(){
		$("#deal_xmdo").html($(this).val());
	});
	$("textarea[name='xmld']").bind("keyup blur",function(){
		$("#deal_xmld").html($(this).val());
	});


	
	$("#next_two_project_form").bind("submit",function(){
		var ajaxurl = $(this).attr("action");

		$("textarea").each(function(){
			if($(this) != null && $(this) != undefined){
				var _id = $(this).attr('class');
				if(_id != undefined && _id == "ke_html_editor"){
					KE.util.setData($(this).attr('id'));
				}
			}
		});

		var query = $(this).serialize();

		//query+="&description="+ encodeURIComponent(KE.util.getData("descript"));
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
	
	});

	$("#savenow").bind("click",function(){
		$("input[name='savenext']").val("0");
		$("#next_two_project_form").submit();
	});
	$("#savenext").bind("click",function(){
		$("input[name='savenext']").val("1");
		$("#next_two_project_form").submit();
	});
});


</script>
<div class="blank"></div>

<div class="shadow_bg">
	<div class="wrap white_box" >

			<div class="blank"></div>
			
			<div class="deal-publish-left">
				<form id="next_two_project_form" action="<?php
echo parse_url_tag("u:project#saveExplain|"."".""); 
?>" method="post">									
					<div class="form_row my_form_row">
						<label class="title w100 my_title" style="height:40px;line-height:50px;width:150px;float:none;">项目详情</label>
                        <a id="btn_xiangqing" class="tip_control" href="#" style="background-image: url('/app/Tpl/fanwe/images/showsome.jpg');"></a>
                        <div><p id="about_xiangqing" class="prompttext" style="margin-left:20px;display:none;">详细介绍一下您的项目以及您为什么要这样做</p></div>
                        <div class="blank"></div>
						<div class="clearfix"></div>
						<div class="form_row">
							<textarea id="ta_xiangqing" class="textarea3 liangdian" style="height: 40px; overflow-y: hidden;display:block;"><?php echo $this->_var['deal']['description']; ?></textarea>
							<div id="xiangqing" class="ke_form" style="float:left;text-align:-webkit-center !important; text-align:center;margin-left:20px;*margin-left:10px; *margin-top:-20px;display:none;">
							<?php 
$k = array (
  'name' => 'show_ke_form',
  'text_name' => 'descrip',
  'width' => '360',
  'height' => '300',
  'ctn' => $this->_var['deal']['description'],
);
echo $k['name']($k['text_name'],$k['width'],$k['height'],$k['ctn']);
?>
							</div>
						</div>
                        <div class="blank15"></div>
					</div>
	
<!--					<div class="form_row my_form_row">
						<label class="title w100 my_title cc-tip-control" ref="tip2" style="height:50px;line-height:50px; float:none;">你为什么要这样做</label>
                        <div><p class="prompttext" id="tip2" style="margin-left:20px; margin-top:-10px;display:none;">用一句话描述你想做的事情。这句话将作为您的项目简介出现在展示单元中，同时还会出现在项目内页最显眼的位置。作为一个直观展示的基本信息，请务必在简练明确的基础上发挥您最高的文字功底吸引支持者。试想如果您把您的项目写成一条微博，怎么才能让您的粉丝快速的了解这个项目到底想做什么？</p></div>
                        <div class="blank"></div>
                        <div class="clearfix"></div>
                        <div class="form_row" >
							<div class="ke_form" style="text-align:-webkit-center !important; text-align:center; margin-left:20px;*margin-left:10px; *margin-top:-20px;">
							<?php 
$k = array (
  'name' => 'show_ke_form',
  'text_name' => 'xmdo',
  'width' => '360',
  'height' => '300',
  'ctn' => $this->_var['deal']['xmdo'],
);
echo $k['name']($k['text_name'],$k['width'],$k['height'],$k['ctn']);
?>
							</div>
						</div>
                        <div class="blank15"></div>
					</div>-->
	
					<div class="form_row my_form_row">
						<label class="title w100 my_title" style="height:50px;line-height:50px; float:none;">亮点</label>
                        <a id="btn_liangdian" class="tip_control" href="#" style="background-image: url('/app/Tpl/fanwe/images/showsome.jpg');"></a>
                        <div><p id="about_liangdian" class="prompttext" style="margin-left:20px;display:none;">您认为这个项目哪里最吸引人，让大家知道您的想法。</p></div>
                        <div class="blank"></div>
                        <div class="clearfix"></div>
                        <div class="form_row">
                            <textarea id="ta_liangdian" class="textarea3 liangdian" style="height: 40px; overflow-y: hidden;"><?php echo $this->_var['deal']['xmld']; ?></textarea>
							<div id="liangdian" class="ke_form" style="float:left;text-align:-webkit-center !important; text-align:center; margin-left:20px;*margin-left:10px; *margin-top:-20px;display:none;">
							<?php 
$k = array (
  'name' => 'show_ke_form',
  'text_name' => 'xmld',
  'width' => '360',
  'height' => '300',
  'ctn' => $this->_var['deal']['xmld'],
);
echo $k['name']($k['text_name'],$k['width'],$k['height'],$k['ctn']);
?>
							<script>
                              //function a1()<?php echo $this->_var['("#liangdian")']['hide();$("#ta_liangdian")']['show();']; ?>
                              var var_btnclick = false;
                              //加入的编辑器完成后的调用方法
                              bindevenkeafter(function(edi){
                                  if($('#'+edi).attr("id")=="descrip"){
                                    var dd=$("#xiangqing .ke-iframe").contents().find("body");
                                    dd.css({"width":"341px","height":"237px"});
                                      //dd.attr("onfocus","this.focus()");
                                      dd.bind("keyup",function(){
                                        
                                        parent.$('#desc_xiangqing').html($(this).html());
                                        parent.$("#ta_xiangqing").html($(this).html());
                                        }); 
                                      dd.attr("onblur",
                                      "parent.$('#xiangqing').hide();"+
                                      "parent..$('#ta_xiangqing').show();"+
                                      "parent.$('.deal-input-box').css('border-width','0px');"+
                                      "parent.$('#about_xiangqing').hide();"+
                                      "parent.$('#btn_xiangqing').css('background-image','url(/app/Tpl/fanwe/images/showsome.jpg)');parent.var_btnclick=true;");
                                      
                                  }
                                  if($('#'+edi).attr("id")=="xmld"){
                                    var dd=$("#liangdian .ke-iframe").contents().find("body");
                                    dd.css({"width":"341px","height":"237px"});
                                    //dd.attr("onfocus","parent.a1()");
                                      dd.bind("keyup",function(){
                                        
                                        parent.$('#desc_liangdian').html($(this).html());
                                        parent.$("#ta_liangdian").html($(this).html());
                                        }); 
                                      dd.attr("onblur", "parent.liangdian.style.display='none';parent.ta_liangdian.style.display='block';parent.$('.deal-input-box').css('border-width','0px');parent.$('#about_liangdian').hide(); parent.$('#btn_liangdian').css('background-image','url(/app/Tpl/fanwe/images/showsome.jpg)');parent.var_btnclick=true;");
                                      
                                  }
                                });
                                 
							</script>
							</div>
						</div>
						<div class="blank15"></div>
						<div class="blank15"></div>
						<div class="blank15"></div>
					</div>				
					<div class="submit_btn_row">
						<input type="hidden" name="image" value="<?php echo $this->_var['deal_image']['url']; ?>" />
						<input type="hidden" name="savenext" value="0" />
						<div class="ui-button gray" rel="gray" id="savenow">
							<div>
								<span>先保存一下</span>
							</div>
						</div>
						<div class="ui-button green" rel="green" id="savenext" style="margin-left:5px;">
							<div>
								<span>下一步</span>
							</div>
						</div>
						<input type="hidden" value="1" name="ajax" />
						<input type="hidden" name="id" value="<?php echo $this->_var['deal']['id']; ?>" />
						<div class="blank15"></div>
					</div>
				</form>
			</div>
			<div class="deal-publish-right">
		      <div class="deal-publish-mask"></div>
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
		            <div class="deal-remark box" style="z-index:1">
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
		            <div class="deal-video"> <img alt="" src="<?php echo $this->_var['TMPL']; ?>/images/07.jpg" width="360" height="200"> 
		              <!-- 
										<embed wmode="opaque" wmode="opaque" src="<?php echo $this->_var['deal_info']['source_vedio']; ?>" allowFullScreen="true" quality="high" width="360" height="276" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>
										 --> 
		            </div>
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
		          <div class="deal-bottom" style="z-index:200;position: relative;">
		            <div id="project_detial" class="deal-show-item clear" style="display:block;">
		              <div class="deal-detial-other deal-input-box" style="width:737px;">
		              	<p id="desc_xiangqing" class="detial-desc"><?php echo $this->_var['deal']['description']; ?></p>
		                <!--<p class="detial-desc"><?php echo $this->_var['deal']['xmdo']; ?></p><p class="detial-desc">&nbsp;</p>-->
		                <p id="desc_liangdian" class="detial-desc"><?php echo $this->_var['deal']['xmld']; ?></p><p class="detial-desc">&nbsp;</p>
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


