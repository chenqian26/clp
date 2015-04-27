<?php

define('CURSCRIPT', 'content');

require './source/class/class_core.php';

if(!defined('IN_DISCUZ')) {
        exit('Access Denied');
}

$modarray = array('join');

$mod = !in_array(C::app()->var['mod'],$modarray)? 'index' : C::app()->var['mod'];
define('CURMODULE',$mod);

$discuz = C::app();

$cachelist = array('grouptype', 'groupindex', 'diytemplatenamegroup');
$discuz->cachelist = $cachelist;
$discuz->init();



require DISCUZ_ROOT.'./source/module/content/content_'.$mod.'.php';
/*
foreach ($_G[setting][navs] as $key=>$value)
{
echo $key;
echo $value[navname];
}
exit;
 */

?>
