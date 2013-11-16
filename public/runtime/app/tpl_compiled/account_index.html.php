<?php echo $this->fetch('inc/header.html'); ?> 
<?php
$this->_var['dpagejs'][] = $this->_var['TMPL_REAL']."/js/order_list.js";
$this->_var['dcpagejs'][] = $this->_var['TMPL_REAL']."/js/order_list.js";
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
<div class="blank"></div>

<div class="shadow_bg">
	<div class="wrap white_box"">
		<div class="page_title">
			支持的项目
		</div>
		<div class="switch_nav">
			<ul>
				<li class="current"><a href="<?php
echo parse_url_tag("u:account#index|"."".""); 
?>">支持的项目</a></li>
				<li><a href="<?php
echo parse_url_tag("u:account#project|"."".""); 
?>">我的项目</a></li>
				<li><a href="<?php
echo parse_url_tag("u:account#focus|"."".""); 
?>">关注的项目</a></li>
				<li><a href="<?php
echo parse_url_tag("u:account#credit|"."".""); 
?>">收支明细</a></li>
				
			</ul>
		</div>
		
		<div class="blank"></div>
		
		<?php echo $this->fetch('inc/money_box.html'); ?> 
		
		<div class="full">
		<?php if ($this->_var['order_list']): ?>
		<table class="data-table">
			<tr>
				<th>项目名称</th>
				<th width="50">金额</th>
				<th width="50">运费</th>
				<th width="120">状态</th>
				<th width="120">操作</th>
			</tr>
			<?php $_from = $this->_var['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'order_item');if (count($_from)):
    foreach ($_from AS $this->_var['order_item']):
?>
			<tr>
				<td class="deal_name">
				<?php if ($this->_var['order_item']['deal_info']): ?>
					<div><a href="<?php
echo parse_url_tag("u:deal#show|"."id=".$this->_var['order_item']['deal_id']."".""); 
?>" target="_blank" title="<?php echo $this->_var['order_item']['deal_name']; ?>"><img src="<?php 
$k = array (
  'name' => 'get_spec_image',
  'v' => $this->_var['order_item']['deal_info']['image'],
  'w' => '50',
  'h' => '50',
  'g' => '1',
);
echo $k['name']($k['v'],$k['w'],$k['h'],$k['g']);
?>"  alt="<?php echo $this->_var['order_item']['deal_name']; ?>"/></a></div>	
					<div><a href="<?php
echo parse_url_tag("u:deal#show|"."id=".$this->_var['order_item']['deal_id']."".""); 
?>" target="_blank" title="<?php echo $this->_var['order_item']['deal_name']; ?>"><?php 
$k = array (
  'name' => 'msubstr',
  'v' => $this->_var['order_item']['deal_name'],
  'b' => '0',
  'e' => '25',
);
echo $k['name']($k['v'],$k['b'],$k['e']);
?></a></div>	
				<?php else: ?>
					<div><span title="<?php echo $this->_var['order_item']['deal_name']; ?>"><?php 
$k = array (
  'name' => 'msubstr',
  'v' => $this->_var['order_item']['deal_name'],
  'b' => '0',
  'e' => '25',
);
echo $k['name']($k['v'],$k['b'],$k['e']);
?></span></div>	
				<?php endif; ?>
				</td>
				<td>
					<?php 
$k = array (
  'name' => 'format_price',
  'v' => $this->_var['order_item']['deal_price'],
);
echo $k['name']($k['v']);
?>
				</td>
				<td>
					<?php if ($this->_var['order_item']['delivery_fee'] == 0): ?>
					--
					<?php else: ?>
					<?php 
$k = array (
  'name' => 'format_price',
  'v' => $this->_var['order_item']['delivery_fee'],
);
echo $k['name']($k['v']);
?>
					<?php endif; ?>
				</td>
				<td>			
					<?php if ($this->_var['order_item']['order_status'] == 0): ?>
					已用余额支付<?php 
$k = array (
  'name' => 'format_price',
  'v' => $this->_var['order_item']['credit_pay'],
);
echo $k['name']($k['v']);
?><br />剩余支付未完成
					<?php else: ?>		
					<?php if ($this->_var['order_item']['deal_info']): ?>
				
							<?php if ($this->_var['order_item']['deal_info']['is_success'] == 1): ?>
								<?php if ($this->_var['order_item']['deal_info']['begin_time'] > $this->_var['now']): ?>未开始<?php endif; ?>
								<?php if ($this->_var['order_item']['deal_info']['end_time'] < $this->_var['now'] && $this->_var['order_item']['deal_info']['end_time'] != 0): ?>已成功&nbsp;<?php if ($this->_var['order_item']['repay_time'] > 0): ?>回报已发放<?php else: ?>等待发放回报<?php endif; ?><?php endif; ?>
								<?php if ($this->_var['order_item']['deal_info']['begin_time'] < $this->_var['now'] && ( $this->_var['order_item']['deal_info']['end_time'] > $this->_var['now'] || $this->_var['order_item']['deal_info']['end_time'] == 0 )): ?>已成功&nbsp;<?php if ($this->_var['order_item']['repay_time'] > 0): ?>回报已发放<?php else: ?>等待发放回报<?php endif; ?><?php endif; ?>
							<?php else: ?>
								<?php if ($this->_var['order_item']['deal_info']['begin_time'] > $this->_var['now']): ?>未开始<?php endif; ?>
								<?php if ($this->_var['order_item']['deal_info']['end_time'] < $this->_var['now'] && $this->_var['order_item']['deal_info']['end_time'] != 0): ?>未成功&nbsp;<?php if ($this->_var['order_item']['is_refund'] == 1): ?>已退款<?php else: ?>等待退款<?php endif; ?><?php endif; ?>
								<?php if ($this->_var['order_item']['deal_info']['begin_time'] < $this->_var['now'] && ( $this->_var['order_item']['deal_info']['end_time'] > $this->_var['now'] || $this->_var['order_item']['deal_info']['end_time'] == 0 )): ?>未结束<?php endif; ?>
							<?php endif; ?>
				
					<?php else: ?>
						<?php if ($this->_var['order_item']['is_success'] == 0): ?>
						未成功&nbsp;<?php if ($this->_var['order_item']['repay_time'] > 0): ?>回报已发放<?php else: ?>等待发放回报<?php endif; ?>
						<?php else: ?>
						已成功&nbsp;<?php if ($this->_var['order_item']['is_refund'] == 1): ?>已退款<?php else: ?>等待退款<?php endif; ?>
						<?php endif; ?>
					<?php endif; ?>
					<?php endif; ?>
				</td>
				<td>
					<?php if ($this->_var['order_item']['order_status'] == 0): ?>
						<a href="<?php
echo parse_url_tag("u:account#view_order|"."id=".$this->_var['order_item']['id']."".""); 
?>">继续支付</a>
						<a href="<?php
echo parse_url_tag("u:account#del_order|"."id=".$this->_var['order_item']['id']."".""); 
?>" class="del_deal">删除</a>
					<?php else: ?>
						<a href="<?php
echo parse_url_tag("u:account#view_order|"."id=".$this->_var['order_item']['id']."".""); 
?>">查看详情</a>
					<?php endif; ?>
				</td>
			</tr>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</table>
		
		<?php else: ?>
		<div class="empty_tip">
			还没有任何支持记录
		</div>
		<?php endif; ?>
		
		</div>
		<div class="blank"></div>
		<div class="pages"><?php echo $this->_var['pages']; ?></div>
		<div class="blank"></div>
		
		<div class="blank"></div>
		
	</div>
</div>
<div class="blank"></div>
<?php echo $this->fetch('inc/footer.html'); ?> 