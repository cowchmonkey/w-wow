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
        $database = MANGOS_WORLD;
        include('dbconn.php');
        
        // lookd for the item name    
        $sql = "SELECT * FROM `item_template` WHERE `name` LIKE '%$search_param%' ORDER BY `ItemLevel` DESC";
        include ('dbselect.php');
        $item_q = $query;
        
        // loop through any findings
        // TODO: FIX THIS
        $count=0;//how many did we find
        while ($item = mysql_fetch_array($item_q) ){
            $count++;
            // CONNECT TO THE VWOW DB
            $database = MANGOS_VWOW;include('dbconn.php');

            // GRAB THE ICON FILENAME FROM IT...
            $sql = "SELECT * FROM  `icons` WHERE `id` = ".$item['displayid'];
            include('dbselect.php');
            $iconItem = mysql_fetch_array($query);
            // SAVE THE FILE NAME
            $icon = $iconItem['iconname'];
            
            // GRAB THE QUALITY COLOR..
            $color = $qualityColor[$item['Quality']];
            $display_item[$count] = "
                <td>
                    <a href='index.php?pt=itv&id=".$item['entry']."' onmouseover=\"tooltip.show('".itemPInfo($item,$qualityColor)."',300);\"
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
            <div style="width:522px;height:450px;overflow:auto;overflow-x:hidden;">
            <table>
                <tr><td>Name</td></tr>
            <?php
            for($i=1; $i <= count($display_item); $i++)
                    echo '<tr>'.$display_item[$i].'</tr>';
            echo '</table></div>';
        }
        unset($_REQUEST['sr']);
            
    }
    
?>