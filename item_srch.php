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
        mysql_selectdb($mangos['world_server']);
        
        // lookd for the item name    
        $query = mysql_query("SELECT * FROM `item_template` WHERE `name` LIKE '%$search_param%' ORDER BY `ItemLevel` DESC");
        
        // loop through any findings
        $count=0;//how many did we find
        while ($item = mysql_fetch_array($query) ){
            $count++;
            $icon = getIcon($item['displayid']);            
            $color = $qualityColor[$item['Quality']];
            
            //BUILD OUR LIST
            // FIX THE HYPHENS
            
            $display_item[$count] = "
                <td>
                    <a href='#' rel='item=".$item['entry']."'>
                        <img src='images/wowhead_icon.jpg' width='25' height='25'/>
                    </a>                
                    
                </td>
                <td>
                    <a href='index.php?st=displItem&id=".$item['entry']."' onmouseover=\"tooltip.show('".itemPInfo($item)."',300);\"
                        onmouseout=\"tooltip.hide();\">
                        <img src='img/icons/$icon.jpg' height='25' width='25'/>
                        <font color='$color'>".$item['name']."</font>
                    </a>
                </td>
            ";
        }
    
        if(!$count){
            echo "No records found matching <font color='#00ff00'><b>$search_param</b></font>";
        }else{
            ?>
            <table>
                <tr><td>Name</td></tr>
            <?php
            for($i=1; $i <= count($display_item); $i++)
                    echo '<tr>'.$display_item[$i].'</tr>';
            echo '</table>';
        }
        unset($_REQUEST['sr']);
            
    }
    
?>