<?php
    $query = @mysql_query($sql);
    if( !$query )
    {
	$_SESSION['sql_error'] =
	"Bad Query: $sql<br/>SQL Server Error<br/> ".mysql_error();
	header('location:index.php?pt=sql');
	die();  
    }
?>