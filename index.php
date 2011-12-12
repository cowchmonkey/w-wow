<?php
	session_start();
	// IF COOKIE IS STILL SET ADD MORE TIME
	if(isset($_COOKIE['vwowstatus'])){
		setcookie("vwowstatus",1,time()+300);
	}else{
		// NOTE TO SELF: DO NOT DESTROY SESSION, MESSES UP THE OTHER SETTINGS
		unset($_SESSION['userid']);		
	}
	// SET DEFAULT TIME TO CST (CHANGE AS NEEDED )
	date_default_timezone_set('America/Chicago');
	
	
	include('includes/functions.php');
	include('includes/config.php');
	include('includes/dbvars.php');
	include('includes/content.php');
?>
<HTML>
<HEAD>
<META NAME="Author" CONTENT="Klyxmaster">
	<script type="text/javascript" src="scripts/tips.js"></script>
	<script type="text/javascript" src="http://static.old.wowhead.com/widgets/power.js"></script>
	<LINK REL="FAVICON" HREF="wow.ico">
	<link rel="stylesheet" type="text/css" media="screen" href="vwow.css" />
<TITLE><?php echo $site['name'];?></TITLE>
</HEAD>
<BODY>

<!-- Begin Table -->
<center>
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="842" HEIGHT="626">

<TR>
<TD ROWSPAN="1" COLSPAN="12" WIDTH="842" HEIGHT="25">
	<IMG NAME="Image20" SRC="images/Image2_1x1.jpg" WIDTH="842" HEIGHT="25" BORDER="0"></TD>
</TR>

<TR>
<TD ROWSPAN="1" COLSPAN="5" WIDTH="235" HEIGHT="74">
	<a href="index.php"><IMG NAME="Image21" SRC="images/Image2_2x1.jpg" WIDTH="235" HEIGHT="74" BORDER="0"></a></TD>


<?php /* -----------------------------[ CENTER HEADER ]------------------------*/?>
<TD ROWSPAN="2" COLSPAN="1" WIDTH="369" HEIGHT="74" BACKGROUND="images/Image2_2x2.jpg">
	<center><H1><?php echo $site['name'];?></H1></center>
</TD>
<TD ROWSPAN="1" COLSPAN="6" WIDTH="238" HEIGHT="74">
	<IMG NAME="Image23" SRC="images/Image2_2x3.jpg" WIDTH="238" HEIGHT="74" BORDER="0"></TD>
</TR>

<TR>
<TD ROWSPAN="1" COLSPAN="12" WIDTH="842" HEIGHT="23">
	<IMG NAME="Image24" SRC="images/Image2_3x1.jpg" WIDTH="842" HEIGHT="23" BORDER="0"></TD>
</TR>

<TR>
<TD ROWSPAN="1" COLSPAN="4" WIDTH="230" HEIGHT="15">
	<IMG NAME="Image25" SRC="images/Image2_4x1.jpg" WIDTH="230" HEIGHT="15" BORDER="0"></TD>

<?php /*  ----------------TOP MENU  ----------------------------------- */?>
<TD ROWSPAN="1" COLSPAN="6" WIDTH="587" HEIGHT="15"  BACKGROUND="images/Image2_4x2.jpg">
	<center>
		<SPAN class="top_mnu">
			<a href="index.php">Home</a>&nbsp;|&nbsp;
			<?php
				// WHILE IT WONT MAKE A DIFF, LOOKS STUPID IF THEY CAN SEE
				// THE LOGIN OPTION AFTER THEY LOGED IN SUCCESSFULLY nor
				// DO THEY NEED TO SIGNUP AGAIN LOL
				if(!isset($_SESSION['userid'])){ ?>
					<a href="index.php?st=login">Login</a>&nbsp;|&nbsp;
					<a href="index.php?st=reg">Signup</a>&nbsp;|&nbsp;
			<?php } ?>
			
			<a href="index.php?st=who">Whos Online</a>&nbsp;|&nbsp;
			<a href="index.php?st=forum">Community</a>&nbsp;|&nbsp;
			
			<a target="_blank" href="http://www.google.com/recaptcha/mailhide/d?k=01cB-gMIDW-K9xSilCz-G7oQ==&c=VZrBSZ694AKXLIjiYCXi5fRPIQGyWO1s2GBPo7Zt36Q=">Contact</a>
		</SPAN>
	</center>
</TD>


<TD ROWSPAN="1" COLSPAN="2" WIDTH="25" HEIGHT="15">
	<IMG NAME="Image27" SRC="images/Image2_4x3.jpg" WIDTH="25" HEIGHT="15" BORDER="0"></TD>
</TR>

<TR>
<TD ROWSPAN="1" COLSPAN="12" WIDTH="842" HEIGHT="22">
	<IMG NAME="Image28" SRC="images/Image2_5x1.jpg" WIDTH="842" HEIGHT="22" BORDER="0"></TD>
</TR>

<TR>
<TD ROWSPAN="7" COLSPAN="1" WIDTH="23" HEIGHT="403">
	<IMG NAME="Image29" SRC="images/Image2_6x1.jpg" WIDTH="23" HEIGHT="403" BORDER="0"></TD>

<?php /*---------------------[ NAVIGATION PANEL LEFT ]-------------------------*/?>
<TD ROWSPAN="7" COLSPAN="1" WIDTH="158" HEIGHT="403" BACKGROUND="images/Image2_6x2.jpg">
	<?php include('search.php');?>
	<?php
		if(isset($_SESSION['userid'])){
			include('user_status.php');
		}
		else{
			echo "<b><u>Account Info</u></b><br/>Login to see more.";
		}
		?>
	
	<br/>
	
</TD>


<TD ROWSPAN="7" COLSPAN="1" WIDTH="12" HEIGHT="403">
	<IMG NAME="Image211" SRC="images/Image2_6x3.jpg" WIDTH="12" HEIGHT="403" BORDER="0"></TD>



<?php /* -----------------[ M A I N    C O N T E N T ]------------------------*/?>
<TD ROWSPAN="7" COLSPAN="4" WIDTH="457" HEIGHT="403" BACKGROUND="images/Image2_6x4.jpg">
	
		<?php
		//IF USER IS JUST VISITING OR ON HOME PAGE - JUST SHOW THE NEWS
		// SETUP UP SOME MINI SCRIPTING
		$news = file_get_contents('news/news.php'); 
        for($i = 1; $i <= 6; $i++)
            $news = str_ireplace("@c$i","<font color='".$qualityColor[$i]."'>",$news);
        $news   = str_ireplace("@cc","</font>",$news);
        $news   = str_ireplace("@sn",$site['name'],$news);
			
		if(!isset($_REQUEST['st'])){
			$content = $news;
			$content_header	= "News:";
		}else {
			$st = $_REQUEST['st'];
			switch($st){
				// REGISTRATION -
				case "reg"		:$content = 'registration.php';			$content_header = 'Registraion';	break;
					
				// ITEMS -
				case "items"	:$content = 'item_srch.php';			$content_header = 'Item Search';	break;
				case "displItem":$content = 'item_nfo.php';				$content_header = 'Item';			break;
				
				// QUESTS -
				case "quests"	:$content = 'quest_srch.php';			$content_header = 'Quest Search';	break;
				case "displquest" :$content='quest_nfo.php';			$content_header = 'Quest Info';		break;
					
				// CREATURES
				case "creatures" :$content= 'creature_srch.php';		$content_header = 'NPC/Mob Search';	break;
				case "displmob" :$content = 'creature_nfo.php';			$content_header = 'Creature Info';	break;
					
				// MISC LINKS
				case "who" 		:$content = 'whoonline.php';			$content_header = 'Who\'s Online';	break;
				
				// LOGIN INFO
				case "login"	:$content = 'login.php';				$content_header = 'Login';			break;
				case "loginerr"	:$content = 'loginerr.php';				$content_header = 'Login Error';	break;
				case "pass"		:$content = 'loginpass.php';			$content_header = 'Successful Login';break;
				
				// FORUM SECTION
				case "forum"	:$content = 'v-forum/main_forum.php';	$content_header = 'Community';		break;
				case "c_topic"	:$content = 'v-forum/create_topic.php';	$content_header = 'Create Topic';	break;
				case "a_topic"	:$content = 'v-forum/add_topic.php';	$content_header = 'Add Topic';		break;
				case "v_topic"	:$content = 'v-forum/view_topic.php';	$content_header = 'View Topic';		break;
				case "answer"	:$content = 'v-forum/add_answer.php';	$content_header = 'Reply';			break;
				case "noforum"	:$content = 'v-forum/noforum.php';		$content_header = 'Not Logged In';	break;
				
				// ERROR SECTION
				case "sqlerr"	:$content = 'v-forum/sqlerr.php';		$content_header = 'Program Error';	break;
				
				
			}
		}
		?>
        <center>
           <p/>
        <table width="300" cellpadding="0" cellspacing="0">
            <tr>
                <td width="4"><img src="images/ul_hdr.jpg" width="4"/></td>
                <td background="images/top_hdr.jpg" style="vertical-align:middle;">
                    <?php echo $content_header;?>
                </td>
                <td width="4"><img src="images/ur_hdr.jpg" width="4"/></td>
            </tr><tr>
                <td width="4" background="images/left_content.jpg"></td>
                <td background="images/content_bg.jpg">
					<div style="width:437px;height:350px;overflow:auto;overflow-x:hidden;">
						<?php if(!isset($_REQUEST['st'])){ echo $content; } else { include($content); }?>
					</div>
                </td>
                 <td width="4" background="images/right_content.jpg"></td>
            </tr><tr>
                <td><img src="images/ll_content.jpg"/></td>
                <td><img src="images/bot_content.jpg"/></td>
                <td><img src="images/lr_content.jpg"/></td>
            </tr>
        </table>
        </center>
</TD>



<TD ROWSPAN="7" COLSPAN="1" WIDTH="18" HEIGHT="403">
	<IMG NAME="Image213" SRC="images/Image2_6x5.jpg" WIDTH="18" HEIGHT="403" BORDER="0"></TD>
<TD ROWSPAN="1" COLSPAN="1" WIDTH="144" HEIGHT="8">
	<IMG NAME="Image214" SRC="images/Image2_6x6.jpg" WIDTH="144" HEIGHT="8" BORDER="0"></TD>
<TD ROWSPAN="7" COLSPAN="3" WIDTH="30" HEIGHT="403">
	<IMG NAME="Image215" SRC="images/Image2_6x7.jpg" WIDTH="30" HEIGHT="403" BORDER="0"></TD>
</TR>

<TR>


<?php /* ------------------[ UPPER RIGHT PANEL ] ---------------------------*/?>
<TD ROWSPAN="1" COLSPAN="1" WIDTH="144" HEIGHT="105" BACKGROUND="images/Image2_7x1.jpg" valign="top">
	<?php include('status.php');?>
</TD>

</TR>

<TR>
<TD ROWSPAN="1" COLSPAN="1" WIDTH="144" HEIGHT="6">
	<IMG NAME="Image217" SRC="images/Image2_8x1.jpg" WIDTH="144" HEIGHT="6" BORDER="0"></TD>
</TR>

<TR>

<?php /*---------------[ CENTER RIGHT PANEL ]----------------------------------*/?>
<TD ROWSPAN="1" COLSPAN="1" WIDTH="144" HEIGHT="238" BACKGROUND="images/Image2_9x1.jpg" valign="top">
	<?php echo raceStats();?>
	
</TD>

</TR>

<TR>
<TD ROWSPAN="1" COLSPAN="1" WIDTH="144" HEIGHT="6">
	<IMG NAME="Image219" SRC="images/Image2_10x1.jpg" WIDTH="144" HEIGHT="6" BORDER="0"></TD>
</TR>

<TR>

<?php /*------------------[ LOWER RIGHT PANEL ]--------------------------------*/?>
<TD ROWSPAN="1" COLSPAN="1" WIDTH="144" HEIGHT="30" BACKGROUND="images/Image2_11x1.jpg">
	
</TD>


</TR>

<TR>
<TD ROWSPAN="1" COLSPAN="1" WIDTH="144" HEIGHT="10">
	<IMG NAME="Image221" SRC="images/Image2_12x1.jpg" WIDTH="144" HEIGHT="10" BORDER="0"></TD>
</TR>

<TR>
<TD ROWSPAN="1" COLSPAN="12" WIDTH="842" HEIGHT="18">
	<IMG NAME="Image222" SRC="images/Image2_13x1.jpg" WIDTH="842" HEIGHT="18" BORDER="0"></TD>
</TR>

<TR>
<TD ROWSPAN="1" COLSPAN="1" WIDTH="23" HEIGHT="24">
	<IMG NAME="Image223" SRC="images/Image2_14x1.jpg" WIDTH="23" HEIGHT="24" BORDER="0"></TD>

<?php /* ----------------------------[ FOOTER ]-------------------------------*/?>
<TD ROWSPAN="1" COLSPAN="10" WIDTH="796" HEIGHT="24" BACKGROUND="images/Image2_14x2.jpg">
	<?php include('footer.php');?>
</TD>


<TD ROWSPAN="1" COLSPAN="1" WIDTH="23" HEIGHT="24">
	<IMG NAME="Image225" SRC="images/Image2_14x3.jpg" WIDTH="23" HEIGHT="24" BORDER="0"></TD>
</TR>

<TR>
<TD ROWSPAN="1" COLSPAN="12" WIDTH="842" HEIGHT="22">
	<IMG NAME="Image226" SRC="images/Image2_15x1.jpg" WIDTH="842" HEIGHT="22" BORDER="0"></TD>
</TR>

<TR>
<TD WIDTH="23" HEIGHT="1">
	<IMG NAME="blank" SRC="images/blank.gif" WIDTH="23" HEIGHT="1" BORDER="0"></TD>
<TD WIDTH="158" HEIGHT="1">
	<IMG NAME="blank" SRC="images/blank.gif" WIDTH="158" HEIGHT="1" BORDER="0"></TD>
<TD WIDTH="12" HEIGHT="1">
	<IMG NAME="blank" SRC="images/blank.gif" WIDTH="12" HEIGHT="1" BORDER="0"></TD>
<TD WIDTH="37" HEIGHT="1">
	<IMG NAME="blank" SRC="images/blank.gif" WIDTH="37" HEIGHT="1" BORDER="0"></TD>
<TD WIDTH="5" HEIGHT="1">
	<IMG NAME="blank" SRC="images/blank.gif" WIDTH="5" HEIGHT="1" BORDER="0"></TD>
<TD WIDTH="369" HEIGHT="1">
	<IMG NAME="blank" SRC="images/blank.gif" WIDTH="369" HEIGHT="1" BORDER="0"></TD>
<TD WIDTH="46" HEIGHT="1">
	<IMG NAME="blank" SRC="images/blank.gif" WIDTH="46" HEIGHT="1" BORDER="0"></TD>
<TD WIDTH="18" HEIGHT="1">
	<IMG NAME="blank" SRC="images/blank.gif" WIDTH="18" HEIGHT="1" BORDER="0"></TD>
<TD WIDTH="144" HEIGHT="1">
	<IMG NAME="blank" SRC="images/blank.gif" WIDTH="144" HEIGHT="1" BORDER="0"></TD>
<TD WIDTH="5" HEIGHT="1">
	<IMG NAME="blank" SRC="images/blank.gif" WIDTH="5" HEIGHT="1" BORDER="0"></TD>
<TD WIDTH="2" HEIGHT="1">
	<IMG NAME="blank" SRC="images/blank.gif" WIDTH="2" HEIGHT="1" BORDER="0"></TD>
<TD WIDTH="23" HEIGHT="1">
	<IMG NAME="blank" SRC="images/blank.gif" WIDTH="23" HEIGHT="1" BORDER="0"></TD>
</TR>
</TABLE>
</center>
<!-- End Table -->

</BODY>
</HTML>