<?php
$url=urlencode(urldecode($url));
function list_sort_guide($fup){
	global $db,$pre,$mid,$only,$job,$rand,$ckfid,$url;
	$rs=$db->get_one("SELECT fup,name FROM {$pre}sort WHERE fid='$fup'");
	if($rs){
		$show=" -> <A HREF='?job=$job&mid=$mid&rand=$rand&url=$url&fid=$fup&ckfid=$ckfid'>$rs[name]</A> ";
		$show=list_sort_guide($rs[fup]).$show;
	}
	return $show;
}
		$sortdb=array();
		$rows=50;
		$page<1 && $page=1;
		$min=($page-1)*$rows;
		$showpage=getpage("{$pre}sort","WHERE fup='$fid'","?job=$job&url=$url&rand=$rand&mid=$mid&fid=$fid&ckfid=$ckfid",$rows);
		$query = $db->query("SELECT * FROM {$pre}sort WHERE fup='$fid' ORDER BY list DESC,fid ASC LIMIT $min,$rows");
		while($rs = $db->fetch_array($query)){
			if(!$rs[type]){
				$erp=$Fid_db[iftable][$rs[fid]];
				@extract($db->get_one("SELECT COUNT(*) AS NUM FROM {$pre}article$erp WHERE fid='$rs[fid]'"));
				$rs[NUM]=intval($NUM);
			}
			$sortdb[]=$rs;
		}
		if($fid){
			$show_guide="<A HREF='?job=$job&url=$url&mid=$mid&rand=$rand&ckfid=$ckfid&fid=0'>·µ»Ø¶¥¼¶Ä¿Â¼</A> ".list_sort_guide($fid);
		}

require_once(html("select"));
?>