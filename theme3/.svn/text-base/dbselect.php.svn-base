<?php
    $query = @mysql_query($sql);
    if( !$query )
    {
	$_SESSION['sql_error'] =
	"Bad Query:<br/><span style='font-size:12px;font-family:courier;'> $sql</span>
        <br/><br/>SQL Server Error<br/> ".mysql_error();
	header('location:index.php?pt=sql');
	die();  
    }
?>