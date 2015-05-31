<?php
/*
  +----------------------------------------------------------------------+
  | Powered by chenqian26                                                |
  +----------------------------------------------------------------------+
  | cms_post.php 2015/05/25 12:26:06 CST chenqian26      |
  +----------------------------------------------------------------------+
*/
 if($_GET['action']=='delete')
{
	C::t('project_info')->delete($_POST['delete_id']);
}

else if($_GET['action']=='select')
{

	$project = C::t('project_info')->fetch_by_id($_POST['update_id']);
	echo json_encode($project,JSON_UNESCAPED_UNICODE);
}

else if($_GET['action']=='update_project')
{
    C::t('project_info')->update_common_data_by_id($_POST['id'],$_POST['name'],$_POST['status'],$_POST['type'],$_POST['limit_people']);
    header("Location: cms.php");
}

?>
