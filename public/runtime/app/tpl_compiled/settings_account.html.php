<?php echo $this->fetch('inc/header.html'); ?> 
<?php
$this->_var['dpagejs'][] = $this->_var['TMPL_REAL']."/js/refund.js";
$this->_var['dcpagejs'][] = $this->_var['TMPL_REAL']."/js/refund.js";
$this->_var['dpagecss'][] = $this->_var['TMPL_REAL']."/css/account.css";
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
                    <li><a href="<?php
echo parse_url_tag("u:settings#bind|"."".""); 
?>">绑定社交网络</a></li>
                    <li><a href="<?php
echo parse_url_tag("u:settings#consignee|"."".""); 
?>">配送地址</a></li>
                    <li class="curr"><a href="<?php
echo parse_url_tag("u:settings#incharge|"."".""); 
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
							
				<div class="edit-user-info">
                   	<?php echo $this->fetch('inc/money_box.html'); ?> 
                </div>

	
			</div><!--left-->
			
			
			<div class="blank"></div>
		</div>
	</div>
</div>
<div class="blank"></div>
<?php echo $this->fetch('inc/footer.html'); ?> 