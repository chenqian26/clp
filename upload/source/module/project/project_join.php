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
	showmessage("pid is null","timeline.php",$values=array(),array('timeout'=>true,'refreshtime'=>4));
	exit;
}

$owngroups = C::t('project_info')->fetch_owngroups_by_id($uid);

if(!$owngroups)
{
	showmessage("您并非某个群组的管理员哟","timeline.php",$values=array(),array('timeout'=>true,'refreshtime'=>4));
	exit;
	//echo "<script>alert('您并非某个群组的管理员哟');</script>";
	//header('Location: timeline.php');
}

if(!$fid)
{
	showmessage("no fid","timeline.php",$values=array(),array('timeout'=>true,'refreshtime'=>4));
	/*
	echo "choose the group you want to join this project<br>";
	foreach ($owngroups as $key => $value)
	{
		echo "<a href='timeline.php?mod=join&pid={$pid}&fid={$value['fid']}'>{$value['name']}<br></a>";
		//echo "<a href="timeline.php?mod=join&pid={$pid}&fid={$value['fid']}">$value['name'].'<br>'";
	}
	*/
}

	
$total_num = C::t('forum_groupuser')->fetch_count_by_fid($fid);
$limit_num = C::t('project_info')->fetch_limit_people_by_id($pid);

if($total_num<$limit_num )
	{
		showmessage("参赛队伍人数不符合要求","timeline.php",$values=array(),array('timeout'=>true,'refreshtime'=>4));
		exit;
	}


	if(add_qualification_list($fid,$pid))
	{
		showmessage("报名成功","timeline.php",$values=array(),array('timeout'=>true,'refreshtime'=>4));
	}
	else
	{
		showmessage("您已经报过名了哟","timeline.php",$values=array(),array('timeout'=>true,'refreshtime'=>4));
	}



?>
