<?php echo $this->fetch('inc/header.html'); ?> 
<?php
$this->_var['dpagecss'][] = $this->_var['TMPL_REAL']."/css/deal.css";
$this->_var['dpagecss'][] = $this->_var['TMPL_REAL']."/css/deal_comment.css";
$this->_var['dpagecss'][] = $this->_var['TMPL_REAL']."/css/deal_support.css";
$this->_var['dpagecss'][] = $this->_var['TMPL_REAL']."/css/deal_log.css";
$this->_var['dpagecss'][] = $this->_var['TMPL_REAL']."/css/center.css";
$this->_var['dpagecss'][] = $this->_var['TMPL_REAL']."/css/fancybox.css";
$this->_var['dpagejs'][] = $this->_var['TMPL_REAL']."/js/jquery.fancybox.js";
$this->_var['dpagejs'][] = $this->_var['TMPL_REAL']."/js/deal.js";
$this->_var['dcpagejs'][] = $this->_var['TMPL_REAL']."/js/deal.js";
$this->_var['dpagejs'][] = $this->_var['TMPL_REAL']."/js/faq.js";
$this->_var['dcpagejs'][] = $this->_var['TMPL_REAL']."/js/faq.js";

$this->_var['dpagejs'][] = $this->_var['TMPL_REAL']."/js/deal_comment.js";
$this->_var['dcpagejs'][] = $this->_var['TMPL_REAL']."/js/deal_comment.js";
$this->_var['dpagejs'][] = $this->_var['TMPL_REAL']."/js/discover.js";
$this->_var['dcpagejs'][] = $this->_var['TMPL_REAL']."/js/discover.js";


?>
<link rel="stylesheet" type="text/css" href="<?php 
$k = array (
  'name' => 'parse_css',
  'v' => $this->_var['dpagecss'],
);
echo $k['name']($k['v']);
?>" />
<script type="text/javascript" src="<?php 
$k = array (
  'name' => 'parse_script',
  'v' => $this->_var['dpagejs'],
  'c' => $this->_var['dcpagejs'],
);
echo $k['name']($k['v'],$k['c']);
?>"></script>

<div class="blank"></div>
<div class="">
	<div class="wrap ">
		<?php echo $this->fetch('inc/deal_header.html'); ?>
		<div class="deal-show">
			<div class="deal-title"></div>
			<div class="blank"></div>
			<div class="deal-info clear">
				<div class="deal-info-left">
					<div class="deal-remark box">
						<div class="deal-info-title">项目简介</div>
						<div class="blank"></div>
						<div class="deal-tags clear">
							<span>
							<?php $_from = $this->_var['deal_info']['tags_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'tag');if (count($_from)):
    foreach ($_from AS $this->_var['tag']):
?>
							<?php if (trim ( $this->_var['tag'] ) != ''): ?>
							<a href="<?php
echo parse_url_tag("u:deals|"."tag=".$this->_var['tag']."".""); 
?>" title="<?php echo $this->_var['tag']; ?>"><?php echo $this->_var['tag']; ?></a>&nbsp;
							<?php endif; ?>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
							</span>
						</div>
						<div class="blank"></div>
						<div class="content">
							这是一个需要爱与被爱的世界，然而在我们面对这纷繁复杂多变的世界时，我们如何过滤掉那迷乱双眼的尘沙找到真爱？我们在爱中得救，在爱中迷失。我们过度相信我们用双眼所见的，却忘记听从内心最真的感受！
						</div>
					</div>
					
					<div class="blank"></div>
					<div class="deal-news box">
						<div class="deal-info-title">
						<span class="f_l">动态更新</span>
						<span class="f_r deal-news-date">
						发起日期： <?php 
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
?>
						</span>
						</div>
						<div class="blank"></div>
						
						<div class="deal-news-list">
							<?php $_from = $this->_var['log_list1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'log_item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['log_item']):
?>
								<?php if ($this->_var['log_item']['log_title'] != ''): ?>
								<div class="deal-logs-item">
                                    <div class="title clear" rel="<?php echo $this->_var['log_item']['id']; ?>"><a href="javascript:;" rel="<?php echo $this->_var['log_item']['id']; ?>" onclick="logs_show_content(this)"><?php echo $this->_var['log_item']['log_title']; ?></a><span class=" icon <?php if ($this->_var['key'] == 0): ?>icon-curr<?php endif; ?>"></span></div>
                                    <div class="content" <?php if ($this->_var['key'] == 0): ?>style="display:block;"<?php endif; ?> id="log_<?php echo $this->_var['log_item']['id']; ?>" rel="<?php echo $this->_var['log_item']['id']; ?>"><?php echo $this->_var['log_item']['log_info']; ?></div>
								</div>
								<?php endif; ?>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						</div>
						<div class="blank"></div>
						<a class="ui-button green" rel="green" href="<?php
echo parse_url_tag("u:deal#update|"."id=".$this->_var['deal_info']['id']."".""); 
?>">
							<div>
								<span>查看更多内容</span>
							</div>
						</a>
						<div class="blank1"></div>
					</div>
				</div>
				<div class="deal-info-right">
					<?php if ($this->_var['deal_user_info']): ?>
					<div class="deal-anthor box">
						<div class="deal_user_box clear">
							<div class="deal-info-title">团队介绍</div>
							<div class="blank"></div>
							<div class="deal_user_avatar">
							<?php 
$k = array (
  'name' => 'show_avatar',
  'p' => $this->_var['deal_user_info']['id'],
);
echo $k['name']($k['p']);
?>
							</div>
							<div class="deal_user_info clear">
								<div class="deal_user_name"><?php echo $this->_var['deal_user_info']['user_name']; ?></div>
								<div class="deal__zijin_t">本项目所需资金 </div>
								<div class="deal__zijin">
									<span class=" f_l">¥<?php echo $this->_var['deal_info']['limit_price_format']; ?>元</span>
									<a class="ui-button green f_r" style="float:right; margin-top:5px;" id="add_update" rel="green" href="javascript:send_message(<?php echo $this->_var['deal_user_info']['id']; ?>);">
										<div>
											<span>发送私信</span>
										</div>
									</a>	
								</div>
								
							</div>
						</div>
					</div>
					<?php endif; ?>
					
					<?php if ($this->_var['deal_info']['source_vedio'] != ''): ?>
					<div class="blank"></div>
					<div class="deal-video">
						<embed wmode="opaque"wmode="opaque"src="<?php echo $this->_var['deal_info']['source_vedio']; ?>" allowFullScreen="true" quality="high" width="485" height="276" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>
					</div>
					<?php endif; ?>
					
					<?php if ($this->_var['deal_item_list']): ?>
						<?php if ($this->_var['deal_item_list'] [ 0 ]): ?>
							<div class="blank"></div>
							<div class="deal-huibao box">
							<div class="deal-info-title">回报预览</div>
							<div class="blank"></div>
							<div class="deal_item_list">
							
							<?php $_from = $this->_var['deal_item_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'deal_item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['deal_item']):
?>
							<?php if ($this->_var['key'] == 1): ?>
							<div class="huibao clear">
								<div class="huibao-pic">
									<?php $_from = $this->_var['deal_item']['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('index', 'image');if (count($_from)):
    foreach ($_from AS $this->_var['index'] => $this->_var['image']):
?>
									<?php if ($this->_var['index'] == 1): ?>
									<img src="<?php 
$k = array (
  'name' => 'get_spec_image',
  'v' => $this->_var['image']['image'],
  'w' => '250',
  'h' => '206',
  'g' => '1',
);
echo $k['name']($k['v'],$k['w'],$k['h'],$k['g']);
?>" rel="<?php 
$k = array (
  'name' => 'get_spec_image',
  'v' => $this->_var['image']['image'],
  'w' => '266',
  'h' => '206',
);
echo $k['name']($k['v'],$k['w'],$k['h']);
?>" width=266 height=206 />
									<?php endif; ?>
									<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
								</div>
								<div class="huibao-info">
									<div class="huibao-desc">
										<p class="huibao-desc-tip">支持后您将获得</p>
										<?php 
$k = array (
  'name' => 'msubstr',
  'v' => $this->_var['deal_item']['description'],
  'b' => '0',
  'e' => '45',
);
echo $k['name']($k['v'],$k['b'],$k['e']);
?>
									</div>
									<div class="huibao-zhichi">
										<p class="huibao-zhichi-tip">已获支持</p>
										<p class="huibao-zhichi-count"><?php echo $this->_var['deal_info']['support_count']; ?>人</p>
									</div>
								</div>
							<?php endif; ?>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
							</div>
							</div>
						<?php endif; ?>
					<?php endif; ?>
					
					
				</div>
			</div>
			<div class="blank"></div>
            
            
            
            
			<div class="deal-other">
				<div class="deal-other-tabs clear">
					<ul class="deal-desc-tabs clear">
						<li class="curr">
							<a href="javascript:;" title="项目详情" ref="project_detial">项目详情</a>
						</li>
						<li>
							<a href="javascript:;" title="风险声明OR问答" ref="project_question">风险声明OR问答</a>
						</li>
						<li>
							<a href="javascript:;" title="支持者" ref="project_zhichizhe">支持者</a>
						</li>
						<li>
							<a href="javascript:;" title="评论" ref="project_pinglun">评论</a>
						</li>
					</ul>
					<div class="deal-tabs-press">
						<div class="project-progress-container">
		                    <div class="progress-bar fl" title="<?php echo $this->_var['deal_info']['percent']; ?>%">
		                        <span class="projress-scroll fr"><?php echo $this->_var['deal_info']['percent']; ?>%</span>
		                    </div>
		                </div>
                        <div class="">
							<span class="support_amount">已筹得<?php echo $this->_var['deal_info']['support_amount_format']; ?>元</span>
							<span class="remain_days">剩余<?php echo $this->_var['deal_info']['remain_days']; ?>天</span>
						</div>
					</div>
					<script type="text/javascript">
						$('.progress-bar').each(function(index, element) {
					    	var percent = $(this).attr('title');
					        var _l=percent.substr(0,percent.indexOf("%"));
					        if(!isNaN(_l)&&parseInt(_l)<=12) $(this).animate({width:26},1000);
					    	else if(!isNaN(_l)&&parseInt(_l)>=100) $(this).animate({width:'100%'},1000);
					        else $(this).animate({width:percent},1000);
					    });
					</script>
				</div>
				<div class="deal-bottom">
					<div id="project_detial" class="deal-show-item clear" style="display:block;">
						<div class="deal-detial-desc"><?php echo $this->_var['deal_info']['description']; ?></div>
						<div class="deal-detial-other">
							<?php if ($this->_var['deal_info']['xmdo'] != ''): ?>
							<p class="detial-title">为什么要这么做</p>
							<p class="detial-desc"><?php echo $this->_var['deal_info']['xmdo']; ?></p>
							<?php endif; ?>
							<?php if ($this->_var['deal_info']['xmld'] != ''): ?>
							<p class="detial-title">若干亮点</p>
							<p class="detial-desc"><?php echo $this->_var['deal_info']['xmld']; ?></p>
							<?php endif; ?>
							<?php if ($this->_var['deal_info']['jihua'] != ''): ?>
							<p class="detial-title">执行计划</p>
							<p class="detial-desc"><?php echo $this->_var['deal_info']['jihua']; ?></p>
							<?php endif; ?>
							<?php if ($this->_var['deal_info']['youshi'] != ''): ?>
							<p class="detial-title">我和我的团队优势</p>
							<p class="detial-desc"><?php echo $this->_var['deal_info']['youshi']; ?></p>
							<?php endif; ?>
							<?php if ($this->_var['deal_info']['fengxian'] != ''): ?>
							<p class="detial-title">风险声明</p>
							<p class="detial-desc"><?php echo $this->_var['deal_info']['fengxian']; ?></p>
							<?php endif; ?>
							<?php if ($this->_var['deal_info']['tiaozhan'] != ''): ?>
							<p class="detial-title">挑战</p>
							<p class="detial-desc"><?php echo $this->_var['deal_info']['tiaozhan']; ?></p>
							<?php endif; ?>
						</div>
						
					</div>
					<div id="project_question" class="deal-show-item clear">
						<div class="deal_qa">
					
								<?php $_from = $this->_var['deal_faq_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'faq');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['faq']):
?>
					
									<div class="faq_question" id="menu_<?php echo $this->_var['faq']['id']; ?>" rel="<?php echo $this->_var['faq']['id']; ?>"> - <?php echo $this->_var['faq']['question']; ?></div>
									<div class="faq_answer" id="answer_<?php echo $this->_var['faq']['id']; ?>" rel="<?php echo $this->_var['faq']['id']; ?>"><?php 
$k = array (
  'name' => 'nl2br',
  'v' => $this->_var['faq']['answer'],
);
echo $k['name']($k['v']);
?></div>
									<div class="blank"></div>
			
								<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
							
						</div>
						<div class="blank"></div>
						
						<div class="deal_contact">
							<div class="f_l">如果您对项目有疑问，可以在此向发起人咨询。</div>
							<div class="f_r">
								<div class="ui-button blue" rel="blue" onclick="send_message(<?php echo $this->_var['deal_info']['user_id']; ?>);">
									<div>
										<span>对发起人提问</span>
									</div>
								</div>
							</div>
						</div>	
					</div>
					<div id="project_zhichizhe" class="deal-show-item clear">
						<div id="supports_list"></div>
					</div>
                    
                    <script type="text/javascript">
						function load_comments(data,action){
							$.ajax({ 
								url: action,
								dataType: "json",
								data:data,
								type: "POST",
								success: function(obj){
									$("#ddddd").html(obj.html);
								},
								error:function(obj)
								{
									alert("请求错误，请及时联系管理员！");
								}
							});		
						}
						
						function load_support(data,action){
							$.ajax({ 
								url: action,
								dataType: "json",
								data:data,
								type: "POST",
								success: function(obj){
									$("#supports_list").html(obj.html);
								},
								error:function(obj)
								{
									alert("请求错误，请及时联系管理员！");
								}
							});		
						}
						function load_logs(){
							$.ajax({ 
								url: '<?php
echo parse_url_tag("u:deal#getupdates|"."".""); 
?>',
								dataType: "json",
								data:{id:"<?php echo $this->_var['deal_info']['id']; ?>"},
								type: "POST",
								success: function(obj){
									$("#deal_logs").html(obj.html);
								},
								error:function(obj)
								{
									alert("请求错误，请及时联系管理员！");
								}
							});		
						}
						
						function replycomment(obj){
							if($(obj).parent().parent().parent().find(".comm-re").css("display")=="none")
								$(obj).parent().parent().parent().find(".comm-re").show();
							else
								$(obj).parent().parent().parent().find(".comm-re").hide();		
						}
						function sendclick(obj){
							if($(obj).find("div span").html()!="发送中")
							$(obj).parent().parent().submit();
						}
						
						function delcomment(obj){
							var ajaxurl = $(obj).attr("action");
							var comment_box = $(obj).parent().parent().parent().parent().parent();
							$.showConfirm("确认要删除该记录吗？",function(){
								
								var query = new Object();
								
								query.ajax = 1;
								$.ajax({ 
									url: ajaxurl,
									dataType: "json",
									data:query,
									type: "POST",
									success: function(ajaxobj){
										$(comment_box).remove();
										$("#comment_"+ajaxobj.logid+"_tip").html(ajaxobj.counthtml);
										close_pop();
									},
									error:function(ajaxobj)
									{
										if(ajaxobj.responseText!='')
										alert(ajaxobj.responseText);
									}
								});
							});
							return false;	
						}

						function logs_show_content(obj){
							var _rel=$(obj).attr("rel");
							var _p_obj = $(obj).parent().parent();
							$(".deal-logs-item .content").each(function(index, element) {
                                if($(this).attr("rel")==_rel){
                                	$(this).parent().find(".title span:last").attr("class","icon-curr");
									$(this).slideDown();	
								}else{
									$(this).parent().find(".title span:last").attr("class","icon");
									$(this).slideUp();
								}
                            });
						}
						//load_comments({id:"<?php echo $this->_var['deal_info']['id']; ?>"},'<?php
echo parse_url_tag("u:deal#getcomments|"."".""); 
?>');
                    	//$(document).ready(function() {
                        	//alert(1);
                    		//load_logs();
                            load_comments({id:"<?php echo $this->_var['deal_info']['id']; ?>"},'<?php
echo parse_url_tag("u:deal#getcomments|"."".""); 
?>');
							load_support({id:"<?php echo $this->_var['deal_info']['id']; ?>"},'<?php
echo parse_url_tag("u:deal#getsupports|"."".""); 
?>');
							$(".userComment").hover(function(){
								$(this).find(".delcomment").show();
							},function(){
								$(this).find(".delcomment").hide();
							});

							
							$(".send_btn").click(function(e) {
								if($("#comment_input").val()==''||$("#comment_input").val()=='发表评论') {
									$("#comment_input").focus();
									return;
								}
                                $(this).parent().parent().submit();
                            });
							$(".comment_form").submit(function(e) {
								var _obj=$(this);
                                $.ajax({ 
									url: $(_obj).attr("action"),
									dataType: "json",
									data:$(_obj).serialize(),
									type: "POST",
									success: function(ajaxobj){
										if(ajaxobj.status==1){
											load_comments($(_obj).serialize(),$(_obj).attr("back"));
										}
									},
									error:function(ajaxobj)
									{
										alert("请求错误，请及时联系管理员！");
									}
								});
								return false;
                            });

							
                        //});

							function comment_form_submit(obj){
								var _obj=$(obj);
                                $.ajax({ 
									url: $(_obj).attr("action"),
									dataType: "json",
									data:$(_obj).serialize(),
									type: "POST",
									success: function(ajaxobj){
										if(ajaxobj.status==1){
											load_comments($(_obj).serialize(),$(_obj).attr("back"));
										}
									},
									error:function(ajaxobj)
									{
										alert("请求错误，请及时联系管理员！");
									}
								});
								return false;
							}
	                        
                    </script>
                    
					<div id="project_pinglun" class="deal-show-item clear">
						<div class="center-comment-main">
							<?php if ($this->_var['user_info']): ?>
							<div>
								<form name="comment_form"  class="comment_form" action="<?php
echo parse_url_tag("u:deal#submitcomment|"."id=".$this->_var['deal_info']['id']."".""); 
?>" back="<?php
echo parse_url_tag("u:deal#getcomments|"."id=".$this->_var['deal_info']['id']."".""); 
?>">
								<textarea name="content" id="comment_input" onblur="if(this.value=='') this.value='发表评论'" onfocus="if(this.value=='发表评论') this.value=''" style="min-width:730px; width:730px; max-width:730px;">发表评论</textarea>
								<div class="blank"></div>
								<div class="comment-btn" style="display:block;">
									<div class="ui-button green send_btn" rel="green">
											<div>
												<span>发送</span>
											</div>
									</div>	
									<div class="blank"></div>
								</div>
								<input type="hidden" name="ajax" value="1" />
								</form>
							</div>
							<?php else: ?>
							<div class="comment-content" style="font-size:12px;">请登录后评论，立即 <a href="<?php
echo parse_url_tag("u:user#login|"."".""); 
?>" class="linkgreen">登录</a> 或 <a href="<?php
echo parse_url_tag("u:user#register|"."".""); 
?>"  class="linkgreen">注册</a></div>			
							<?php endif; ?>
							
							<div class="blank"></div>
							
							<div id="ddddd"></div>
							<div class="blank"></div>
							<div class="pages"><?php echo $this->_var['pages']; ?></div>
                            
                            <script type="text/javascript">
								function change_page(obj){
									var action=$(obj).attr("action");
									if(action.indexOf("getcomments")>-1)
										load_comments({id:"<?php echo $this->_var['deal_info']['id']; ?>"},action);
									else if(action.indexOf("getsupports")>-1)
										load_support({id:"<?php echo $this->_var['deal_info']['id']; ?>"},action);
								}
                            </script>
                        </div>
                        	
					</div>
				</div>
			</div>
            
		</div>
		
		<div class="blank"></div>
		
	</div>
</div>
<div id="bdshare_html" style="display:none;">
	<!-- Baidu Button BEGIN -->
	<div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
	<span class="bds_more">分享到：</span>
	<a class="bds_qzone"></a>
	<a class="bds_tsina"></a>
	<a class="bds_tqq"></a>
	<a class="bds_renren"></a>
	<a class="bds_t163"></a>
	<a class="shareCount"></a>
	</div>
	<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=695700" ></script>
	<script type="text/javascript" id="bdshell_js"></script>
	<script type="text/javascript">
	document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
	</script>
	<!-- Baidu Button END -->
</div>

<script type="text/javascript">
function deal_share(user_id)
{
	$.weeboxs.open($("#bdshare_html").html(), {title: '分享',showCancel:false,width:300, showOk:false,type:'wee'});
}
</script>
<div class="blank"></div>
<?php echo $this->fetch('inc/footer.html'); ?> 