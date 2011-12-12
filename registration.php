<?php
    /**
    * REGISTRATION.. I'LL PRETTY THIS UP LATER :-)
    */
    $_SESSION['errmsg'] = "";
    $pass = true;
    if( isset($_POST['register'])){
        if(!isset($_POST['agreed'] ) ){
            $pass = false;
        $_SESSION['errmsg'] = "<font color='#ff0000'>You Must agree to my terms!</font>";
        }
        else
        {
            mysql_selectdb($mangos['realmd']);
            // CLEAN UP THE INPUT
            $username = strtoupper(cleanStr($_POST['username']));
            $password = strtoupper(cleanStr($_POST['password']));
            
            $wowpw = sha1($username.":".$password);
            $email = $_POST['email'];
            
            $query = mysql_query("SELECT * FROM `account` WHERE `username` = '$username' || `email` = '$email'");
            
            if(mysql_num_rows($query) > 0){
                $pass = false;
                $_SESSION['errmsg'] = "<font color='#ff0000'>This account name or email already exists</font>";
            }else{
                $pass = true;
                $ip = $_SERVER['REMOTE_ADDR'];
                $jointdate = date("Y-m-d H:i:s");
                $_SESSION['errmsg'] = "<font color='#00ff00'>Acct Created Successfully!!!</font>";
                $sql = "INSERT INTO `account` (`username`,`sha_pass_hash`,`email`,`joindate`,`last_ip`)
                VALUES('$username','$wowpw','$email','$jointdate','$ip')";
                $query = mysql_query($sql) or die("cannot insert user:<p/>".mysql_error());
                echo $_SESSION['errmsg'];
                echo '<p>You can now load up the client and play with your new login info!';
                
            }
            
        }
    }else {
    
?>
<h3>REGISTRATION</h3>
Fillout the following to play on:<br/>
<b><?php echo $site['name'];?></b>
<br/>
<fieldset>
    <legend>Fill Out Completely</legend>
    <form action="index.php?st=reg" method="post">
        <?php echo $_SESSION['errmsg']."<br/>";?>
        <table>
            <tr>
                <td>Username</td><td><input type="text" name="username"/></td>
                <td>email:</td><td><input type="text" name="email"/></td>
            </tr><tr>
                <td>Password</td><td><input type="password" name="password"/></td>
                <td>Renter-PW</td><td><input type="password" name="pwchk"/></td>
            </tr><tr>
                <td colspan="4" align="right">&nbsp;<p/><input type="submit" name="register" value="Sign Up"/></td>
            </tr><tr>
                <td colspan="4" align="center"><input type="checkbox" name="agreed" >You agree to my rules on my system</td>
        </table>
    </form>
</fieldset>
<?php } ?>