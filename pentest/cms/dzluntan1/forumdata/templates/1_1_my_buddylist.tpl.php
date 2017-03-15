<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<div class="itemtitle s_clear">
<form method="post" action="member.php?action=list" class="right">
<input type="hidden" name="formhash" value="<?=FORMHASH?>" />
<input type="text" size="15" name="srchmem" class="txt" />
&nbsp;<button type="submit">搜索</button>
<? if($regstatus > 1) { ?>&nbsp;<button onclick="window.location='invite.php'; return false;">邀请好友</button><? } ?>
</form>
<h1>我的好友</h1>
<ul>
<li<? if(empty($type)) { ?> class="current"<? } ?>><a href="my.php?item=buddylist"><span>好友</span></a></li>
<li<? if(!empty($type)) { ?> class="current"<? } ?>><a href="my.php?item=buddylist&amp;type=fans"><span>关注</span></a></li>
</ul>
</div>
<div class="datalist">
<table cellspacing="0" cellpadding="0" class="datatable" style="table-layout:fixed;margin-top:10px;">
<? if($buddylist) { ?>
<tr><? $i=0; if(is_array($buddylist)) { foreach($buddylist as $buddy) { $i++; ?><td valign="top">
<div class="friendavatar"><a href="space.php?uid=<?=$buddy['friendid']?>" target="_blank"><?=$buddy['avatar']?></a></div>
<div class="friendinfo">
<h5 class="buddyname">
<a href="space.php?uid=<?=$buddy['friendid']?>" target="_blank"><?=$buddy['username']?></a>
<? if($buddy['online']) { ?><img src="<?=IMGDIR?>/online_buddy.gif" title="当前在线" class="online_buddy" /><? } if($buddy['msn']['1']) { ?>
<a target='_blank' href='http://settings.messenger.live.com/Conversation/IMMe.aspx?invitee=<?=$buddy['msn']['1']?>@apps.messenger.live.com&mkt=zh-cn' title="MSN 聊天"><img class='online_buddy' src='http://messenger.services.live.com/users/<?=$buddy['msn']['1']?>@apps.messenger.live.com/presenceimage?mkt=zh-cn' width='16' height='16' /></a>
<? } ?>
</h5>
<p>
<span id="commenthide_<?=$buddy['friendid']?>"><?=$buddy['comment']?></span> <span id="commentedit_<?=$buddy['friendid']?>">[<a href="javascript:;" onclick="editcomment(<?=$buddy['friendid']?>)"><? if($buddy['comment']) { ?>+编辑备注<? } else { ?>+添加备注<? } ?></a>]</span>
<span id="commentbox_<?=$buddy['friendid']?>" style="display:none"><input name="comment_<?=$buddy['friendid']?>" value="<?=$buddy['comment']?>" id="comment_<?=$buddy['friendid']?>" class="txt" tabindex="1" onBlur="updatecomment(<?=$buddy['friendid']?>)"/ size="30"></span>
</p>
<p class="friendctrl">
<a href="pm.php?action=new&amp;uid=<?=$buddy['friendid']?>" onclick="showWindow('sendpm', this.href);return false;" title="发短消息">发短消息</a> |
<? if($uchomeurl) { ?><a href="<?=$uchomeurl?>/space.php?uid=<?=$buddy['friendid']?>" target="_blank">好友空间</a><? } else { ?><a href="space.php?uid=<?=$buddy['friendid']?>" target="_blank">个人资料</a><? } ?> |
<a href="search.php?srchuid=<?=$buddy['friendid']?>&amp;srchfid=all&amp;srchfrom=0&amp;searchsubmit=yes" target="_blank"><? if($buddy['gender'] == 2) { ?>她<? } else { ?>他<? } ?>的帖子</a> |
<a href="my.php?item=buddylist&amp;action=delete&amp;friendid=<?=$buddy['friendid']?><?=$extratype?>&amp;buddysubmit=yes">删除</a>
</p>
</div>
</td>
<? if($i%2==0) { ?></tr><tr><? } } } ?></tr>
<? } else { ?>
<tr><th><p class="nodata">您当前没有好友</p></th></tr>
<? } ?>
</table>
</div>

<?=$multipage?>

<script type="text/javascript" reload="1">
function changediv(buddyid) {
display('commenthide_' + buddyid);
display('commentbox_' + buddyid);
display('commentedit_' + buddyid);
}

function editcomment(buddyid) {
changediv(buddyid);
$('comment_' + buddyid).focus();
}

function updatecomment(buddyid) {
changediv(buddyid);
var comment = BROWSER.ie && document.charset == 'utf-8' ? encodeURIComponent($('comment_'+ buddyid).value) : $('comment_'+ buddyid).value;
$('commenthide_' + buddyid).innerHTML =  preg_replace(['&', '<', '>', '"'], ['&amp;', '&lt;', '&gt;', '&quot;'], comment);
ajaxget('my.php?item=buddylist&action=edit&friendid=' + buddyid + '&buddysubmit=yes&comment=' + comment, 'commnethide_' + buddyid, 'commnethide_' + buddyid);
}

function preg_replace(search, replace, str) {
var len = search.length;
for(var i = 0; i < len; i++) {
re = new RegExp(search[i], "ig");
str = str.replace(re, typeof replace == 'string' ? replace : (replace[i] ? replace[i] : replace[0]));
}
return str;
}
</script>