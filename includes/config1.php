<?php
    /**
     * YOUR BASIC CONFIG FILE. IF YOU DONT KNOW WHAT TO DO  - STOP AND PLAY WOW
     * */
    
    /** SQL SERVER INFORMATION **/
    $sql = array (
        'sql_host'          => 'localhost',     //SQL SERVER HOST
        'sql_username'      => 'root',
        'sql_password'      => 'bambam'
    );
    
    /** VANILLA WORLD OF WARCRAFT MANGOS SERVER INFO **/
    $mangos = array (
        'world_server'      => 'mangos',
        'characters'        => 'characters',
        'realmd'            => 'realmd',         // USED FOR SERVER STATUS
        'vwow'              => 'vwow'            // DATABASE FOR VWOW
    );
    
    
    /** MISC SITE INFORMATION **/
    $site = array (
        'name'              => 'WoW WerKz',
        'tagline'           => 'Lich King has nuttin on Ony!',              //BLANK IF YOU DONT WANT ONE
        'world_port'        => 8085,
        'login_port'        => 3724,
        'ip'                => '174.20.214.159'
    );
    
    @mysql_connect($sql['sql_host'],$sql['sql_username'],$sql['sql_password']) or
        die("Unable to connect to Server using:<br/>
            Host:".$sql['sql_host']."<br/>
            username: ".$sql['sql_username']."<br/>
            password: ".$sql['sql_password']);
    
    
?>