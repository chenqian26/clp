<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$diynav = <<<EOF

<a href="javascript:openDiy();" title="打开 DIY 面板" onmouseover="showMenu(this.id)">{$comeing_lang['0']}</a>
<div id="diy-tg_menu" style="display: none;">
<ul>
<li><a href="javascript:saveUserdata('diy_advance_mode', '');openDiy();" class="xi2">简洁模式</a></li>
<li><a href="javascript:saveUserdata('diy_advance_mode', '1');openDiy();" class="xi2">高级模式</a></li>
</ul>
</div>

EOF;
?>