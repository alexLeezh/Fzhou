<ul class="comment-list" style="margin:0px auto;">
	<?php $_from = $this->_var['comment_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'comment_item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['comment_item']):
?>
		<li class="clear">
             <div>
                 <div class="userPic"><?php 
$k = array (
  'name' => 'show_avatar',
  'p' => $this->_var['comment_item']['user_id'],
  't' => 'small',
);
echo $k['name']($k['p'],$k['t']);
?></div>
                 <div class="userComment" >
                 	<form onsubmit="return delcommentform(this)">
                     <p class="comm-content">
                         <a href="<?php
echo parse_url_tag("u:home|"."id=".$this->_var['comment_item']['user_id']."".""); 
?>"  class="linkgreen"><?php echo $this->_var['comment_item']['user_name']; ?>:</a>&nbsp;<?php 
$k = array (
  'name' => 'nl2br',
  'v' => $this->_var['comment_item']['content'],
);
echo $k['name']($k['v']);
?> &nbsp;&nbsp;<span class="pass_time"><?php 
$k = array (
  'name' => 'pass_date',
  'v' => $this->_var['comment_item']['create_time'],
);
echo $k['name']($k['v']);
?></span>
                     </p>
                     <p class="comm-tools">
                     	
                        <?php if ($this->_var['comment_item']['user_id'] == $this->_var['user_info']['id']): ?>
                        <a href="javascript:void(0);" action="<?php
echo parse_url_tag("u:deal#delcomment|"."id=".$this->_var['comment_item']['id']."".""); 
?>" class="linkgreen delcomment" onclick="delcomment(this)">删除</a>
                        <?php endif; ?>
						<a href="javascript:void(0);" class="linkgreen replycomment" rel="<?php echo $this->_var['comment_item']['id']; ?>" onclick="replycomment(this)">回复</a>	
                        
                     </p>
                     <input type="hidden" name="comment_pid" value="<?php echo $this->_var['comment_item']['id']; ?>" />
                     </form>
                     <div class="comm-re clear">
                     	<form name="comment_<?php echo $this->_var['log_item']['id']; ?>_form" rel="<?php echo $this->_var['comment_item']['log_id']; ?>" onsubmit="return comment_form_submit(this)" back="<?php
echo parse_url_tag("u:deal#getcomments|"."id=".$this->_var['comment_item']['deal_id']."".""); 
?>" class="comment_form" action="<?php
echo parse_url_tag("u:deal#save_comment|"."log_id=".$this->_var['comment_item']['log_id']."&deal_id=".$this->_var['comment_item']['deal_id']."&pid=".$this->_var['comment_item']['id']."".""); 
?>">		
						<div class="reply_content">
							<textarea name="content">回复 <?php echo $this->_var['comment_item']['user_name']; ?>:</textarea>
							<input type="hidden" name="ajax" value="1" />
							<input type="hidden" name="comment_pid" value="<?php echo $this->_var['comment_item']['id']; ?>" />
						</div>
						<div class="blank"></div>
						<div>			
						<div class="ui-button green send_btn" rel="green" onclick="sendclick(this)">
								<div>
									<span>发送</span>
								</div>
						</div>	
						</div>
						<div class="blank"></div>
						
						</form>
                     </div>
                 </div>
             </div>
         </li>
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</ul>

<div class="blank"></div>
<div class="pages"><?php echo $this->_var['pages']; ?></div>