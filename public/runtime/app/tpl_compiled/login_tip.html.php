<?php if ($this->_var['user_info']): ?>
	<a href="<?php
echo parse_url_tag("u:home|"."id=".$this->_var['user_info']['id']."".""); 
?>"><img class="user_pic" src="<?php 
$k = array (
  'name' => 'get_user_avatar',
  'uid' => $this->_var['user_info']['id'],
  'type' => 'middle',
);
echo $k['name']($k['uid'],$k['type']);
?>"/></a>&nbsp;
	<a href="#" id="mymessage"><img src="<?php echo $this->_var['TMPL']; ?>/images/bell.gif"/></a>&nbsp;
	<a href="#" id="mycenter"><img src="<?php echo $this->_var['TMPL']; ?>/images/shape.gif"/></a>&nbsp;
	
	
	<?php if ($this->_var['USER_NOTIFY_COUNT'] > 0 || $this->_var['USER_MESSAGE_COUNT'] > 0): ?>
	<?php if ($this->_var['HIDE_USER_NOTIFY'] == 0): ?>
	<div id="user_notify_tip" style="position:absolute; z-index:1; display:none;">		
		<div class="notify_tip_box" id="close_user_notify">
			<div class="close_user_notify"></div>
			<?php if ($this->_var['USER_NOTIFY_COUNT'] > 0): ?>
			<span><a href="<?php
echo parse_url_tag("u:notify|"."".""); 
?>">您有 <font><?php echo $this->_var['USER_NOTIFY_COUNT']; ?></font> 条新通知</a></span>
			<?php endif; ?>
			<?php if ($this->_var['USER_MESSAGE_COUNT'] > 0): ?>
			<span><a href="<?php
echo parse_url_tag("u:message|"."".""); 
?>">您有 <font><?php echo $this->_var['USER_MESSAGE_COUNT']; ?></font> 条新信息</a></span>
			<?php endif; ?>
		</div>
	</div>
	<?php endif; ?>
	<?php endif; ?>

	<div id="mymessage_drop" style="position:absolute; display:none;">
		<div class="drop_box">
			<span><a href="<?php
echo parse_url_tag("u:news#fav|"."".""); 
?>">关注动态</a></span>
			<span><a href="<?php
echo parse_url_tag("u:comment|"."".""); 
?>">查看评论</a></span>
			<span><a href="<?php
echo parse_url_tag("u:message|"."".""); 
?>">查看私信</a></span>
			<span><a href="<?php
echo parse_url_tag("u:notify|"."".""); 
?>">查看通知</a></span>

		</div>
	</div>
	<div id="mycenter_drop" style="position:absolute; display:none;">
		<div class="drop_box">
			<span><a href="<?php
echo parse_url_tag("u:account|"."".""); 
?>">项目管理</a></span>
			<span><a href="<?php
echo parse_url_tag("u:settings|"."".""); 
?>">个人设置</a></span>
			<span><a href="<?php
echo parse_url_tag("u:user#loginout|"."".""); 
?>" title="退出" id="user_login_out">退出</a></span>
		</div>
	</div>
	
<?php else: ?>
	<div style="margin-top:8px;">
		<a href="<?php
echo parse_url_tag("u:user#login|"."".""); 
?>" title="登录">登录</a>&nbsp;&nbsp;|&nbsp;&nbsp;	
		<a href="<?php
echo parse_url_tag("u:user#register|"."".""); 
?>" title="注册">注册</a>&nbsp;&nbsp;			
		<span class="api_login_tip" id="api_login_tip">使用其他帐号登录</span>
		
		<div id="api_login_tip_drop" style="position:absolute; display:none;">
			<div class="api_drop_box">
				<?php echo $this->_var['api_login']; ?>
			</div>
		</div>
	</div>
<?php endif; ?>
