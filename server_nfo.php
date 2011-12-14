&nbsp;<p/>
<table class="information">
    <tr>
	<td>
	    <center>
		<img src="FAST_theme/hr.jpg"/><br/>
		<img src="FAST_theme/information.jpg"/>
	    </center>
	</td>
    </tr><tr>
	<td class="information">
				
	    <b><?php echo $lang[LANG]['mangos_ver_str'];?></b><br/>
	    <?php echo $lang[LANG]['mangos_wow_ver'];?>
	    <br/><br/>
	    <b><?php echo $lang[LANG]['server_str'];?></b><br/>
	    <?php
		$realms = realmNames();
		echo $realms['name']."<br/>".
		    $lang[LANG]['mangos_ver'];?>
	    <br/><br/>
	    <b><?php echo $lang[LANG]['realmlist_str'];?></b><br/>
	    <?php echo $lang[LANG]['mangos_realmlist'];?>
	    <br/>
	   
            <br/>
            <?php
                 /***
                * SERVER UP OR DOWN
                * */
                if (! $sock = @fsockopen($site['ip'], $site['world_port'], $num, $error, 3)) 
                    echo 'Server: <FONT COLOR=red>Offline</FONT>';
                else{ 
                    echo 'Server: <FONT COLOR=#00ff00>ONLINE</FONT>'; 
                    fclose($sock);
                }
                ?>
                <br/>Uptime: <?php echo uptime();?><br/>
                Players Online:<font color=#00ff00><?php echo onlinePlayers();?></font><br/>
				
					 
	</td>
    </tr>
</table>
    
        
                
   
