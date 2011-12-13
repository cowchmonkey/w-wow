<?php
	session_start();
	include ('includes/dbvars.php');				// MISC DB VARIABLES
	include ('lang/'.LANG.'.php');					// LANGUAGE FILE
	include ('includes/mysql.functions.php');		// MYSQL FUNCTIONS
	include ('includes/pages.php');					// PAGES FOR DISPLAY
	include ('includes/functions.php');				// MISC FUNCTIONS
	
	// CONNECT TO THE SQL SERVER
	$conn = @mysql_connect(HOST,SQL_USERNAME,SQL_PASSWORD);
    if( !$conn )
    {
        $_SESSION['sql_error'] =
        'Could not connect to '.HOST;
        header('location:index.php?pt=sql');
    }
	
	// COOKIE CHECK (SEE IF THEY WENT AFK TO LONG)
	if( !isset($_COOKIE['vwowstatus']) ){
		// THEY'RE AFK - GANK EM'!! ROAR!!!!
		unset($_SESSION['userid']);
	}
	else
	{
		//ADD SOME MORE TIME SINCE THEY ARE STILL HERE
		setcookie("vwowstatus",1,time()+300);
	}
?>
<HTML>
<HEAD>
	<META NAME="Author" CONTENT="Klyxmaster">	
	<script type="text/javascript" src="scripts/tips.js"></script>
	<script type="text/javascript" src="http://static.old.wowhead.com/widgets/power.js"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="fast.css" />
	<LINK REL="FAVICON" HREF="wow.ico">
<TITLE>
	<?php echo $lang[LANG]['site_name'];?>
</TITLE>
</HEAD>
<BODY>

<!-- Begin Table -->
<TABLE BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="1440" HEIGHT="899" >
<TR>
<TD ROWSPAN="4" COLSPAN="1" WIDTH="265" HEIGHT="899"><IMG NAME="full_mockup0" SRC="FAST_theme/wowtemplates1_1x1.jpg" WIDTH="265" HEIGHT="899" BORDER="0"></TD>


<?php /* ----------------------- [  HEADER ] ---------------------------------*/?>
<TD ROWSPAN="1" COLSPAN="3" WIDTH="910" HEIGHT="382" BACKGROUND="FAST_theme/wowtemplates1_1x2.jpg" valign="top">
	<div style="float:left;font-size:10px;">Designed and tested by FAST&nbsp;<p/></div>
	<div style="float:right;font-size:10px;">Webpage Graphics by
		<a href="http://zardom002.deviantart.com/" target="_blank">Zardom002&nbsp;<p/></a>
	</div>
	<div style="float:left;">
		<?php echo
			$lang[LANG]['site_name']."<br/>
			<small><i>(".$lang[LANG]['tag_line'].")</i></small>
		";
		?>
	</div>
</TD>
<?php /* ----------------------- [  END HEADER ] ---------------------------------*/?>


<TD ROWSPAN="4" COLSPAN="1" WIDTH="265" HEIGHT="899">
	<IMG NAME="full_mockup2" SRC="FAST_theme/wowtemplates1_1x3.jpg" WIDTH="265" HEIGHT="899" BORDER="0">
</TD>
</TR>



<TR>
<?php /* ---------------- [ MENU BAR ] ----------------------------*/?>	
<TD ROWSPAN="1" COLSPAN="3" WIDTH="910" HEIGHT="27" BACKGROUND="FAST_theme/wowtemplates1_2x1.jpg" valign="middle" align="center">
	<center class="menu">
		<?php include('top_mnu.php');?>
	</center>
</TD>
<?php /* ---------------- [ END MENU BAR ] ----------------------------*/?>

</TR>

<TR>
<TD ROWSPAN="1" COLSPAN="3" WIDTH="910" HEIGHT="12">
	<IMG NAME="wowtemplates14" SRC="FAST_theme/wowtemplates1_3x1.jpg" WIDTH="911" HEIGHT="12" BORDER="0"></TD>
</TR>






<?php /* ---------------- [ LOGIN AND ACCT INFO ] ----------------------------*/?>
<TR>
<TD ROWSPAN="1" COLSPAN="1" WIDTH="194" HEIGHT="478" BACKGROUND="FAST_theme/wowtemplates1_4x1.jpg">
	<?php
		if( !isset($_SESSION['userid']) )
		{
			//USER NOT LOGGED IN - DISPLAY LOGIN FORM
			include('login.php');
		}
		else
		{
			//USER IS LOGGED IN, DISPLAY SOME BASIC INFO
			include('accnt_nfo.php');
		}
	?>
</TD>










<?php /* ---------------- [ ***MAIN CENTER DISPLAY*** ] ----------------------------*/?>
<TD ROWSPAN="1" COLSPAN="1"
	WIDTH="522" HEIGHT="478"
	BACKGROUND="FAST_theme/wowtemplates1_4x2.jpg"
	valign="top"
	>
	<center>
		Welcome to <B><?php echo $lang[LANG]['site_name'];?></B><br/>
		...<I><?php echo $lang[LANG]['tag_line'];?></I><br/>
	</center>
	<?php include('parse_pages.php');?>
	
</TD>
<?php /* ---------------- [ ***END MAIN CENTER DISPLAY*** ] ----------------------------*/?>















<?php /* ---------------- [ RIGHT SIDEBAR ] ----------------------------*/?>
<TD ROWSPAN="1" COLSPAN="1" WIDTH="194" HEIGHT="478" BACKGROUND="FAST_theme/wowtemplates1_4x3.jpg" style="overflow:hidden;">
	<center>
	<?php
		include('search.php');
		include('server_nfo.php');
	?>
	</center>
</TD>
</TR>

</TABLE>
<!-- End Table -->

</BODY>
</HTML>
