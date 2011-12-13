
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
            // CONNECT TO REALMD
            $database = MANGOS_REALMD;include('dbconn.php');
            
            // CLEAN UP THE INPUT
            $username = strtoupper(cleanStr($_POST['username']));
            $password = strtoupper(cleanStr($_POST['password']));
            
            $wowpw = sha1($username.":".$password);
            $email = $_POST['email'];
            
            // MAKE SURE THIS ACCOUNT DOES NOT EXIST
            // TODO: CHECK FOR IP AND OTHER STUFF
            $sql = "SELECT * FROM `account` WHERE `username` = '$username' || `email` = '$email'";
            include('dbselect.php');
            
            if(mysql_num_rows($query) > 0){
                $pass = false;
                $_SESSION['errmsg'] = "<font color='#ff0000'>This account name or email already exists</font>";
            }else{
                $pass = true;
                // LOAD UP SOME HIDDEN INFORMATION...
                $ip = $_SERVER['REMOTE_ADDR'];
                $jointdate = date("Y-m-d H:i:s");
                
                // ADD IT TO THE DATABASE
                $sql = "INSERT INTO `account` (`username`,`sha_pass_hash`,`email`,`joindate`,`last_ip`)
                VALUES('$username','$wowpw','$email','$jointdate','$ip')";
                include('dbselect.php'); //WE CAN USE THIS - ITS JUST CHECKING THE SQL STRING.
                
               header('location:index.php?pt=aok');
               die();
                
            }
            
        }
    }else {
    
?>
<center>
    <h3 style="font-variant:small-caps;"><?php echo $lang[LANG]['reg'];?></h3>
    <img src="FAST_theme/registration.jpg"/>
</center>

<br/>
<fieldset>
    <legend>Fill Out Completely</legend>
    <form action="index.php?st=reg" method="post">
        <?php echo $_SESSION['errmsg']."<br/>";?>
        <table>
            <tr>
                <td>Username</td><td><input type="text" name="username" class="register"/></td>
                <td>email:</td><td><input type="text" name="email" class="register"/></td>
            </tr><tr>
                <td>Password</td><td><input type="password" name="password" class="register"/></td>
                <td>Renter-PW</td><td><input type="password" name="pwchk" class="register"/></td>
            </tr><tr>
                <td colspan="4" align="right">&nbsp;<p/><input type="submit" name="register" value="Sign Up" class="register"/></td>
            </tr><tr>
                <td colspan="4" align="center"><input type="checkbox" name="agreed" >You agree to my rules on my system</td>
        </table>
    </form>
</fieldset>
<?php } ?>