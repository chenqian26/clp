<?php
/*
  +----------------------------------------------------------------------+
  | Powered by chenqian26                                                |
  +----------------------------------------------------------------------+
  | project_index.php 2015/04/22 22:28:04 CST chenqian26      |
  +----------------------------------------------------------------------+
 */

$projects = C::t('project_info')->fetch_all();
$status = array('0'=>'初始','1'=>'报名中','2'=>'培训中','3'=>'进行中','4'=>'未出奖','5'=>'已出奖');

foreach($projects as $key => $value)
{	
	$join_num[]  = count(json_decode($value['qualification_list']));//the number of joined groups
	$winner_list[] = $value['winner_list'];
}


include template('diy:timeline/index');
?>
