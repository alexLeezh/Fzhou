<div class="blank"></div>
<div class="page_title">
			<?php echo $this->_var['deal_info']['name']; ?>
</div>
<div class="blank"></div>		
<div class="switch2_nav" style="position:relative;">
	
<!--	<a class="ui-button green" style="float:right;" rel="green" href="<?php
echo parse_url_tag("u:deal#supports|"."id=".$this->_var['deal_info']['id']."".""); 
?>">
		<div>
			<span>支持项目</span>
		</div>
	</a>-->
	<?php if ($this->_var['is_focus']): ?>
	<div class="ui-button gray focus_deal" rel="gray" id="<?php echo $this->_var['deal_info']['id']; ?>">
		<div>
			<span>取消关注</span>
		</div>
	</div>
	<?php else: ?>
	<div class="ui-button blue focus_deal" rel="blue" id="<?php echo $this->_var['deal_info']['id']; ?>">
		<div>
			<span>立即关注</span>
		</div>
	</div>
	<?php endif; ?>
	<a class="ui-button green" style="float:right;" rel="green" onclick="deal_share(1)">
		<div>
			<span>转发</span>
		</div>
	</a>
	<ul>
    	<li <?php if (ACTION_NAME == 'supports' || ACTION_NAME == 'supportdetail'): ?>class="current"<?php endif; ?>><a href="<?php
echo parse_url_tag("u:deal#supports|"."id=".$this->_var['deal_info']['id']."".""); 
?>">项目回报</a></li>	
		<li <?php if (ACTION_NAME == 'show'): ?>class="current"<?php endif; ?>><a href="<?php
echo parse_url_tag("u:deal#show|"."id=".$this->_var['deal_info']['id']."".""); 
?>">基本信息</a></li>
	<!--	<li <?php if (ACTION_NAME == 'video'): ?>class="current"<?php endif; ?>><a href="<?php
echo parse_url_tag("u:deal#video|"."id=".$this->_var['deal_info']['id']."".""); 
?>">视频</a></li>-->
			
	</ul>
		
</div>