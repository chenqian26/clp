<?php
if (! defined ( 'IN_DISCUZ' )) {
	exit ( 'Access Denied' );
}
$_G['setting']['switchwidthauto']=1;
$_G['setting']['allowwidthauto']=0;
include libfile ( 'function/forumlist' );
$uid = $_G ['uid'];
$config = $_G ['cache'] ['plugin'] ['liangjianwenwen'];
$fid = $config ['wenwenbk'];
$title = $config ['title'];
$keywords = $config ['keywords'];
$description = $config ['description'];
$tid1 = $config ['tid1'];
$tid1 = explode ( ',', $tid1 );
$tid1 = array_unique ( $tid1 );
$tid1 = array_filter ( $tid1 );
$tid1 = dimplode ( $tid1 );
$tid2 = $config ['tid2'];
$tid2 = explode ( ',', $tid2 );
$tid2 = array_unique ( $tid2 );
$tid2 = array_filter ( $tid2 );
$tid2 = dimplode ( $tid2 );
$tid3 = $config ['tid3'];
$tid3 = explode ( ',', $tid3 );
$tid3 = array_unique ( $tid3 );
$tid3 = array_filter ( $tid3 );
$tid3 = dimplode ( $tid3 );
$tupian1 = $config ['tupian1'];
$tupian2 = $config ['tupian2'];
$tupian3 = $config ['tupian3'];
$tid4 = $config ['tid4'];
$tid5 = $config ['tid5'];
$tid6 = $config ['tid6'];
$guanggao = $config ['guanggao'];
$wendajf = 'extcredits' . $config ['wendajf'];
if (empty ( $config ['wendajf'] )) 
{
	$wendajf = '';
}

if ($tid4) 
{
	$im1 = DB::fetch_first ( ' select * from ' . DB::table ( 'forum_post' ) . "  where fid=$fid and invisible!='-1' and first=1 and tid in ($tid4)" );
}
if ($tid5) 
{
	$im2 = DB::fetch_first ( ' select * from ' . DB::table ( 'forum_post' ) . "  where fid=$fid and invisible!='-1' and first=1 and tid in ($tid5)" );
}

if ($tid6) 
{
	$im3 = DB::fetch_first ( ' select * from ' . DB::table ( 'forum_post' ) . "  where fid=$fid and invisible!='-1' and first=1 and tid in ($tid6)" );
}

if ($tid1) 
{
	$con1 = " where fid=$fid and first=1 and invisible!='-1'";
	$con1 .= " and tid in ($tid1)";
	$con1 .= "  limit 0,3";
	$wwarr = DB::fetch_all ( ' select * from ' . DB::table ( 'forum_post' ) . "  $con1 " );
}

if ($tid2) 
{
	$ggarr = DB::fetch_all ( ' select * from ' . DB::table ( 'forum_post' ) . " where first=1 and invisible!='-1' and fid=$fid and tid in ($tid2) limit 0,3" );
}

if ($tid3) 
{
	$ffarr = DB::fetch_all ( ' select * from ' . DB::table ( 'forum_post' ) . " where  fid=$fid and invisible!='-1' and first=1 and tid in ($tid3) limit 0,3" );
}
$xsarr = DB::fetch_all ( ' select * from ' . DB::table ( 'forum_thread' ) . " where fid=$fid and displayorder<>'-1' AND displayorder<>'-2' AND displayorder<>'-3' AND displayorder<>'-4' AND authorid>'0' and special=3 and price>'0' order by price desc limit 0,10" );
$yjarr = DB::fetch_all ( ' select * from ' . DB::table ( 'forum_thread' ) . " where fid=$fid and displayorder<>'-1' AND displayorder<>'-2' AND displayorder<>'-3' AND displayorder<>'-4' AND authorid>'0' and special=3 and price<'0' order by price desc limit 0,10" );
$djarr = DB::fetch_all ( ' select * from ' . DB::table ( 'forum_thread' ) . " where fid=$fid and displayorder<>'-1' AND displayorder<>'-2' AND displayorder<>'-3' AND displayorder<>'-4' AND authorid>'0' and special=3 and price>'0'  order by tid desc limit 0,10" );
$zeroarr = DB::fetch_all ( ' select * from ' . DB::table ( 'forum_thread' ) . " where fid=$fid and displayorder<>'-1' AND displayorder<>'-2' AND displayorder<>'-3' AND displayorder<>'-4' AND authorid>'0' and special=3 and price>'0' and replies='0' order by tid desc limit 0,10" );

$ztarr = DB::fetch_first ( ' select threadtypes from ' . DB::table ( 'forum_forumfield' ) . " where fid=$fid" );
$bkarr = DB::fetch_first ( ' select * from ' . DB::table ( 'forum_forum' ) . " where fid=$fid" );


$brnum = DB::fetch_first ( "select count(*),authorid from " . DB::table ( 'forum_post' ) . " WHERE   first!='1' AND fid IN(" . $fid . ") and curdate()=FROM_UNIXTIME(dateline,'%Y-%m-%d') group by authorid order by count(*) desc" );
$bruid = $brnum ['authorid'];
$bnum = $brnum ['count(*)'];

if ($bruid) 
{	
	$myarr = DB::fetch_first ( ' select username,groupid from ' . DB::table ( 'common_member' ) . " where uid=$bruid " );
	$xingming = $myarr ['username'];
	$groupid = $myarr ['groupid'];
	$wenda_best=wenda_cainalv($bruid,$fid);
	$num=$wenda_best['bestnum'];
	$best=$wenda_best['bestpid'];
	$cainalv =$wenda_best['cainalv'];//回答人采纳率
	$allbest=$wenda_best['allbest'];
	if($groupid){
		$stars = DB::result_first ( ' select stars from ' . DB::table ( 'common_usergroup' ) . " where groupid=$groupid " );
	}
}else{	
	$myarr = DB::fetch_first ( ' select username,groupid from ' . DB::table ( 'common_member' ) . " where uid= ".$config['uid'] );
	$xingming = $myarr ['username'];
	$groupid = $myarr ['groupid'];
	$wenda_best=wenda_cainalv($config['uid'],$fid);
	$num=$wenda_best['bestnum'];
	$best=$wenda_best['bestpid'];
	$cainalv =$wenda_best['cainalv'];//回答人采纳率
	$allbest=$wenda_best['allbest'];
	if($groupid){
		$stars = DB::result_first ( ' select stars from ' . DB::table ( 'common_usergroup' ) . " where groupid=$groupid " );
	}
	$bruid=$config['uid'];
}
$threadtypes = unserialize ( $ztarr ['threadtypes'] );
$types = $threadtypes ['types'];
$typestr1 = '[';
$checksign = 1;
foreach ( $types as $k => $v ) {
	
	$typestr1 .= '"' . $v . '|' . $k . '",';
	if(!$config['istwo']){
		if ($checksign >= 2) {
			break;
		}
	}
	
	$checksign ++;
}

$typestr1 .= ']';
$checksign = 1;
if(!$config['istwo']){
	if (count ( $types ) > 2) {
		$typestr2 = '[';
		foreach ( $types as $k => $v ) {
			if ($checksign > 2) {
				$typestr2 .= '"' . $v . '|' . $k . '",';
			}
			$checksign ++;
		}
		$typestr2 .= ']';
	} else {
		$typestr2 = '[]';
	}
}else{
	$typestr2 = '[]';
}
if ($wendajf) {
	//$pmarr = DB::fetch_all ( "select a.username,a.uid,b.$wendajf from " . DB::Table ( 'common_member' ) . " a left join " . DB::table ( 'common_member_count' ) . " b on a.uid=b.uid  ORDER BY b.$wendajf DESC limit 0,10 " );
	$pmarr=DB::fetch_all(" select * from ".DB::table("common_member_count")." order by $wendajf desc limit 0,10");
}
$navtitle = $title;
$metakeywords = $keywords;
$metadescription = $description;
include template ( 'liangjianwenwen:wenwen' );

//....
function getturl($tid) {
	global $_G;
	$web_root = $_G ['siteurl'];
	if (substr ( $web_root, - 1 ) != '/') {
		$web_root = $web_root . '/';
	}
	$rewriterule = $_G ['setting'] ['rewriterule'];
	$status = $_G ['setting'] ['rewritestatus'];
	if (in_array ( 'forum_viewthread', $status )) {
		$mod = $rewriterule ['forum_viewthread'];
		$mod = preg_replace ( "/{page}/", "1", $mod );
		$mod = preg_replace ( "/{prevpage}/", "1", $mod );
		$mod = str_replace ( "{id}", $tid, $mod );
		$mod = str_replace ( "{tid}", $tid, $mod );
		$turl = $web_root . $mod;
	} else {
		$turl = $web_root . "forum.php?mod=viewthread&amp;tid=" . $tid;
	}
	return $turl;
}

function getfurl($fid) {
	global $_G;
	$web_root = $_G ['siteurl'];
	if (substr ( $web_root, - 1 ) != '/') {
		$web_root = $web_root . '/';
	}
	$rewriterule = $_G ['setting'] ['rewriterule'];
	$status = $_G ['setting'] ['rewritestatus'];
	if (in_array ( 'forum_forumdisplay', $status )) {
		$mod = $rewriterule ['forum_forumdisplay'];
		$mod = preg_replace ( "/{page}/", "1", $mod );
		$mod = preg_replace ( "/{prevpage}/", "1", $mod );
		$mod = str_replace ( "{id}", $fid, $mod );
		$mod = str_replace ( "{fid}", $fid, $mod );
		$mod = str_replace ( "{tid}", $fid, $mod );
		$mod = str_replace ( "{blogid}", $fid, $mod );
		$turl = $web_root . $mod;
	} else {
		$turl = $web_root . "forum.php?mod=forumdisplay&amp;fid=" . $fid;
	}
	return $turl;
}
function wenda_cainalv($uid,$fid){
	$wenda_tid=DB::fetch_all('select * from '.DB::table('forum_post')." where  authorid=".$uid." and fid=".$fid." and invisible='0' and first!=1");
	
	foreach($wenda_tid as $w_tid){
		$wenda_tids.=$w_tid['tid']. ',';
	}
	$wenda_tids = explode ( ',', $wenda_tids );
	$wenda_tids = array_unique ( $wenda_tids );
	$wenda_tids = array_filter($wenda_tids);
	$bestnum=count($wenda_tids);
	
	$bestarr=DB::fetch_all('select * from '.DB::table('forum_post')." a left join ".DB::table('forum_thread')." b on a.tid=b.tid where  b.special='3' and a.fid=".$fid." and a.dateline = b.dateline+1 and b.displayorder>='0' and a.authorid=".$uid." $conn order by a.tid desc");
	
	
	foreach($bestarr as $k=>$v){
		if($k>1){
			break;
		}
		$allbest[]=$v;
	}
	$bestpid=count($bestarr);
	//debug($bestpid);
	$cainalv = round ( ($bestpid / $bestnum) * 100 ) . '%';//回答人采纳率
	return array('bestnum'=>$bestnum,'bestpid'=>$bestpid,'cainalv'=>$cainalv,'allbest'=>$allbest);
}
?>
