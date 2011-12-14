<?php
    // SELECT THE REALMD DB, AS IT HOLDS THE LOGIN INFORMATION
    $conn = @mysql_selectdb($database);
    if( !$conn )
    {
	$_SESSION['sql_error'] =
	"Cannot connect to <b>$datebase</b>".
	"<P/>SQL Server Error:<br/>".mysql_error();
	header('location:index.php?pt=sql');
	die();
    }