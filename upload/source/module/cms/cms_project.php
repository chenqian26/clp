<?php
/*
  +----------------------------------------------------------------------+
  | Powered by chenqian26                                                |
  +----------------------------------------------------------------------+
  | project_index.php 2015/04/22 22:28:04 CST chenqian26      |
  +----------------------------------------------------------------------+
 */
/*
$test = array("一等奖"=>array(4,3),"二等奖"=>array(1));
C::t('project_info')->update_winner_list_by_id(json_encode($test,JSON_UNESCAPED_UNICODE),5);
exit;
*/
$projects = C::t('project_info')->fetch_all();
$status['dianshe'] = array('0'=>'初始','1'=>'报名','2'=>'报名截至，待培训','3'=>'培训','4'=>'培训完成，待比赛','5'=>'进行中','6'=>'比赛完成，待成绩公布','7'=>'成绩公布');
$status['chuangxin'] = array('0'=>'初始','1'=>'报名','2'=>'报名截至，待开题','3'=>'开题','4'=>'开题完成，待中期','5'=>'中期','6'=>'中期完成，待结题','7'=>'结题','8'=>'结题，待公布成绩','9'=>'成绩公布');
$status['modianshiyan'] = array('0'=>'初始','1'=>'报名中','2'=>'报名截至，待进行','3'=>'进行中','4'=>'进行中','5'=>'课程结束');

//$uid = C::app()->var['uid'];
//$owngroups = get_owngroups($uid);

foreach($projects as $key => $value)
{	
	$qualification_list = json_decode($value['qualification_list']);
	$projects[$key]['is_joined'] = false;
	foreach($owngroups as $owngroup)
	{
		if(in_array($owngroup['fid'],$qualification_list))
		{
			$projects[$key]['is_joined'] = true;
		}
	}

	$projects[$key]['join_num'] = count($qualification_list);//the number of joined groups
	if($value['winner_list'])
	{
		if($value['limit_people']>1)//team gane
		{
			$winner_list = json_decode($value['winner_list']);

			$winner_list_new = array();

			foreach($winner_list as  $fid)
			{

				$group_name = C::t('forum_forum')->fetch_all_name_by_fid($fid)[$fid]['name'];
				$winner_list_new[$group_name] = array();
				$username = C::t('forum_groupuser')->fetch_all_username_by_fid($fid);
				$winner_list_new[$group_name] = $username;		
			}

			$projects[$key]['winner_list'] = $winner_list_new;
		}

		else //single people
		{

		}
	}

}

//dump($projects);
//exit;




include template('diy:cms/project');
?>
