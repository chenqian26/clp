<?php
/*
  +----------------------------------------------------------------------+
  | Powered by chenqian26                                                |
  +----------------------------------------------------------------------+
  | table_project_info.php 2015/04/21 16:06:56 CST chenqian26      |
  +----------------------------------------------------------------------+
*/


if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_project_info extends discuz_table
{
    public function __construct() {

        $this->_table = 'project_info';
        $this->_pk    = 'id';

        parent::__construct();
    }

    public function fetch_all() {
        return DB::fetch_all('SELECT * FROM '.DB::table($this->_table)." t");
    }

    public function fetch_by_id($id) {
        return DB::fetch_all('SELECT * FROM '.DB::table($this->_table)." where id ='".$id."'");
    }
    public function fetch_owngroups_by_id($id) {
        return DB::fetch_all("SELECT clp_forum_forum.name,clp_forum_forum.fid FROM clp_forum_forum RIGHT JOIN  `clp_forum_groupuser` ON clp_forum_forum.fid=clp_forum_groupuser.fid where clp_forum_groupuser.uid='".$id."'  and clp_forum_groupuser.level=1");
    }

    public function fetch_limit_people_by_id($id) {

        return DB::result_first("SELECT limit_people FROM %t WHERE id=%d", array($this->_table, $id));
  }

    public function update_qualification_list_by_id($qualification_list,$id) {

        DB::query("UPDATE ".DB::table($this->_table)." SET qualification_list='".$qualification_list."' where id = ".$id);
    }

    public function update_common_data_by_id($id,$name,$status,$type,$limit_people) {
        DB::query("UPDATE ".DB::table($this->_table)." SET name='".$name."' ,status='".$status."' ,type='".$type."' ,limit_people='".$limit_people."' where id = '".$id."'");
    
    }

    public function fetch_participant_by_fid($fid) {
        return DB::fetch_all('SELECT * FROM '.DB::table($this->_table)." where fid ='".$fid."'");
    }
    public function insert($name,$type,$status,$limit_people) {
        $project = array(
        'name' => $name,
        'type' => $type,
        'status' => intval($status),
        'limit_people' => intval($limit_people),
      );
        parent::insert($project, false, true);
    }

    public function delete_by_fids($id) {
        return DB::delete($this->_table, DB::field('id', $id));
  }


}

?>
