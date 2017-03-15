<?php
require(dirname(__FILE__)."/"."global.php");
if(!$page){
	$page = 1;
}
$rows = 24;
$end = $rows * ($page-1);
unset($listdb);
$listdb = array();
if ($sort=='hits'){
	$sql= 'hits';
}elseif ($sort=='time'){
	$sql='regdate';
}else {
	$sql='hits';
}
$query = $db->query("SELECT uid,username,icon,hits,money,groupid,regdate FROM {$pre}memberdata WHERE yz=1 ORDER BY {$sql} DESC LIMIT $end,$rows");
$link_hits = ($sort=='hits' || !$sort) ? "<a href='?sort=hits' style='color:#F00'>按浏览量排序</a>" : "<a href='?sort=hits'>按浏览量排序</a>";
$link_time = $sort=='time' ? "<a href='?sort=time' style='color:#F00'>按注册时间排序</a>" : "<a href='?sort=time'>按注册时间排序</a>";
$showpage=getpage("{$pre}memberdata","WHERE yz=1","listmember.php?sort={$sort}",$rows);	//分页
while($rs = $db->fetch_array($query)){
	$rs[icon] = tempdir($rs[icon]);
	$rs[grouptitle] = $ltitle[$rs[groupid]];
	$rs[regdate] = date("Y-m-d",$rs[regdate]);
	$listdb[] = $rs;
}
require(ROOT_PATH."inc/head.php");
require(html("listmember"));
require(ROOT_PATH."inc/foot.php");
?>