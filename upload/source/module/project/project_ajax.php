<?php
/*
  +----------------------------------------------------------------------+
  | Powered by chenqian26                                                |
  +----------------------------------------------------------------------+
  | project_ajax.php 2015/05/3 22:28:04 CST chenqian26      |
  +----------------------------------------------------------------------+
*/
$status_dianshe = array('0'=>'初始','1'=>'报名中','2'=>'培训中','3'=>'进行中','4'=>'未出奖','5'=>'已出奖');
$status_chuangxin = array('0'=>'初始','1'=>'','2'=>'培训中','3'=>'进行中','4'=>'未出奖','5'=>'已出奖');
$status_modianshiyan = array('0'=>'初始','1'=>'报名中','2'=>'培训中','3'=>'进行中','4'=>'未出奖','5'=>'已出奖');

header('Content-Type:text/html; charset=utf-8');
$post_data = $_POST['trans_data'];
$projects = C::t('project_info')->fetch_all();

//if(!strpos($post_data,"winner_list"))
if(strpos($post_data,"winner_list")!==false)
{
$status = array('0'=>'初始','1'=>'报名中','2'=>'培训中','3'=>'进行中','4'=>'未出奖','5'=>'已出奖');


  foreach($projects as $key => $value)
  { 
    $projects[$key]['join_num'] = count(json_decode($value['qualification_list']));//the number of joined groups
    if($value['winner_list'])
    {
       if($value['limit_people']>1)//team gane
       {
              $winner_list = json_decode($value['winner_list']);
              $winner_list_new = array();
            
              foreach($winner_list as $reward=>$list)
              {
                  foreach($list as  $fid)
                  {
                      $group_name = C::t('forum_forum')->fetch_all_name_by_fid($fid)[$fid]['name'];
                      $winner_list_new[$reward][$group_name] = array();
                      $username = C::t('forum_groupuser')->fetch_all_username_by_fid($fid);
                      $winner_list_new[$reward][$group_name] = $username;
                  }

              }
        $projects[$key]['winner_list'] = $winner_list_new; 
       }

       else //single people
       {

       }
    }
  }

$id = intval(substr($post_data,11));
$projects[$id]['winner_list'] = json_encode($projects[$id]['winner_list'], JSON_UNESCAPED_UNICODE);
echo json_encode($projects[$id], JSON_UNESCAPED_UNICODE);

}

elseif(strpos($post_data,"join")!==false)
{
  $uid = C::app()->var['uid'];
  $id = intval(substr($post_data,4));
  $owngroups = C::t('project_info')->fetch_owngroups_by_id($uid);
  foreach($owngroups as $key=>$value)
  {
    $owngroups[$key]['join_pid'] = $projects[$id]['id'];

  }
  echo json_encode($owngroups,JSON_UNESCAPED_UNICODE);
}


//$winner_list = array($projects[$id]['winner_list'] => $projects[$id]['name'];




?>
