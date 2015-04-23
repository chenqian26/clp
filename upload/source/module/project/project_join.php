<?php
/*
  +----------------------------------------------------------------------+
  | Powered by chenqian26                                                |
  +----------------------------------------------------------------------+
  | project_join.php 2015/04/22 22:30:31 CST chenqian26      |
  +----------------------------------------------------------------------+
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}


$uid = C::app()->var['uid'];
$pid = getgpc('pid'); //申请加入项目id
$fid = getgpc('fid');//

if(!$pid)
{
	echo "pid is null";
	exit;
}
$owngroups = C::t('project_info')->fetch_owngroups_by_id($uid);
if(!$owngroups)
{
	showmessage("您并非某个群组的管理员哟","timeline.php",$values=array(),array('timeout'=>true,'refreshtime'=>4));
	//echo "<script>alert('您并非某个群组的管理员哟');</script>";
	//header('Location: timeline.php');
}
if(!$fid)
{
	echo "choose the group you want to join this project<br>";
	foreach ($owngroups as $key => $value)
	{
		echo "<a href='timeline.php?mod=join&pid={$pid}&fid={$value['fid']}'>{$value['name']}<br></a>";
		//echo "<a href="timeline.php?mod=join&pid={$pid}&fid={$value['fid']}">$value['name'].'<br>'";
	}
}
else
{

	require DISCUZ_ROOT.'./source/function/function_project.php';
	if(add_qualification_list($fid,$pid))
	{
		showmessage("报名成功","timeline.php",$values=array(),array('timeout'=>true,'refreshtime'=>4));
	}
	else
	{
		showmessage("您已经报过名了哟","timeline.php",$values=array(),array('timeout'=>true,'refreshtime'=>4));
	}

}

?>
