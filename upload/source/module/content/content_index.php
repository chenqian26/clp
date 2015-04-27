<?php
/*
  +----------------------------------------------------------------------+
  | Powered by chenqian26                                                |
  +----------------------------------------------------------------------+
  | project_index.php 2015/04/22 22:28:04 CST chenqian26      |
  +----------------------------------------------------------------------+
 */

$id = getgpc('a') ? getgpc('a') : 1;

$contents = C::t('content_info')->fetch_by_id($id);



foreach($contents as $key => $value)
{	
	//$join_num[]  = count(json_decode($value['qualification_list']));//the number of joined groups
	//$winner_list[] = $value['winner_list'];
}


include template('diy:content/index');
?>
