<?php echo $this->fetch('inc/header.html'); ?> 
<?php
$this->_var['dpagejs'][] = $this->_var['TMPL_REAL']."/js/api_bind.js";
$this->_var['dcpagejs'][] = $this->_var['TMPL_REAL']."/js/api_bind.js";

?>

<script type="text/javascript" src="<?php 
$k = array (
  'name' => 'parse_script',
  'v' => $this->_var['dpagejs'],
  'c' => $this->_var['dcpagejs'],
);
echo $k['name']($k['v'],$k['c']);
?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_var['TMPL']; ?>/css/edit.css"/>
<div class="blank"></div>

<div class="shadow_bg">
	<div class="wrap white_box"">
		<div class="edit-body">
           	<div class="clear"></div>
           	<div  class="edit-tabs">
               	<ul class="clear">
	               	<?php if ($this->_var['user_info']['ex_real_name'] == '' && $this->_var['user_info']['ex_account_info'] == '' && $this->_var['user_info']['ex_contact'] == ''): ?>
					<li><a href="<?php
echo parse_url_tag("u:settings#bank|"."".""); 
?>">银行帐户</a></li>
					<?php endif; ?>
                   	<li><a href="<?php
echo parse_url_tag("u:settings#password|"."".""); 
?>">安全设置</a></li>
                    <li class="curr"><a href="<?php
echo parse_url_tag("u:settings#bind|"."".""); 
?>">绑定社交网络</a></li>
                    <li><a href="<?php
echo parse_url_tag("u:settings#consignee|"."".""); 
?>">配送地址</a></li>
                    <li><a href="<?php
echo parse_url_tag("u:settings#account|"."".""); 
?>">方舟账户</a></li>
                    <li><a href="<?php
echo parse_url_tag("u:settings#index|"."".""); 
?>">基本资料</a></li>
                    <li class="set">绑定社交网络</li>
                </ul>
            </div>
		
			<div class="blank"></div>
			
			<div class="left">
					<div class="blank15"></div>
								
					<?php $_from = $this->_var['api_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'api_item');if (count($_from)):
    foreach ($_from AS $this->_var['api_item']):
?>		
					<div class="form_row">
						
						<?php if ($this->_var['api_item']['is_bind']): ?>
						<label class="title w100"><?php echo $this->_var['api_item']['dispname']; ?>:</label>
						<input type="text" class="textbox" value="<?php echo $this->_var['api_item']['weibo_url']; ?>" disabled="true" />
						<div class="ui-button green" rel="green" style="margin-left:10px;" url="<?php
echo parse_url_tag("u:settings#unbind|"."c=".$this->_var['api_item']['class_name']."".""); 
?>">
							<div>
								<span>取消绑定</span>
							</div>
						</div>
						<?php else: ?>
						<label class="title w100"><?php echo $this->_var['api_item']['dispname']; ?>:</label>					
						<div class="ui-button green" rel="green" style="margin-left:10px;" url="<?php echo $this->_var['api_item']['url']; ?>">
							<div>
								<span>立即绑定</span>
							</div>
						</div>
						<?php endif; ?>
						<div class="blank15"></div>
					</div>
					
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					
	
			</div><!--left-->
			
			
			<div class="blank"></div>
		</div>
	</div>
</div>
<div class="blank"></div>
<?php echo $this->fetch('inc/footer.html'); ?> 