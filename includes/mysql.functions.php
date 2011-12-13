<?php
    /**
     * these functions help facilitate sql methods.
     * while this can be done with OOP, I wanted to keep it simple enough so
     * that those that are not versed in php, can still understnad the basic
     * flow of the program/functions and be able to edit to suit their needs.
     * */
    
    function vsql_connect()
    {
        $conn = @mysql_connect(HOST,SQL_USERNAME,SQL_PASSWORD)
        if( !$conn )
        {
            $_SESSION['sql_error'] =
            'Could not connect to '.HOST;
            header('location:index.php?pt=sql');
        }
    }
    
    function vsql_select_db($database)
    {
        $conn = @mysql_select_db($database);
        if( !$conn )
        {
            $_SESSION['sql_error'] =
            "Could not connect to the $database database <p>".
            "SQL Server Error: ".mysql_error();
            header('location:index.php?pt=sql');
        }
    }
    
    function vsql_select($database, $table, $where_field, $where_value, $order_by, $sort=0)
    {
        
    }
    
    
    function vsql_insert($database, $table, $field_array, $field_array_values)
    {
        
    }
    
    function vsql_update($database, $table, $field, $data)
    {
        
    }
    
    function vsql_delete()
    {
        
    }
    
    function vsql_display_error($query, $vsql_error)
    {
        
    }
    
    function vsql_record_exist($database, $table, $where_field, $where_value)
    {
        
    }
    
    
?>