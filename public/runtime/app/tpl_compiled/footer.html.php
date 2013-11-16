<!-- backtop代码开始 -->
<a id="gotop" href="javascript:void(0)"></a>
<!-- backtop代码结束 -->

<div class="blank"></div>

<div>
    <div class="footer">
        <div class="container">
            <ul class="footer-ul clear">
                <li class="site-about">
                    <p><a href="#"><img src="<?php echo $this->_var['TMPL']; ?>/images/logo.jpg" /></a></p>
                    <p><?php echo $this->_var['site_foot_desc']; ?></p>
                    <p>
                        <?php $_from = $this->_var['helps']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'help');if (count($_from)):
    foreach ($_from AS $this->_var['help']):
?>
                        <a href="<?php echo $this->_var['help']['url']; ?>" title="<?php echo $this->_var['help']['title']; ?>"><?php echo $this->_var['help']['title']; ?></a>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </p>
                </li>
                <li class="site-help">
                    <ul class="footer-question">
                        <li>
                        
                            <p class="footer-title">我的方舟</p>
                            <p><?php echo $this->_var['site_foot_my']; ?></p>
                        </li>
                        <li>
                        
                            <p class="footer-title">常见问题</p>
                            <p><?php echo $this->_var['site_foot_question']; ?></p>
                        </li>
                        <li>
                        
                            <p class="footer-title">项目发布</p>
                            <p><?php echo $this->_var['site_foot_project']; ?></p>
                        </li>
                    </ul>
                </li>
                <li class="site-copy">
                    <p class="foot-site-buttons clear"><?php echo $this->_var['site_foot_way']; ?></p>
                    <p class="foot-copy">
                        <?php 
$k = array (
  'name' => 'app_conf',
  'v' => 'SITE_LICENSE',
);
echo $k['name']($k['v']);
?>
                    </p>
                </li>
            </ul>
        </div>
    </div>
</div>
