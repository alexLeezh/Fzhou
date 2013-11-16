<?php echo $this->fetch('inc/header.html'); ?> 

<?php
$this->_var['dpagecss'][] = $this->_var['TMPL_REAL']."/css/cart.css";
$this->_var['dpagejs'][] = $this->_var['TMPL_REAL']."/js/switch_city.js";
$this->_var['dcpagejs'][] = $this->_var['TMPL_REAL']."/js/switch_city.js";
$this->_var['dpagejs'][] = APP_ROOT_PATH."/system/region.js";
$this->_var['dcpagejs'][] = APP_ROOT_PATH."/system/region.js";
$this->_var['dpagejs'][] = $this->_var['TMPL_REAL']."/js/consignee.js";
$this->_var['dcpagejs'][] = $this->_var['TMPL_REAL']."/js/consignee.js";
$this->_var['dpagecss'][] = $this->_var['TMPL_REAL']."/css/consignee.css";
$this->_var['dpagejs'][] = $this->_var['TMPL_REAL']."/js/cart.js";
$this->_var['dcpagejs'][] = $this->_var['TMPL_REAL']."/js/cart.js";
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

<div class="shadow_bg">
	<div class="wrap white_box">

			<div class="page_title">
			<?php echo $this->_var['deal_info']['name']; ?>
			<div class="support_price">
				<input name="is_delivery" id="is_delivery" type="hidden" value="<?php echo $this->_var['deal_item']['is_delivery']; ?>" />
				支持金额 <span>¥<?php echo $this->_var['deal_item']['price_format']; ?></span> 元				
				<?php if ($this->_var['deal_item']['is_delivery'] == 1): ?>				
				<font class="delivery_fee">
					<?php if ($this->_var['deal_item']['delivery_fee'] != 0): ?>
					邮费:¥<?php echo $this->_var['deal_item']['delivery_fee_format']; ?>
					<?php else: ?>
					包邮
					<?php endif; ?>
				</font>
				<?php endif; ?>
			</div>
			</div>
			<div class="switch_nav" style="height:1px;"></div>
			
			<div class="public_left">
				<form id="cart_form" action="<?php
echo parse_url_tag("u:cart#check|"."".""); 
?>" method="post">		
				<?php if ($this->_var['deal_item']['is_delivery']): ?>							
					<div class="form_title">
						<div class="f_l">
							收件地址
						</div>
						<?php if ($this->_var['consignee_list']): ?>
						<div class="f_r">
							<div class="ui-button green" rel="green" id="add_consignee" url="<?php
echo parse_url_tag("u:settings#add_consignee|"."".""); 
?>">
									<div>
										<span>添加配送地址</span>
									</div>
							</div>
						</div>	
						<?php endif; ?>
					</div>
					
					<?php if ($this->_var['consignee_list']): ?>
					<?php $_from = $this->_var['consignee_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'consignee');if (count($_from)):
    foreach ($_from AS $this->_var['consignee']):
?>
					<div class="consignee_radio_row">
						<div class="cbo">
							<input type="radio" name="consignee_id" value="<?php echo $this->_var['consignee']['id']; ?>" />
						</div>
						<div class="cnt">
							<?php echo $this->_var['consignee']['province']; ?><?php echo $this->_var['consignee']['city']; ?><?php echo $this->_var['consignee']['address']; ?> <?php echo $this->_var['consignee']['zip']; ?> <?php echo $this->_var['consignee']['consignee']; ?> <?php echo $this->_var['consignee']['mobile']; ?>
						</div>
					</div>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					<?php else: ?>
					<!--begin_consignee-->
					<div class="form_row">
						<div class="blank15"></div>
						<label class="title w100">收货人姓名:</label>
						<input type="text" class="textbox" value="<?php echo $this->_var['consignee_info']['consignee']; ?>" name="consignee" />
						<div class="blank15"></div>
					</div>
					<div class="form_row">
						<label class="title w100">地区:</label>
						
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
						<label class="title w100">详细地址:</label>
						<textarea name="address" class="textarea"><?php echo $this->_var['consignee_info']['address']; ?></textarea>
						<div class="blank15"></div>
					</div>
					
					<div class="form_row">
						<div class="blank15"></div>
						<label class="title w100">邮编:</label>
						<input type="text"  name="zip" class="textbox" value="<?php echo $this->_var['consignee_info']['zip']; ?>" />
						<div class="blank15"></div>
					</div>
					<div class="form_row">
						<div class="blank15"></div>
						<label class="title w100">手机:</label>
						<input type="text"  name="mobile" class="textbox" value="<?php echo $this->_var['consignee_info']['mobile']; ?>" />
						<div class="blank15"></div>
					</div>
					<!--end conignee-->
					<?php endif; ?>
				<?php endif; ?>
				<div class="blank"></div>
				<div class="form_title">
					回报内容
				</div>
				<div class="form_content">
					<?php 
$k = array (
  'name' => 'nl2br',
  'v' => $this->_var['deal_item']['description'],
);
echo $k['name']($k['v']);
?>
				</div>
				<div class="blank"></div>
				<div class="form_title">
					备注信息
				</div>
				<div class="form_content">
				<textarea name="memo" class="textarea">在此填写关于回报内容的具体选择或者任何你想告诉项目发起人的话</textarea>
				</div>
				<div class="blank"></div>
				<div>
					<div class="ui-button green" rel="green">
						<div>
							<span>确定，提交</span>
						</div>
					</div>
					<input type="hidden" name="id" value="<?php echo $this->_var['deal_item']['id']; ?>" />
					<input type="hidden" name="ajax" value="1" />
					<div class="blank15"></div>
				</div>
				
			</form>
				
			</div>
			
			<div class="public_right">
				
				<div class="deal_item_box">
					<div class="deal_content_box">
					<img  src="<?php if ($this->_var['deal_info']['image'] == ''): ?><?php echo $this->_var['TMPL']; ?>/images/empty_thumb.gif<?php else: ?><?php 
$k = array (
  'name' => 'get_spec_image',
  'v' => $this->_var['deal_info']['image'],
  'w' => '205',
  'h' => '160',
  'g' => '1',
);
echo $k['name']($k['v'],$k['w'],$k['h'],$k['g']);
?><?php endif; ?>" />
					<div class="blank"></div>
					<a href="<?php
echo parse_url_tag("u:deal#show|"."id=".$this->_var['deal_info']['id']."".""); 
?>" class="deal_title" title="<?php echo $this->_var['deal_info']['name']; ?>"><?php echo $this->_var['deal_info']['name']; ?></a>
					<div class="blank"></div>
					<a href="<?php
echo parse_url_tag("u:home|"."id=".$this->_var['deal_info']['user_id']."".""); 
?>"><?php echo $this->_var['deal_info']['user_name']; ?></a></a>&nbsp;&nbsp;(<span><a href="<?php
echo parse_url_tag("u:deals|"."loc=".$this->_var['deal_info']['province']."".""); 
?>" title="<?php echo $this->_var['deal_info']['province']; ?>"><?php echo $this->_var['deal_info']['province']; ?></a></span><span><a href="<?php
echo parse_url_tag("u:deals|"."loc=".$this->_var['deal_info']['city']."".""); 
?>" title="<?php echo $this->_var['deal_info']['city']; ?>"><?php echo $this->_var['deal_info']['city']; ?></a></span>)
					<div class="blank"></div>
					<div><?php echo $this->_var['deal_info']['brief']; ?></div>
					</div>
					<div class="deal_item_dash"></div>
					<div class="deal_content_box">
						<div class="ui-progress">
							<span style="width:<?php echo $this->_var['deal_info']['percent']; ?>%;"></span>
						</div>
						<div class="blank"></div>
						<div class="div3"><span class="num"><?php echo $this->_var['deal_info']['percent']; ?>%</span><span class="til">达到</span></div>
						<div class="div3"><span class="num" ><font><?php 
$k = array (
  'name' => 'round',
  'v' => $this->_var['deal_info']['support_amount'],
  'e' => '2',
);
echo $k['name']($k['v'],$k['e']);
?></font>元</span><span class="til">已获支持</span></div>
		
						<div class="div3">
							<?php if ($this->_var['deal_info']['begin_time'] > $this->_var['now']): ?>
							<span class="num">未上线</span>
							<span class="til">剩余时间</span>
							<?php elseif ($this->_var['deal_info']['end_time'] < $this->_var['now'] && $this->_var['deal_info']['end_time'] != 0): ?>
							<span class="num">已过期</span>
							<span class="til">剩余时间</span>
							<?php else: ?>
							<span class="num">
								<?php if ($this->_var['deal_info']['end_time'] == 0): ?>
								长期项目
								<?php else: ?>
								<font><?php echo $this->_var['deal_info']['remain_days']; ?></font>天
								<?php endif; ?>
							</span>
							<span class="til">剩余时间</span>
							<?php endif; ?>					
						</div>
				
						<div class="blank1"></div>
					</div>
				</div>
				
				
				
			</div>
			<div class="blank"></div>
			
	
	</div>
</div>

<div class="blank"></div>
<?php echo $this->fetch('inc/footer.html'); ?> 


