<?php
/*
  +----------------------------------------------------------------------+
  | Powered by chenqian26                                                |
  +----------------------------------------------------------------------+
  | cms_post.php 2015/05/25 12:26:06 CST chenqian26      |
  +----------------------------------------------------------------------+
*/
 if($_GET['action']=='new_project')
{

	C::t('project_info')->insert($_POST['name'],$_POST['type'],$_POST['status'],$_POST['limit_people']);
	showmessage("新增项目成功","cms.php",$values=array(),array('timeout'=>true,'refreshtime'=>4));
}
?>
