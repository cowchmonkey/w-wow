<?php
    //include('includes/functions.php');
    
    $entry = $_REQUEST['id'];
    $database = MANGOS_WORLD; include('dbconn.php');
    
    $sql = "SELECT * FROM `item_template` WHERE `entry`=$entry";
    include('dbselect.php');
    $item = mysql_fetch_array($query);
    
    // GRAB THE ICON FILENAME FROM IT...
    $database = MANGOS_VWOW; include('dbconn.php');
    $sql = "SELECT * FROM  `icons` WHERE `id` = ".$item['displayid'];
    include('dbselect.php');
    $iconItem = mysql_fetch_array($query);
    // SAVE THE FILE NAME
    $icon = $iconItem['iconname'];
    
?>

<h3><?php echo $item['name'];?></h3>
<table border="2" cellpadding="0" cellspacing="0" width="100%"><tr><td width="64">
<img align="center" alt="img" src="img/icons/<?php echo $icon;?>.jpg"/>
</td>
<td>
Quality:&nbsp;
<font color="<?php echo $qualityColor[$item['Quality']];?>"><?php echo getQualityName($item['Quality']);?></font>&nbsp;|&nbsp;
<?php echo $inv_type[$item['InventoryType']];?>&nbsp;|&nbsp;<?php echo $binding[$item['bonding']];?><br/>
Vendor Buy at: <?php echo moneyStr($item['SellPrice']);?><br/>
Vendor Sales for: <?php echo moneyStr($item['BuyPrice']);?>

</td></tr></table>

<?php
    /*************************************************************************
     ***************[ DROPS? AND OTHER RES ]*********************************
     **************************************************************************/
?>
<fieldset>
    <legend>Obtained by</legend>
<table><tr><td>
Mob Drops:</td><td>
<select name="mobdrop" >
    <?php
        $database = MANGOS_WORLD;include('dbconn.php');
        $sql = "SELECT * FROM `creature_loot_template` WHERE `item`= $entry";
        include('dbselect.php');
        
        $count = 0;
        while ($mob = mysql_fetch_array($query)){
            $count++;
            echo "<option>".mobName($mob['entry'])." (".$mob['ChanceOrQuestChance']."%)</option>";
        }
        if ($count == 0) echo "<option>None</option>";
    ?>
</select>
</td>
</tr><tr><td>
<?php
    /*************************************************************************
     ***************[ ANY VENDORS SELL IT?  ]*********************************
     **************************************************************************/
?>
Vendors:</td><td>
<select name="vendor" >
    <?php
        $database = MANGOS_WORLD;include('dbconn.php');
        //mysql_selectdb($mangos['world_server']) or die("no server selected");
        $sql = "SELECT * FROM `npc_vendor` WHERE `item`= $entry";
        include('dbselect.php');
        
        $count = 0;
        while ($mob = mysql_fetch_array($query)){
            $count++;
            echo "<option>".mobName($mob['entry'])."</option>";
        }
        if ($count == 0) echo "<option>None</option>";
    ?>
</select>
</td>
</tr><tr>
<td>
    <?php
    /*************************************************************************
     ***************[ IS IT CONTAINED IN ANYTHING? ]**************************
     **************************************************************************/
?>
Contained in:</td><td>
<select name="contained" >
    <?php
        $database = MANGOS_WORLD;include('dbconn.php');
        //mysql_selectdb($mangos['world_server']) or die("no server selected");
        $sql = "SELECT * FROM `item_loot_template` WHERE `item`= $entry";
        include('dbselect.php');
        
        $count = 0;
        while ($mob = mysql_fetch_array($query)){
            $count++;
            echo "<option>".gobName($mob['entry'])."</option>";
        }
        if ($count == 0) echo "<option>None</option>";
    ?>
</select>
</td>
</tr><tr><td>
<?php
    /*************************************************************************
     ***************[ ANY QUEST INVOLVMENT? ]*********************************
     **************************************************************************/
?>
Quest Invmt.:</td><td>
<form method="get" action="index.php">
<select name="id" onChange="this.form.submit()">
    <?php
        $database = MANGOS_WORLD;include('dbconn.php');
       // mysql_selectdb($mangos['world_server']) or die("no server selected");
        $sql = "SELECT * FROM `quest_template`
            WHERE
                `RewItemId1` = $entry ||
                `RewItemId2` = $entry ||
                `RewItemId3` = $entry ||
                `RewItemId4` = $entry ";                        
        include('dbselect.php');
        
        $count = 0;
        while ($quest = mysql_fetch_array($query)){
            $count++;
            echo "<option value='".$quest['entry']."'>".$quest['Title']."</option>";
        }
        if ($count == 0) echo "<option>None</option>";
    ?>
    <input type="hidden" value="displquest" name="st"/>
</select><input type="submit" value="»"/>
</form>
</td>
</tr></table>

<?php
    /*************************************************************************
     ***************[ REQUIREMENT TO USE THIS ITEM ]**************************
     **************************************************************************/
?>
</fieldset>
<br/>
<fieldset>
    <legend>Requirements</legend>
        <table class="info">
            <tr>
                <td colspan="2">Class:<?php if($item['AllowableClass']== -1){ echo "&nbsp;<input type='text' disabled='disabled' value= 'All Races'";}
                    else{
                        
                    }?>
                </td>
                <td colspan="2">Races:<?php if($item['AllowableRace']== -1){ echo "&nbsp;<input type='text' disabled='disabled' value= 'All Races'";}
                    else{
                        
                    }?>
                </td>
            </tr><tr>
                <td>Item Level:<?php echo $item['ItemLevel'];?></td>
                <td>Required Level:<?php echo $item['RequiredLevel'];?></td>
                <td>Durability:<?php echo $item['MaxDurability'];?>/<?php echo $item['MaxDurability'];?></td>
                
            </tr>
        </table>
</fieldset>
<?php
    /*************************************************************************
     ***************[ IS THIS A WEAPON       ]*********************************
     **************************************************************************/
?>
<?php
    // === WEAPON CLASS ====
    if($item['class'] == 2){
    ?>
    <fieldset>
        <legend>Weapon Stats</legend>
        <table >
            <tr>
                <td>Damage:<?php echo $item['dmg_min1'];?> - <?php echo $item['dmg_max1'];?></td>
                <td>DPS:<?php echo calcDps($item['delay'],$item['dmg_min1'],$item['dmg_max1']);?>/sec</td>
                <td></td>
                <td></td>
                
            
        </table>
    </fieldset>
<?php
    /*************************************************************************
     ***************[ WEAPON OR ARMOR SPEACIALS ]*****************************
     **************************************************************************/
?>    
    <?
    }
    
    if(($item['class'] == 2 || $item['class'] == 4) && $item['stat_value1'] > 0){
        ?>
        <fieldset>
            <legend>Stat Buffs</legend>
            <table class="info">
                <tr>
                    <?php
                        for($i = 1; $i <= 7; $i++){
                            if($item['stat_value'.$i] > 0 ){
                                echo "<td>".$stat_type[$item['stat_type'.$i]]."
                                (+".$item['stat_value'.$i].")</td>";
                            }
                        }
                    ?>
                </tr>
            </table
        </fieldset>
   <?php } ?>
