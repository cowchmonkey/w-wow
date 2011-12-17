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
                if ( !$sock = @fsockopen(SITE_IP, MANGOS_WORLD_PORT, $num, $error, 3)) 
                    echo $lang[LANG]['server'].'<FONT COLOR=red>'.$lang[LANG]['offline'].'</FONT>';
                else{ 
                    echo $lang[LANG]['server'].'<FONT COLOR=#00ff00>'.$lang[LANG]['online'].'</FONT>'; 
                    fclose($sock);
                }
                ?>
                <br/> <?php echo $lang[LANG]['uptime'] .' '. uptime();?><br/>
                <?php echo '<font color=#00ff00>'.$lang[LANG]['playersonline'].' '.onlinePlayers();?></font><br/>
				
					 
	</td>
    </tr>
</table>
    
        
                
   
