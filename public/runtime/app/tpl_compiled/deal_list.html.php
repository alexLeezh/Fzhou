<?php $_from = $this->_var['deal_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'deal_item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['deal_item']):
?>
	<div class="deal_item_box f_l <?php if ($this->_var['key'] % 4 == 0): ?>first<?php endif; ?>">
			<div class="deal_content_box">
			<a href="<?php
echo parse_url_tag("u:deal#show|"."id=".$this->_var['deal_item']['id']."".""); 
?>" title="<?php echo $this->_var['deal_item']['name']; ?>">
			<img src="<?php if ($this->_var['deal_item']['image'] == ''): ?><?php echo $this->_var['TMPL']; ?>/images/empty_thumb.gif<?php else: ?><?php 
$k = array (
  'name' => 'get_spec_image',
  'v' => $this->_var['deal_item']['image'],
  'w' => '205',
  'h' => '160',
  'g' => '1',
);
echo $k['name']($k['v'],$k['w'],$k['h'],$k['g']);
?><?php endif; ?>" alt="<?php echo $this->_var['deal_item']['name']; ?>" />
			</a>
			<div class="blank"></div>
			<a href="<?php
echo parse_url_tag("u:deal#show|"."id=".$this->_var['deal_item']['id']."".""); 
?>" title="<?php echo $this->_var['deal_item']['name']; ?>" class="deal_title"><?php 
$k = array (
  'name' => 'msubstr',
  'v' => $this->_var['deal_item']['name'],
  'b' => '0',
  'e' => '25',
);
echo $k['name']($k['v'],$k['b'],$k['e']);
?></a>
			<div class="blank"></div>
			<div class="deal_loc">
			<?php if ($this->_var['deal_item']['user_name'] == ''): ?><?php else: ?>
			<a href="<?php
echo parse_url_tag("u:home|"."id=".$this->_var['deal_item']['user_id']."".""); 
?>"><?php echo $this->_var['deal_item']['user_name']; ?></a>&nbsp;&nbsp;
			<?php endif; ?>
			<?php if ($this->_var['deal_item']['province'] != '' || $this->_var['deal_item']['city'] != ''): ?>
			(
			<?php if ($this->_var['deal_item']['province'] != ''): ?>
			<span><a href="<?php
echo parse_url_tag("u:deals|"."loc=".$this->_var['deal_item']['province']."".""); 
?>" title="<?php echo $this->_var['deal_item']['province']; ?>"><?php echo $this->_var['deal_item']['province']; ?></a></span>
			<?php endif; ?>
			<?php if ($this->_var['deal_item']['city'] != ''): ?>
			<span><a href="<?php
echo parse_url_tag("u:deals|"."loc=".$this->_var['deal_item']['city']."".""); 
?>" title="<?php echo $this->_var['deal_item']['city']; ?>"><?php echo $this->_var['deal_item']['city']; ?></a></span>
			<?php endif; ?>
			)
			<?php endif; ?>
			</div>
			<div class="blank"></div>
			<div class="deal_brief" title="<?php echo $this->_var['deal_item']['brief']; ?>"><?php 
$k = array (
  'name' => 'msubstr',
  'v' => $this->_var['deal_item']['brief'],
  'b' => '0',
  'e' => '45',
);
echo $k['name']($k['v'],$k['b'],$k['e']);
?></div>
			</div>
			<div class="deal_item_dash"></div>
			<div class="deal_content_box">				
				<div class="ui-progress">
					<span style="width:<?php echo $this->_var['deal_item']['percent']; ?>%;"></span>
				</div>			
				<div class="blank"></div>
				<div class="div3"><span class="num"><?php echo $this->_var['deal_item']['percent']; ?>%</span><span class="til">达到</span></div>
				<div class="div3"><span class="num" ><font><?php 
$k = array (
  'name' => 'round',
  'v' => $this->_var['deal_item']['support_amount'],
  'e' => '2',
);
echo $k['name']($k['v'],$k['e']);
?></font>元</span><span class="til">已获支持</span></div>
				<div class="div3">
					<?php if ($this->_var['deal_item']['begin_time'] > $this->_var['now']): ?>
					<span class="num">未上线</span>
					<span class="til">剩余时间</span>
					<?php elseif ($this->_var['deal_item']['end_time'] < $this->_var['now'] && $this->_var['deal_item']['end_time'] != 0): ?>
					<span class="num">已过期</span>
					<span class="til">剩余时间</span>
					<?php else: ?>
					<span class="num">
						<?php if ($this->_var['deal_item']['end_time'] == 0): ?>
						长期项目
						<?php else: ?>
						<font><?php echo $this->_var['deal_item']['remain_days']; ?></font>天
						<?php endif; ?>
					</span>
					<span class="til">剩余时间</span>
					<?php endif; ?>					
				</div>
				<div class="blank1"></div>
			</div>
	</div>
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>