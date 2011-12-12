<?php
	/**
	 * CHECK TO SEE IF PAGE TYPE(PT) IS SET. IF NOT, FIRST TIME HERE (OR HOME) AND DISPLAY
	 * THE MAIN PAGE. IF PT IS SET, DISPLAY CORRISPONDING PAGES (VIA INCLUDE - POORMANS
	 * TEMPLATE LOL) BASE OF PT, OTHER VARIABLES MAY BE SET. SEE PAGES.PHP
	 * ON HOW TO CREATE AND ADD PAGES
	 * */
	if( !isset($_REQUEST['pt']) )
	{
		include('news.php');
	}
	else
	{
		/**
		 * FOR MORE INFORMATION ON PAGE CREATION, SEE PAGES.PHP
		 * */
		$pt = $_REQUEST['pt'];
		// ASSIGN THE PHP PAGE IF IT EXIST
		if( isset($_REQUEST['pp'])) $pp = $_REQUEST['pp'];
		
		// SET A FOUND FLAG
		$found = 0;
		// CYCLE THROUGH THE $PAGES AND FIND A MATCHING PAGE_VAR
		foreach( $page as $field => $value )
		{
			if( $field == $pt )
			{
				//FOUND A MATCHING pt NOW GET THE PAGE AND SEE IF IT EXIST
				//IF NOT EXIST SHOW A NOT FOUDN PAGE OTHERWISE SHOW THE DESIGNED
				//PAGE.
				$php_page = $value.'.php';
				if( !file_exists($php_page) )
					include('pnf.php');	else include ($php_page);
			}
		}
		//IF WE GOT HERE THERE IS NOT VARIABLE CREATED FOR A PAGE
		if( !$found ) include('novar.php');
		
	}
	
?>