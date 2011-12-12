<?php
    /**
     * THIS PAGE DOES THE SEARCHING AND THE RESULTS ARE SENT TO
     * ITEMS.PHP FOR DISPLAY...
     * */
    if(isset($_REQUEST['sr']))
        $search_param = $_REQUEST['sr'];
    
    //SEE IF THEY ARE SEARCHING OR BROWSING
    if(isset($_REQUEST['sr'])){
        
        /** SEARCH MODE **/
        // load up the world server 
        mysql_selectdb($mangos['world_server']) or
            die("Cannot connect to mangos world server in items_srch.php<br/>".
                mysql_error());
        
        // lookd for the creature name    
        $sql = "SELECT * FROM `creature_template` WHERE `name` LIKE '%$search_param%' ORDER BY `minlevel` DESC";
        $query = mysql_query($sql) or die("Bad Query<br/>$sql<p/>".mysql_error());
        //$creature = mysql_fetch_array($query);
        
        // loop through any findings
        $count=0;//how many did we find
        while ($creature = mysql_fetch_array($query) ){
            $count++;
             // get creature map info
            $mob_map= mobMapNfo($creature['entry']);
            
            //BUILD OUR LIST
            $creature_disp[$count] = "
            <td>
                <a href='index.php?st=displmob&id=".$creature['entry']."' onmouseover=\"tooltip.show('".mobPInfo($creature)."',200);\"
                onmouseout=\"tooltip.hide();\">
                ".$creature['name']."</font></a>";
                if($creature['subname'])
                    $creature_disp[$count] .= "<br/>(".$creature['subname'].")</td>";
                
                $creature_disp[$count] .= "<td>".zoneName($mob_map['map'],$mob_map['position_x'],$mob_map['position_y'])."</td>";
                $creature_disp[$count] .= "<td>".factionName($creature['faction_A'])."</a><a href=\"#\" rel=\"npc=".$creature['entry']."\">WH</a></td>";
                $creature_disp[$count] .= "<td>".$creature['minlevel']."</a></td>";
        }
     
        if(!$count){
            echo "No records found matching <font color='#00ff00'><b>$search_param</b></font>";
        }else{
            ?>
            <table>
                <tr><td>Name</td><td>Location</td><td>Faction</td><td>Level</td></tr>
            <?php
           
            for($i=1; $i <= count($creature_disp); $i++){
                    echo "<tr>".$creature_disp[$i]."</tr>";
            }
            echo '</table>';
        }
        unset($_REQUEST['sr']);
            
    }
    
?>