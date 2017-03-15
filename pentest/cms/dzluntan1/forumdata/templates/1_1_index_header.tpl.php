<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<div class="pages_btns s_clear">
<span class="postbtn" id="prompt_index_postbtn"><a href="misc.php?action=nav" onclick="showWindow('nav', this.href);return false;">发帖</a></span>
<? if(!$discuz_uid) { ?>
<p>你可以<a href="<?=$regname?>" onclick="showWindow('register', this.href);return false;" class="lightlink">注册</a>一个帐号，并以此<a href="logging.php?action=login" onclick="showWindow('login', this.href);return false;" class="lightlink">登录</a>，以浏览更多精彩内容，并随时发布观点，与大家交流。</p>
<? } else { ?>
欢迎回来 <?=$discuz_userss?>, <? if($lastvisit) { ?>你上次访问时间是在 <?=$lastvisit?>, <? } ?><a href="my.php?item=threads" class="lightlink" target="_blank">我的帖子</a>, <a href="search.php?srchfrom=<?=$newthreads?>&amp;searchsubmit=yes" class="lightlink">查看新帖</a>, <a href="member.php?action=markread" id="ajax_markread" onclick="ajaxmenu(this);doane(event);" class="lightlink">标记已读</a>
<? } ?>
</div>

<? if(empty($gid) && $announcements) { ?>
<div id="ann">
<dl>
<dt>公告:</dt>
<dd>
<div id="annbody"><ul id="annbodylis"><?=$announcements?></ul></div>
</dd>
</dl>
</div>
<script type="text/javascript">announcement();</script>
<? } ?>