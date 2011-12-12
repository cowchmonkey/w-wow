<?php
    
    $id = $_SESSION['userid'];
    function numCharacters($id){
        global $mangos;
        mysql_selectdb($mangos['characters']);
        $query = mysql_query("SELECT * FROM `characters` WHERE `account` = $id") or die(mysql_error());
        return mysql_num_rows($query);
    }
    mysql_selectdb($mangos['characters']);
    $query = mysql_query("SELECT * FROM `characters` WHERE `account` = ".$_SESSION['userid']);
    $characters = mysql_fetch_array($query);
    
    mysql_selectdb($mangos['realmd']);
    $query = mysql_query("SELECT * FROM `account` WHERE `id` = ".$_SESSION['userid']);
    $account = mysql_fetch_array($query);
    
?>
&nbsp;<br/>
<b><u>Account Info</u></b><br>
No. Characters: <?php echo numCharacters($id);?><br/>
Last IP: <?php echo $account['last_ip'];?><br/>
