<?php
    $entry = $_REQUEST['id'];
    $quest = questNfo($entry);
    
    // TODO: MAKE THE FOLLOWING A SINGLE FUNCTION -------------------------
    //FIND OUR NPC ID- (QUESTRELATION = GIVER)
    $sql = "SELECT * FROM creature_questrelation WHERE quest=$entry";
    $sql = mysql_query($sql) or die("Bad query: $sql<br/>".mysql_error());
    $the_giver = mysql_fetch_array($sql);$giverid = $the_giver['id']; $giver_name = mobName($giverid);
    
    //FIND OUR NPC ID- (INVOLVEDRELATION = TAKER)
    $sql = "SELECT * FROM creature_involvedrelation WHERE quest=$entry";
    $sql = mysql_query($sql) or die("Bad query: $sql<br/>".mysql_error());
    $the_taker = mysql_fetch_array($sql);$takerid = $the_taker['id']; $taker_name = mobName($takerid);
    
    //LOAD THE RESULTS
    $result = mysql_fetch_array($sql);
    
    //echo $quest['Title'];
?>
<fieldset>
    <legend><?php echo $quest['Title'];?></legend>
    <table>
        <tr>
            <td>
                Quest Level:<?php echo $quest['QuestLevel'];?><br/>
                Obtained at Level:<?php echo $quest['MinLevel'];?><br/>
                Start at:<a href="index.php?st=displmob&id=<?php echo $giverid;?>"><?php echo $giver_name;?></a><br/>
                End at:<a href="index.php?st=displmob&id=<?php echo $takerid;?>"><?php echo $taker_name;?></a><br/><br/>
                <?php echo $quest['Objectives'];?>
            </td>
        </tr>
    </table>
</fieldset>
<br/>
<fieldset>
    <legend>Story</legend>
    <table>
        <tr>
            <td>Collect:</td></tr><tr><td>
                <?php
                    for($i = 1;$i<=4;$i++){
                        if($quest['ReqItemCount'.$i] > 0 ){
                            echo '<a href="index.php?st=displItem&id='.$quest['ReqItemId'.$i].'">';
                            echo itemName($quest['ReqItemId'.$i])."</a>  0/".$quest['ReqItemCount'.$i]."<br/>";
                        }
                    }
                ?>
                <br/>
                <?php
                    $quest['Details'] = str_ireplace("\$B","<br/>",$quest['Details']);
                    echo '"...<i>'.$quest['Details'].'</i>"';
                ?>
            </td>
        </tr>
    </table>
</fieldset>

<br/>
<fieldset>
    <legend>Rewards</legend>
    <table>
        <tr>
            <td>
                <?php
                if($quest['RewItemCount1'] > 0){ ?>
                <b>Auto Rewarded:</b><br/>
                <?php
                    for($i = 1;$i<=4;$i++){
                        if($quest['RewItemCount'.$i] > 0 ){
                            if($i != 1 ) echo "&nbsp;+&nbsp;";
                            $item = itemNfo($quest['RewItemId'.$i]);
                            echo "<a href=\"index.php?st=displItem&id=".$item['entry']."\" onmouseover=\"tooltip.show('".itemPInfo($item['entry'])."',300);\"
                onmouseout=\"tooltip.hide();\">";
                            echo '<img width="30" height="30" src="img/icons/'.getIcon($item['displayid']).'.jpg"/>&nbsp;';
                            echo '</a>';
                            
                        }
                    }
                }
                if($quest['RewChoiceItemCount1'] > 0){ ?>
                <p/>
                
                <b>Rewards by Choice:</b><br/>
                <?php
                    for($i = 1;$i<=4;$i++){
                        if($quest['RewChoiceItemCount'.$i] > 0 ){
                            if($i != 1 ) echo "&nbsp;+&nbsp;";
                            $item = itemNfo($quest['RewChoiceItemId'.$i]);
                            echo "<a href=\"index.php?st=displItem&id=".$item['entry']."\" onmouseover=\"tooltip.show('".itemPInfo($item['entry'])."',300);\"
                onmouseout=\"tooltip.hide();\">";
                            echo '<img width="30" height="30" src="img/icons/'.getIcon($item['displayid']).'.jpg"/>&nbsp;';
                            echo '</a>';
                            
                        }
                    }
                }
                ?>
            </td>
        </tr><tr>
            <td><b>Reputaion:</b><br/>
                <?php
                    for($i = 1;$i<=5;$i++){
                        if($quest['RewRepValue'.$i] > 0 ){
                           echo factionName($quest['RewRepFaction'.$i]). ":&nbsp;".$quest['RewRepValue'.$i]."<br/>";
                        }
                    }
                ?>
                <br/>
                Experience: <?php echo questXP($quest);?>xp<br/>
                Money: <?php echo moneyStr($quest['RewMoneyMaxLevel']);?>
            </td>
        </tr>
    </table>
</fieldset>