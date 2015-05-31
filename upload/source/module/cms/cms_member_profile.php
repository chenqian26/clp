<?php
/*
  +----------------------------------------------------------------------+
  | Powered by chenqian26                                                |
  +----------------------------------------------------------------------+
  | cms_member_profile.php 2015/05/26 12:51:59 CST chenqian26      |
  +----------------------------------------------------------------------+
*/
 $projects = C::t('project_info')->fetch_all();

foreach($projects as $key => $value)
  { 

    $projects[$key]['join_num'] = count(json_decode($value['qualification_list']));//the number of joined groups

    if($value['qualification_list'])
    {
    	$qualification_list = json_decode($value['qualification_list']);
    	$qualification_list_new = array();
    	foreach($qualification_list as $fid)
    	{
    		$group_name = C::t('forum_forum')->fetch_all_name_by_fid($fid)[$fid]['name'];
    		//$qualification_list_new[$group_name] = array();
    		//$username = C::t('forum_groupuser')->fetch_all_username_by_fid($fid);
    		//$qualification_list_new[$group_name][$username] = $username;
    		$uid = C::t('forum_groupuser')->fetch_all_uid_by_fid($fid);

    		$member_info = C::t('common_member_profile')->fetch_all($uid);
    		foreach($member_info as $key2=>$value2)
    		{
    		    	$member_info[$key2]['group_name'] = $group_name;	
    		}	
    		$qualification_list_new[] = $member_info;
    		//dump($qualification_list_new);
    		
    	}
    	$projects[$key]['qualification_list'] = $qualification_list_new; 

    }

     if($value['competition_list'])
    {
    	$competition_list = json_decode($value['competition_list']);
    	$competition_list_new = array();

    	foreach($competition_list as $fid)
    	{
    		$group_name = C::t('forum_forum')->fetch_all_name_by_fid($fid)[$fid]['name'];
    		//$competition_list_new[$group_name] = array();
    		//$username = C::t('forum_groupuser')->fetch_all_username_by_fid($fid);
    		//$qualification_list_new[$group_name][$username] = $username;
    		$uid = C::t('forum_groupuser')->fetch_all_uid_by_fid($fid);

    		$member_info = C::t('common_member_profile')->fetch_all($uid);
    		foreach($member_info as $key2=>$value2)
    		{
    		    	$member_info[$key2]['group_name'] = $group_name;	
    		}	

    		$competition_list_new[] = $member_info;
    		
    	}
    	$projects[$key]['competition_list'] = $competition_list_new; 
    }

/*
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
*/
}
//dump($projects);
//exit;

$index = $_GET['index'] ? $_GET['index'] : 0 ;

$data = $projects[$index];

  include template('diy:cms/member_profile');
?>
