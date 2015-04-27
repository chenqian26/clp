<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_liangjianwenwen {

	
}
class plugin_liangjianwenwen_forum extends plugin_liangjianwenwen {
		function misc_liangjianwenwen(){
			
			if($_GET['action']=='bestanswer'&&$_GET['formhash']==formhash()){
				global $_G;
				$config = $_G['cache']['plugin']['liangjianwenwen'];
				$wendajf='extcredits'.$config['wendajf'];
				$zuijiadaan=$config['zuijiadaan'];
				$wwbestanswersubmit = addslashes($_GET['bestanswersubmit']);
				$wwpid = intval($_GET['pid']);
				if ($wwbestanswersubmit == 'yes') {
					$wwuid = DB::result_first("SELECT authorid FROM ".DB::table('forum_post')." WHERE pid = '$wwpid'");
					updatemembercount($wwuid , array($wendajf => $zuijiadaan));
				}
			}
		}
		

}
?>