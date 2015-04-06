<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>

<span class="comeing_avt">
<?php if($_G['uid']) { ?>
    <a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" id="huser" onMouseOver="showMenu({'ctrlid':'huser','pos':'34!','ctrlclass':'a','duration':2});"><?php echo avatar($_G[uid],middle);?></a>
<?php } elseif(!empty($_G['cookie']['loginuser'])) { ?>
    <img src="<?php echo IMGDIR;?>/tavatar.gif"/>
<?php } elseif(!$_G['connectguest']) { ?>
    <img src="<?php echo IMGDIR;?>/tavatar.gif"/>
<?php } else { ?>
    <?php echo avatar(0,middle);?><?php } ?>
</span>
<?php if($_G['uid']) { ?>
<span class="user"><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>"><?php echo $_G['member']['username'];?></a></span>
    <?php if(empty($_G['disabledwidthauto']) && $_G['setting']['switchwidthauto']) { ?>
    <span class="pipe">|</span><a href="javascript:;" id="switchwidth" onClick="widthauto(this)" title="<?php if(widthauto()) { ?>切换到窄版<?php } else { ?>切换到宽版<?php } ?>"><?php if(widthauto()) { ?>切换到窄版<?php } else { ?>切换到宽版<?php } ?></a>
    <?php } ?>
    <?php if($_G['uid'] && !empty($_G['style']['extstyle'])) { ?><span class="pipe">|</span><a id="sslct" href="javascript:;" onMouseOver="showMenu({'ctrlid':'sslct','pos':'34!','ctrlclass':'a','duration':2});">切换风格</a><?php } ?>
    <span class="pipe">|</span><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a>
<?php } elseif(!empty($_G['cookie']['loginuser'])) { ?>
    <a id="loginuser" class="noborder"><?php echo dhtmlspecialchars($_G['cookie']['loginuser']); ?></a>
    <span class="pipe">|</span><a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href)">激活</a>
    <span class="pipe">|</span><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a>
<?php } elseif(!$_G['connectguest']) { ?>
    <a href="member.php?mod=logging&amp;action=login" class="login" onClick="showWindow('login', this.href)" >��¼</a>
    <span class="pipe">|</span>
    <a href="member.php?mod=register" >����ע��</a>
<?php } else { ?>
    <span class="user"><?php echo $_G['member']['username'];?></span>
    <?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra1'])) echo $_G['setting']['pluginhooks']['global_usernav_extra1'];?>
    <span class="pipe">|</span><a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a>
<?php } ?>