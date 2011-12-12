    <span style="color:#c0c0c0;font-family:arial;font-size:12px;">
        <br/>
            Realm Status:<br/><font color="orange"><b>
            <?php
                /**
                 * CURRENTLY SETUP FOR A SINGLE REALM SERVER - WILL CHANGE LATER
                 * */
                $realms = realmNames();
                echo $realms['name'];
            ?>
            </b></font>
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
                
    </span>
