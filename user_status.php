<img src="FAST_theme/account_nfo.jpg"/><br/><br/>
<?php
    
    $id = $_SESSION['userid'];
    function numCharacters($id){
        $database = MANGOS_CHAR;include('dbconn.php');
        $sql = "SELECT * FROM `characters` WHERE `account` = $id";
        include('dbselect.php');
        return mysql_num_rows($query);
    }
    $database = MANGOS_CHAR;include('dbconn.php');
    $sql = "SELECT * FROM `characters` WHERE `account` = ".$_SESSION['userid'];
    include('dbselect.php');
    $characters = mysql_fetch_array($query);
    
    $database = MANGOS_REALMD;include('dbconn.php');
    $sql = "SELECT * FROM `account` WHERE `id` = ".$_SESSION['userid'];
    include ('dbselect.php');
    $account = mysql_fetch_array($query);
    
?>
&nbsp;<br/>
<b><u>Account Info</u></b><br>
No. Characters: <?php echo numCharacters($id);?><br/>
Last IP: <?php echo $account['last_ip'];?><br/>
