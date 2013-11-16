<?php echo $this->fetch('inc/header.html'); ?> 
<link rel="stylesheet" type="text/css" href="<?php echo $this->_var['TMPL']; ?>/css/edit.css"/>
<div class="blank"></div>

<div class="shadow_bg">
	<div class="wrap white_box"">
		<div class="edit-body">
           	<div class="clear"></div>
           	<div  class="edit-tabs">
               	<ul class="clear">
	               	<?php if ($this->_var['user_info']['ex_real_name'] == '' && $this->_var['user_info']['ex_account_info'] == '' && $this->_var['user_info']['ex_contact'] == ''): ?>
					<li class="curr"><a href="<?php
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
                    <li><a href="<?php
echo parse_url_tag("u:settings#account|"."".""); 
?>">方舟账户</a></li>
                    <li><a href="<?php
echo parse_url_tag("u:settings#index|"."".""); 
?>">基本资料</a></li>
                    <li class="set">银行帐户</li>
                </ul>
            </div>
		
			<div class="blank"></div>
			<div class="full">
			<div class="empty_tip">以下信息我们承诺保护用户的隐私，不会公开。信息首次提交后将不可修改，如后期需要修正请联系管理员。</div>
			</div>
			<div class="blank"></div>
			<div class="left">
				<form class="ajax_form" action="<?php
echo parse_url_tag("u:settings#save_bank|"."".""); 
?>">
										
					<div class="form_row">
						<div class="blank15"></div>
						<label class="title w100">真实姓名:</label>
						<input type="text" value="<?php echo $this->_var['user_info']['ex_real_name']; ?>" class="textbox" name="ex_real_name" />
						<div class="blank1"></div>
						<div class="form_tip">与开户行相对应的真实姓名</div>
						<div class="blank15"></div>
					</div>
					<div class="form_row">
						<label class="title w100">开户银行:</label>
						<input type="text" value="<?php echo $this->_var['user_info']['ex_account_bank']; ?>" class="textbox" name="ex_account_bank" />
						<div class="blank1"></div>
						<div class="form_tip">请填写你的开户行信息。</div>
						<div class="blank15"></div>
					</div>
					<div class="form_row">
						<label class="title w100">银行帐号:</label>
						<input type="text" value="<?php echo $this->_var['user_info']['ex_account_info']; ?>" class="textbox" name="ex_account_info" />
						<div class="blank1"></div>
						<div class="form_tip">请填写真实的银行帐号与相关信息。</div>
						<div class="blank15"></div>
					</div>
					<div class="form_row">
						<label class="title w100">联系电话:</label>
						<input type="text" value="<?php echo $this->_var['user_info']['ex_contact']; ?>" class="textbox" name="ex_contact" />
						<div class="blank1"></div>
						<div class="form_tip">请填写手机或电话等有效联系方式</div>
						<div class="blank15"></div>
					</div>
					<div class="form_row">
						<label class="title w100">联系QQ:</label>
						<input type="text" value="<?php echo $this->_var['user_info']['ex_qq']; ?>" class="textbox" name="ex_qq" />
						<div class="blank1"></div>
						<div class="form_tip">请填写真实的QQ号码，以便我们的客服人员能更快捷的联系到您。</div>
						<div class="blank15"></div>
					</div>
					
					
					<div class="submit_btn_row">
						<div class="ui-button green" rel="green">
							<div>
								<span>保存</span>
							</div>
						</div>
						<input type="hidden" value="1" name="ajax" />
						<div class="blank15"></div>
					</div>
					
				</form>
			</div><!--left-->
		
			<div class="blank"></div>
		</div>
	</div>
</div>
<div class="blank"></div>
<?php echo $this->fetch('inc/footer.html'); ?> 