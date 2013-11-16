<?php echo $this->fetch('inc/header.html'); ?> 
<?php
$this->_var['dpagejs'][] = $this->_var['TMPL_REAL']."/js/avatar.js";
$this->_var['dcpagejs'][] = $this->_var['TMPL_REAL']."/js/avatar.js";
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
                    <li><a href="<?php
echo parse_url_tag("u:settings#account|"."".""); 
?>">方舟账户</a></li>
                    <li class="curr"><a href="<?php
echo parse_url_tag("u:settings#index|"."".""); 
?>">基本资料</a></li>
                    <li class="set">基本资料</li>
                </ul>
            </div>
		
			<div class="blank"></div>
			
			<div class="left">
				<form class="ajax_form" action="<?php
echo parse_url_tag("u:settings#save_index|"."".""); 
?>">
										
					<div class="form_row">
						<div class="blank15"></div>
						<label class="title w100">会员帐号:</label>
						<input type="text" value="<?php echo $this->_var['user_info']['user_name']; ?>" class="textbox" disabled="true" />
						<div class="blank15"></div>
					</div>
					<div class="form_row">
						<label class="title w100">电子邮箱:</label>
						<input type="text" value="<?php echo $this->_var['user_info']['email']; ?>" class="textbox" disabled="true" />
						<div class="blank15"></div>
					</div>
					<div class="form_row">
						<label class="title w100">性别:</label>
						<div class="select_box">
						<select name="sex">
							<option value="-1" <?php if ($this->_var['user_info']['sex'] == - 1): ?>selected="selected"<?php endif; ?>>未知</option>
							<option value="1" <?php if ($this->_var['user_info']['sex'] == 1): ?>selected="selected"<?php endif; ?>>男</option>
							<option value="0" <?php if ($this->_var['user_info']['sex'] == 0): ?>selected="selected"<?php endif; ?>>女</option>
						</select>
						</div>
						<div class="blank15"></div>
					</div>
					<div class="form_row">
						<label class="title w100">所在地:</label>
						<div class="select_box">
						<select name="province">				
						<option value="" rel="0">请选择省份</option>			
						<?php $_from = $this->_var['region_lv2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'region');if (count($_from)):
    foreach ($_from AS $this->_var['region']):
?>
							<option value="<?php echo $this->_var['region']['name']; ?>" rel="<?php echo $this->_var['region']['id']; ?>" <?php if ($this->_var['region']['selected']): ?>selected="selected"<?php endif; ?>><?php echo $this->_var['region']['name']; ?></option>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						</select>
						
						<select name="city">				
						<option value="" rel="0">请选择城市</option>
						<?php $_from = $this->_var['region_lv3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'region');if (count($_from)):
    foreach ($_from AS $this->_var['region']):
?>
							<option value="<?php echo $this->_var['region']['name']; ?>" rel="<?php echo $this->_var['region']['id']; ?>" <?php if ($this->_var['region']['selected']): ?>selected="selected"<?php endif; ?>><?php echo $this->_var['region']['name']; ?></option>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						</select>
						</div>
						<div class="blank15"></div>
					</div>
					<div class="form_row">
						<label class="title w100">自我介绍:</label>
						<textarea name="intro" class="textarea"><?php echo $this->_var['user_info']['intro']; ?></textarea>
						<div class="blank1"></div>
						<div class="form_tip">这里可以输入大约300字的自我介绍，让大家多了解你</div>
						<div class="blank15"></div>
					</div>
					
					<div class="form_row">
						<label class="title w100">博客或微博:</label>
						<div class="f_l">
							<div  id="weibo_list">
							<?php if ($this->_var['weibo_list']): ?>
							<?php $_from = $this->_var['weibo_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'weibo_item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['weibo_item']):
?>
								<div>
								<input type="text" value="<?php echo $this->_var['weibo_item']['weibo_url']; ?>" class="textbox" name="weibo_url[]" />
								<?php if ($this->_var['key'] > 0): ?>
								<a href="javascript:void(0);" class="del_weibo form_link_btn"  onclick="del_weibo(this);">删除</a>
								<?php endif; ?>
								<div class="blank"></div>
								</div>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
							<?php else: ?>
								<div>
								<input type="text" value="" class="textbox" name="weibo_url[]" />							
								<div class="blank"></div>
								</div>
							<?php endif; ?>
							</div>
							<a href="javascript:void(0);" class="more_weibo form_link_btn" onclick="add_weibo();">更多</a>
						</div>
						<div class="blank15"></div>
					</div>
					
					<div class="submit_btn_row">
						<div class="ui-button green" rel="green">
							<div>
								<span>保存最新的设置</span>
							</div>
						</div>
						<input type="hidden" value="1" name="ajax" />
						<div class="blank15"></div>
					</div>
					
				</form>
			</div><!--left-->
			<div class="right">
				个人头像
				<div class="blank"></div>
				<img id="avatar" src="<?php 
$k = array (
  'name' => 'get_user_avatar',
  'uid' => $this->_var['user_info']['id'],
  'type' => 'middle',
);
echo $k['name']($k['uid'],$k['type']);
?>" />
				<div class="blank"></div>
				<label class="fileupload" onclick="upd_file(this,'avatar_file',<?php echo $this->_var['user_info']['id']; ?>);">
				<input type="file" class="filebox" name="avatar_file" id="avatar_file"/>
				
				</label>
				<label class="fileuploading hide" ></label>
			</div>
		</div>
		<div class="blank"></div>
		
	</div>
</div>
<div class="blank"></div>
<?php echo $this->fetch('inc/footer.html'); ?> 