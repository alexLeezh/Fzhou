<?php 
$k = array (
  'name' => 'show_ke_topic',
  'v' => $this->_var['text_name'],
  'w' => $this->_var['width'],
  'h' => $this->_var['height'],
  'cnt' => $this->_var['cnt'],
);
echo $k['name']($k['v'],$k['w'],$k['h'],$k['cnt']);
?>
