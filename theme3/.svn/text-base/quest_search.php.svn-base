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
        $database = MANGOS_WORLD;include('dbconn.php');
        
        // lookd for the quest name    
        $sql = "SELECT * FROM `quest_template` WHERE `Title` LIKE '%$search_param%' ORDER BY `minlevel` DESC";
        include('dbselect.php');
        
        // loop through any findings
        $count=0;//how many did we find
        while ($quest = mysql_fetch_array($query) ){
            $count++;
            //$icon = getIcon($item['displayid']);            
            //$color = $qualityColor[$item['Quality']];
            
            //BUILD OUR LIST
            
            $display_quest[$count] = "
            <tr>
                <td>
                    <a href='index.php?pt=qsv&id=".$quest['entry']."'
                        onmouseover=\"tooltip.show('".questPInfo($quest)."',300);\"
                        onmouseout=\"tooltip.hide();\">".$quest['Title']."
                    </a>
                </td>
                <td>".questXP($quest)."xp</td>
                <td>".moneyStr($quest['RewMoneyMaxLevel'])."</td>
            </tr>
            ";
        }
    
        if(!$count){
            echo "No records found matching <font color='#00ff00'><b>$search_param</b></font>";
        }else{
            
            ?>
            <table width="100%" class="info">
                <tr>
                    <td width="260">Title</td><td>Experience</td><td>Money</td>
                </tr>
            <?php
            for($i=1; $i <= count($display_quest); $i++){
                    echo $display_quest[$i].'';
            }
            echo '</table>';
        }
        unset($_REQUEST['sr']);
            
    }
   
?>