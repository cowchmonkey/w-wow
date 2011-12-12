<?php
    if(isset($_POST['sitelogin'])){
        
        mysql_selectdb($mangos['realmd']) or die("no db");
        
        if(!$_POST['username'] || !$_POST['password']){            
            header('location:index.php?st=loginerr');
            die();
        }else{
            // SQL INJECTION PROTECTION -
            $un = strtoupper(cleanStr($_POST['username']));
            $pw = strtoupper(cleanStr($_POST['password']));
            
            // CREATE UNIQUE PW - UN:PW
            $pw = sha1("$un:$pw");
            
            // SEARCH FOR THE ACCOUNT
            $sql = "SELECT * FROM `account` WHERE `username` = '$un' && `sha_pass_hash` = '$pw'";
            $query = mysql_query($sql) or die(mysql_error());
            $count = mysql_num_rows($query);
            
            // IF COUNT > 0 THEN ACCOUNT WAS FOUND
            if($count == 1){
                $user = mysql_fetch_array($query);
                // WE JUST NEED THE ID TO USE FOR LATER
                $_SESSION['userid'] = $user['id'];
                //15 MIN COOKIE IS FINE CURRENTLY SET AT 60SEC FOR TESTING
                setcookie("vwowstatus",1,time()+300);
                // SHOOT THEM TO SUCCEFUL PAGE                
                header('location:index.php?st=pass');
                die();
            }else{
                //OOPS BAD LOGIN -               
                header('location:index.php?st=loginerr');
                die("");
            }
        }
    }
    
?>
<fieldset>
    <legend>Login</legend>
    <form action="index.php?st=login" method="post">
        <table>
            <tr>
                <td>Id:</td><td><input type="text"      name="username"/></td>
                <td>Pw:</td><td><input type="password"  name="password"/></td>
            </tr><tr>
                <td colspan="2" align="RIGHT">
                    <input type="submit" name="sitelogin" value="Login"/>
                    <input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR'];?>"/>
                </td>
            </tr>
        </table>
    </form>
</fieldset>