<?php $_from = $this->_var['support_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'support_item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['support_item']):
?>
<div class="support-item <?php if (( $this->_var['key'] + 1 ) % 2 == 0): ?>support-item-last<?php endif; ?>">
	<div class="support-log-info">
		感谢 <a href="<?php
echo parse_url_tag("u:home|"."id=".$this->_var['support_item']['user_id']."".""); 
?>" class="linkgreen"><?php echo $this->_var['support_item']['user_info']['user_name']; ?></a> 对本项目的支持，您将获得
	</div>
	<div class="support-img">
		
		<?php $_from = $this->_var['support_item']['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('index', 'image');if (count($_from)):
    foreach ($_from AS $this->_var['index'] => $this->_var['image']):
?>
		
		<a href="javascript:;" title="<?php echo $this->_var['support_item']['description']; ?>"><img alt="" src="<?php 
$k = array (
  'name' => 'get_spec_image',
  'v' => $this->_var['image']['image'],
  'w' => '158',
  'h' => '120',
  'g' => '1',
);
echo $k['name']($k['v'],$k['w'],$k['h'],$k['g']);
?>" rel="<?php 
$k = array (
  'name' => 'get_spec_image',
  'v' => $this->_var['image']['image'],
  'w' => '158',
  'h' => '120',
);
echo $k['name']($k['v'],$k['w'],$k['h']);
?>" width=158 height=120 />
		</a>

		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		<a href="javascript:;" class="button">支持 <?php 
$k = array (
  'name' => 'format_price',
  'v' => $this->_var['support_item']['support_price'],
);
echo $k['name']($k['v']);
?> 金额</a>
	</div>
	
	<div class="blank1"></div>
</div>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

<div class="blank"></div>
<div class="pages"><?php echo $this->_var['support_pages']; ?></div>
