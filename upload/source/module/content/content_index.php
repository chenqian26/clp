<?php
/*
  +----------------------------------------------------------------------+
  | Powered by chenqian26                                                |
  +----------------------------------------------------------------------+
  | project_index.php 2015/04/22 22:28:04 CST chenqian26      |
  +----------------------------------------------------------------------+
 */

$id = getgpc('a') ? getgpc('a') : 1;


$contents = C::t('portal_article_title')->range();


foreach($contents as $key =>$value)
{
	if($value['pic'])
	{	
	$contents[$key]['pic']= pic_get($value['pic'], '', $value['thumb'], $value['remote'], 1, 1);
	}
	$contents[$key]['dateline']= dgmdate($value['dateline']);
	$contents[$key]['link'] = 'portal.php?mod=view&	aid='.$value['aid']; 

}
$contents[2] = $contents[0];
$contents[2]['aid'] = 5;

$contents[3] = $contents[0];
$contents[3]['aid'] = 6;

$contents[4] = $contents[0];
$contents[4]['aid'] = 7;

$contents[5] = $contents[0];
$contents[6]['aid'] = 8;

$contents[6] = $contents[0];
$contents[6]['aid'] = 9;

//exit;
//print_r($_G[setting][navs]);
//exit;



foreach($contents as $key => $value)
{	
	//$join_num[]  = count(json_decode($value['qualification_list']));//the number of joined groups
	//$winner_list[] = $value['winner_list'];
}


include template('diy:content/index');
?>
