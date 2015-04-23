<?php
/*
  +----------------------------------------------------------------------+
  | Powered by chenqian26                                                |
  +----------------------------------------------------------------------+
  | function_project.php 2015/04/22 17:34:28 CST chenqian26      |
  +----------------------------------------------------------------------+
 */
if(!defined('IN_DISCUZ')) {
        exit('Access Denied');
}

function add_qualification_list($fid,$id)//群组id及项目id
{
    $project = C::t('project_info')->fetch_by_id($id);
    $list = json_decode($project[0]['qualification_list']);
    if(!in_array($fid,$list,true))//以后看是否需要考虑数组
    {
        $list[] = $fid;
        $list = json_encode($list);
        C::t('project_info')->update_qualification_list_by_id($list,$id);
        return true;
    }

    return false;   
}

function remove_qualification_list($fid,$id)
{
    $project = C::t('project_info')->fetch_by_id($id);
    $list = json_decode($project[0]['qualification_list']);
    echo "coming";
    if(in_array($fid,$list,true))
    {
        foreach($list as $key => $value)
        {
            if($value==$fid)
            {
            unset($list[$key]);
            
            }
        
        }
        $list = json_encode($list);
        C::t('project_info')->update_qualification_list_by_id($list,$id);
    }

}


?>
