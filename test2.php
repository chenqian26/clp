<?php
require './upload/source/class/class_core.php';
$fid = 2;
echo 'begin';
try
{
$forum = C::t('forum_forum')->fetch_info_by_fid($fid);
echo 'right';
}
catch(Exception $e) 
{
echo 'wrong';
}
if($forum)
{
echo 'OK';
exit;
}
else
{
echo 'NOT';
exit;
}
echo $forum;
?>
