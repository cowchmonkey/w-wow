<?php
    $entry = $_REQUEST['id'];
    // TODO: MAKE THE FOLLOWING A SINGLE FUNCTION -------------------------
    //FIND OUR NPC ID- (QUESTRELATION = GIVER)
    mysql_selectdb($mangos['world_server']);
    $sql = "SELECT * FROM creature_questrelation WHERE id=$entry";
    $giver = mysql_query($sql) or die("Bad query: $sql<br/>".mysql_error());
    //$giver = mysql_fetch_array($sql);
    
    //FIND OUR NPC ID- (INVOLVEDRELATION = TAKER)
    $sql = "SELECT * FROM creature_involvedrelation WHERE id=$entry";
    $taker = mysql_query($sql) or die("Bad query: $sql<br/>".mysql_error());
    //$taker = mysql_fetch_array($sql);
    
    //FIND OUR NPC 
    $sql = "SELECT * FROM creature_template WHERE entry=$entry";
    $sql = mysql_query($sql) or die("Bad query finding npc: $sql<br/>".mysql_error());
    $mob = mysql_fetch_array($sql);
    
    
?>
<fieldset>
    <legend>Creature Info</legend>
    <table width="100%">
        <tr><td><b><?php echo $mob['name'];?></b><br><small><?php if($mob['subname']) echo "<".$mob['subname'];?></<small></td><td>Level:<?php echo $mob['minlevel'];?></td></tr>
        <tr><td>Level (min-max)</td><td><?php echo $mob['minlevel'];?> - <?php echo $mob['maxlevel'];?> </td></tr>
        <tr><td>Health:</td><td><?php echo $mob['minhealth'];?> / <?php echo $mob['maxhealth'];?></td></tr>
        <tr><td>Damage:</td><td><?php echo$mob['mindmg'];?>-<?php echo$mob['maxdmg'];?></td></tr>
        <tr><td>Ranged Dmg:</td><td><?php echo$mob['minrangedmg'];?>-<?php echo$mob['maxrangedmg'];?></td></tr>
        <tr><td>Attack Pwr:</td><td><?php echo$mob['attackpower'];?></td></tr>
        <tr><td>Ranged Atk Pwr:</td><td><?php echo$mob['rangedattackpower'];?></td></tr>
        <tr><td>DPS:</td><td><?php echo calcDps($mob['baseattacktime'],$mob['mindmg'],$mob['maxdmg']);?>dps</td></tr>
        <tr><td>Ranged Dmg:</td><td><?php echo$mob['minrangedmg'];?>-<?php echo$mob['maxrangedmg'];?></td></tr>
    </table>
</fieldset>
<br/>
<?php if($giver){ ?>
<fieldset>
    <legend>Gives out Quest...</legend>
    <?php
        while($q_giver = mysql_fetch_array($giver)){
            $quest = questNfo($q_giver['quest']);
            echo "<a href='index.php?st=displquest&id=".$quest['entry']."'
                onmouseover=\"tooltip.show('".questPInfo($quest)."',300);\"
                onmouseout=\"tooltip.hide();\">".$quest['Title']."<br/>";
        }
    ?>
</fieldset>
<?php }
if($taker) { ?>
<br/>
<fieldset>
    <legend>Takes Quest...</legend>
    <?php
        while($q_taker = mysql_fetch_array($taker)){
            $quest = questNfo($q_taker['quest']);
            echo "<a href='index.php?st=displquest&id=".$quest['entry']."'
                onmouseover=\"tooltip.show('".questPInfo($quest)."',300);\"
                onmouseout=\"tooltip.hide();\">".$quest['Title']."<br/>";
        }
    ?>
</fieldset>
<?php } ?>