<?php
<<<<<<< .mine
    echo
	"<a href='index.php' class='menu'>".$lang[LANG]['home']."</a>&nbsp;|&nbsp;".
	"<a href='index.php?pt=reg' class='menu'>".$lang[LANG]['signup']."</a>&nbsp;|&nbsp;".
	/*"<a href='#' class='menu'>".$lang[LANG]['login']."</a>&nbsp;|&nbsp;".*/
	"<a href='#' class='menu'>".$lang[LANG]['forum']."</a>&nbsp;|&nbsp;".
	"<a href='index.php?pt=who' class='menu'>".$lang[LANG]['who_online']."</a>&nbsp;|&nbsp;".
	"<a href='#' class='menu'>".$lang[LANG]['bot']."</a>&nbsp;|&nbsp;".
	"<a href='#' class='menu'>".$lang[LANG]['contact']."</a>&nbsp;|&nbsp;";
=======
    $separator = "</a>&nbsp;|&nbsp;";
    echo "
	<a href='index.php' class='menu'>".$lang[LANG]['home'].$separator.
	"<a href='#' class='menu'>".$lang[LANG]['forum']."</a>$separator".
	"<a href='index.php?pt=who' class='menu'>".$lang[LANG]['who_online']."</a>$separator".
	"<a href='#' class='menu'>".$lang[LANG]['contact']."</a>$separator".
	"<a href='index.php?pt=reg' class='menu'>".$lang[LANG]['signup']."</a>
    ";
    
    // LINKS CAN GO HERE THAT SHOW UP IF USER IS LOGGED IN
    if( isset($_SESSION['userid']) )
    {
	echo "$separator<a href='index.php?pt=bot' class='menu'>".$lang[LANG]['bot'];
	
    }
    
    
	
	
>>>>>>> .r66
		 
?>