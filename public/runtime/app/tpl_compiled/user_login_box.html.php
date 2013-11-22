<?php
$this->_var['dpagejs'][] = $this->_var['TMPL_REAL']."/js/ajax_user_login.js";
$this->_var['dcpagejs'][] = $this->_var['TMPL_REAL']."/js/ajax_user_login.js";
?>
<script type="text/javascript" src="<?php 
$k = array (
  'name' => 'parse_script',
  'v' => $this->_var['dpagejs'],
  'c' => $this->_var['dcpagejs'],
);
echo $k['name']($k['v'],$k['c']);
?>"></script>

<div class="signlogin_box">
			<div class="left">
				
				<div class="link_dash f25">
					登录
				</div>
				<form id="user_login_form" name="user_login_form" action="<?php
echo parse_url_tag("u:user#do_login|"."".""); 
?>">
					
				<div class="form_row">
					<div class="blank15"></div>
					<label class="title"><font>*&nbsp;&nbsp;</font>帐号:</label>
					<input type="text" value="邮箱或者用户名" class="textbox" name="email"/>
					<div class="blank15"></div>
				</div>
				<div class="form_row">
					<label class="title"><font>*&nbsp;&nbsp;</font>密码:</label>
					<input type="password" name="user_pwd"  class="textbox" />
					<span class="getpassword"><a href="<?php
echo parse_url_tag("u:user#getpassword|"."".""); 
?>">忘记密码 ？</a></span>
					<div class="blank15"></div>
				</div>
				<div class="form_row auto_login">
					<input type="checkbox" value="1" name="auto_login" checked="checked" /> 
					<label class="auto_login_tip">下次自动登录</label>
					<div class="blank15"></div>
				</div>
				
				<div class="button_row do_login">
					<input type="button" value="" name="submit_form" class="btn_do_login" id="btn_do_login" />
					<input type="hidden" value="1" name="ajax" />
					<div class="blank15"></div>
				</div>
				
				</form>
			</div>
			
			<div class="right">
				<!--<div class="link_dash f16">
					快速通过微博帐号登录					
				</div>		
				<div class="blank"></div>		
				<?php 
$k = array (
  'name' => 'api_login',
);
echo $this->_hash . $k['name'] . '|' . base64_encode(serialize($k)) . $this->_hash;
?>-->
				<span class="no_account_tip">还没有账号？</span>
				<a href="<?php
echo parse_url_tag("u:user#register|"."".""); 
?>" class="btn_go_register" title="立即注册"></a>
				
			</div>
			<div class="blank"></div>
			
		</div>