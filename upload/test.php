<?php
require_once '.source/include/common.inc.php';

if(!defined('IN_DISCUZ')) { exit('Access Denied'); }
if(!$discuz_uid) {
 showmessage('not_loggedin', NULL, 'NOPERM');
}
$card = $db->fetch_first("SELECT a.username,a.groupid,c.grouptitle,a.credits,a.extcredits1,a.extcredits2 FrOM sszcdb_members a,sszcdb_usergroups c where a.uid='$discuz_uid' and a.groupid=c.groupid ");
include template('test');//加载模板缓存，请在template/default/下建立test.htm
?>

