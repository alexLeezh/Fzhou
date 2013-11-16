<?php echo $this->fetch('inc/header.html'); ?> 
<?php
$this->_var['dpagecss'][] = $this->_var['TMPL_REAL']."/css/index.css";
$this->_var['dpagecss'][] = $this->_var['TMPL_REAL']."/css/projects.css";
$this->_var['dpagejs'][] = $this->_var['TMPL_REAL']."/js/index.js";
$this->_var['dcpagejs'][] = $this->_var['TMPL_REAL']."/js/index.js";
$this->_var['dpagejs'][] = $this->_var['TMPL_REAL']."/js/discover.js";
$this->_var['dcpagejs'][] = $this->_var['TMPL_REAL']."/js/discover.js";

$this->_var['dpagejs'][] = $this->_var['TMPL_REAL']."/js/jquery-1.4.2.min";
$this->_var['dpagejs'][] = $this->_var['TMPL_REAL']."/js/jquery.masonry.js";
$this->_var['dpagejs'][] = $this->_var['TMPL_REAL']."/js/jquery.infinitescroll.js";
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

<script type="text/javascript" src="<?php echo $this->_var['TMPL']; ?>/js/jquery.masonry.js"></script>
<script type="text/javascript" src="<?php echo $this->_var['TMPL']; ?>/js/jquery.infinitescroll.js"></script>

<script type="text/javascript">
function item_masonry(){ 
	$('.projectItem img').load(function(){ 
		$('.infinite_scroll').masonry({ 
			itemSelector: '.masonry_brick',
			columnWidth:283,
			gutterWidth:20								
		});		
	});
		
	$('.infinite_scroll').masonry({ 
		itemSelector: '.masonry_brick',
		columnWidth:283,
		gutterWidth:20								
	});	
}

$(document).ready(function(){ 
	item_masonry();	
	$('.projectItem').fadeIn();

});
</script>

<div class="blank"></div>


<div>
	<div class="container projects-search">
    	<div class="project-filter clear">
        	<div class="clear">
                <div class="filter-acts">
                    <select id="c" class="select" style="display: none" name=c> 
                        <option value="rec" selected>推荐项目</option> 
                        <option value="new">最新项目</option> 
                        <option value="classic">本周热门</option> 
                        <option value="success">最近成功</option> 
                        <option value="soon">即将成功</option>
                        <option value="end">即将结束</option>
                    </select>
                    <script type="text/javascript" src="<?php echo $this->_var['TMPL']; ?>/js/jQselect.js"></script>
	                <SCRIPT type=text/javascript>
	                    $(document).ready(function() {
	                        $("#c").selectbox();
	                    });
	                </SCRIPT>
                </div>
                <div class="filter-tags">
                	<a href="<?php
echo parse_url_tag("u:index|"."id=".""); 
?>" <?php if ($this->_var['p_id'] == $this->_var['cate_item']['id']): ?>class="curr"<?php endif; ?> title="全部项目">全部项目</a>
                    <?php $_from = $this->_var['cate_hot_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cate_item');if (count($_from)):
    foreach ($_from AS $this->_var['cate_item']):
?>
	                <a href="<?php
echo parse_url_tag("u:index|"."id=".$this->_var['cate_item']['id']."".""); 
?>" title="<?php echo $this->_var['cate_item']['name']; ?>"><?php echo $this->_var['cate_item']['name']; ?></a>
	                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </div>
            </div>
            <div class="filter-tags-others clear" style="display:block;">
                <div class="filter-tags clear">
                    <?php $_from = $this->_var['cate_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cate_item');if (count($_from)):
    foreach ($_from AS $this->_var['cate_item']):
?>
					<a href="<?php
echo parse_url_tag("u:index|"."id=".$this->_var['cate_item']['id']."".""); 
?>" <?php if ($this->_var['p_id'] == $this->_var['cate_item']['id']): ?>class="curr"<?php endif; ?> title="<?php echo $this->_var['cate_item']['name']; ?>"><?php echo $this->_var['cate_item']['name']; ?></a>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </div>
            </div>
        </div>
        
        
      <div class="projects-filter-list clear infinite_scroll">
            <div class="index-project-list clear">
        	<?php echo $this->fetch('inc/deal_list_index.html'); ?>
        	</div>
        
            
        </div>
        
        <div class="blank clear"></div>
        <div id="pin_loading" rel="<?php
echo parse_url_tag("u:ajax#index|"."r=".$this->_var['p_r']."&id=".$this->_var['p_id']."&loc=".$this->_var['p_loc']."&tag=".$this->_var['p_tag']."&k=".$this->_var['p_k']."&p=".$this->_var['current_page']."".""); 
?>">正在努力加载</div>	
        <div class="pages"><?php echo $this->_var['pages']; ?></div>
        
    </div>
</div>



<script type="text/javascript" src="<?php echo $this->_var['TMPL']; ?>/js/deals_index.js"></script>

<?php echo $this->fetch('inc/footer.html'); ?> 