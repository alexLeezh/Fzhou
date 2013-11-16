<?php $_from = $this->_var['deal_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'deal_item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['deal_item']):
?>
	<div class="projectItem <?php if (( $this->_var['key'] + 1 ) % 4 == 0): ?>lastProjectItem<?php endif; ?> masonry_brick">
		<p class="projectPic">
	    	<a href="<?php
echo parse_url_tag("u:deal#show|"."id=".$this->_var['deal_item']['id']."".""); 
?>" title="<?php echo $this->_var['deal_item']['name']; ?>">
			<img src="<?php if ($this->_var['deal_item']['image'] == ''): ?><?php echo $this->_var['TMPL']; ?>/images/empty_thumb.gif<?php else: ?><?php 
$k = array (
  'name' => 'get_spec_image',
  'v' => $this->_var['deal_item']['image'],
  'w' => '283',
  'h' => '410',
  'g' => '1',
);
echo $k['name']($k['v'],$k['w'],$k['h'],$k['g']);
?><?php endif; ?>" alt="<?php echo $this->_var['deal_item']['name']; ?><?php echo $this->_var['deal_item']['id']; ?>" />
			</a>
	    </p>
	    <div class="projectInfo">
	        <p class="projectATitle">
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
	        </p>
	        <p class="projectTags">
	        	<?php $_from = $this->_var['deal_item']['tags_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'tag');if (count($_from)):
    foreach ($_from AS $this->_var['tag']):
?>
				<?php if (trim ( $this->_var['tag'] ) != ''): ?>
				<a href="<?php
echo parse_url_tag("u:deals|"."k=".$this->_var['tag']."".""); 
?>" title="<?php echo $this->_var['tag']; ?>"><?php echo $this->_var['tag']; ?></a>
				<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	        </p>
	        <p class="projectDesc"><?php 
$k = array (
  'name' => 'msubstr',
  'v' => $this->_var['deal_item']['brief'],
  'b' => '0',
  'e' => '50',
);
echo $k['name']($k['v'],$k['b'],$k['e']);
?></p>
	    </div>
	    <div class="projectStatus">
	    	<div class="projectProgreeNo">
	            <span class="fl">已筹得<?php 
$k = array (
  'name' => 'round',
  'v' => $this->_var['deal_item']['support_amount'],
  'e' => '2',
);
echo $k['name']($k['v'],$k['e']);
?>元</span> 
	            <span class="fr">
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
	            </span>
	        </div>
	    	<div class="cc-progress_container">
	            <div class="cc-progress_bar"  style="width:<?php if ($this->_var['deal_item']['percent'] <= 12): ?>26px<?php elseif ($this->_var['deal_item']['percent'] >= 100): ?>100%<?php else: ?><?php echo $this->_var['deal_item']['percent']; ?>%<?php endif; ?>;" title="<?php echo $this->_var['deal_item']['percent']; ?>%">
	            	<span class="cc-projress_scroll fr"><?php echo $this->_var['deal_item']['percent']; ?>%</span>
	            </div>
	        </div>
	    </div>
	</div>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>


<script type="text/javascript">
          $(document).ready(function(){ 
              /*$('.cc-progress_bar').each(function(index, element) {
                  var percent = $(this).attr('title');
                  var _l=percent.substr(0,percent.indexOf("%"));
                  if(!isNaN(_l)&&parseInt(_l)<=12) $(this).animate({width:26},1000);
else if(!isNaN(_l)&&parseInt(_l)>=100) $(this).animate({width:'100%'},1000);
                  else $(this).animate({width:percent},1000);
              });*/
              
			  
          });
</script>