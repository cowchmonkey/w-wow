<?php
   if(isset($_POST['site_login'])){
        
	$database = MANGOS_REALMD;
	include('dbconn.php');
        
        if(!$_POST['username'] || !$_POST['password']){            
            header('location:index.php?pt=loginerr');
            die();
        }else{
            // SQL INJECTION PROTECTION -
            $un = strtoupper(cleanStr($_POST['username']));
            $pw = strtoupper(cleanStr($_POST['password']));
            
            // CREATE UNIQUE PW - UN:PW
            $pw = sha1("$un:$pw");
            
            // SEARCH FOR THE ACCOUNT
            $sql = "SELECT * FROM `account` WHERE `username` = '$un' && `sha_pass_hash` = '$pw'";
            $query = @mysql_query($sql);
	    if( !$query )
	    {
	       $_SESSION['sql_error'] =
	       "Bad Query: $sql<br/>SQL Server Error<br/> ".mysql_error();
	       header('location:index.php?pt=sql');
	       die();  
	    }
	    // JUST GRAB THE FIRST ONE - TODO: CLEAN THIS UP!
            $count = mysql_num_rows($query);
            
            // IF COUNT > 0 THEN ACCOUNT WAS FOUND
            if($count == 1){
                $user = mysql_fetch_array($query);
                
		// WE JUST NEED THE ID TO USE FOR LATER
                $_SESSION['userid'] = $user['id'];
                
		//15 MIN COOKIE IS FINE CURRENTLY SET AT 60SEC FOR TESTING
                setcookie( "vwowstatus",1,time() + AFK );
               
	        // SHOOT THEM TO SUCCEFUL PAGE                
                header('location:index.php?pt=aok');
                die();
            }else{
                //OOPS BAD LOGIN -               
                header('location:index.php?pt=lge');
                die("");
            }
        }
    }
    
?>
<img src="FAST_theme/login.jpg"/>
<br/>
<form action="index.php" method="post" >
    <span class="login">
        <?php echo $lang[LANG]['username'];?>
    </span>
    <br/>
    <input type="text" name="username" class="login"/>
    <br/>
    <span class="login">
        <?php echo $lang[LANG]['password'];?>
    </span>
    <br/>
    <input type="password" name="password" class="login"/>
    <br/><br/><br/>
    <input type="submit" name="site_login" value="Login" class="login_btn"/>
				
</form>