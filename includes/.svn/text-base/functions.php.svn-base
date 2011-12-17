<?php

    /**
     * RETURNS A FORMATED HTML STRING FOR THE TOOL TIP
     * CURRENTLY WORKS WELL WITH WEAPONS AND SOME ITEMS. WILL BE CLEANED UP
     * LATER. CURRENTLY ONLY ISSUE IS THE TYPE THAT SHOWS. I.E. BAG MAY COME UP
     * AS AN 'AXE'
     * *************************************************************************/
    function showTip($item, $class_, $subclass){
        
        /** TODO CSS THIS - CURRENTLY FOR TESTING **/
        // GRAB THE QUALITY COLOR..
       include('db_data.php');
       $color = $qualityColor[$item['Quality']];
       

        $binding = $binding[$item['bonding']];
                             
        $info  = "<font color=\'#ffffff\' size=2 face=\'tahoma\'>";
        $info .= "<font color=\'$color\'><b>".$item['name']."</b></font>&nbsp;";
        $info .= "<br/><div style=\'float:left;\'>$binding</div>";     
        
        if($class == 2){ // weapon show damage and such...
            $weapon = $class[$class_][$subclass];
            $info .= "<div style=\'float:right;\'>".$weapon."</div>";
            $info .= "<br/><div style=\'float:left;\'>".$item['dmg_min1']."-".$item['dmg_max1']." Damage</div>";
            $info .= "<div style=\'float:right;\'>Speed: ".(float)($item['delay']/1000)."</div><br/>";
            $min = $item['dmg_min1']; $max = $item['dmg_max1']; $delay = $item['delay'];
            if($min + $max > 0 ){
                $delay = $delay/1000;
                $dps = $min + $max; 
                $dps = (float)($dps / 2); 
                $dps = (float)($dps / $delay);
            }else{ $dps = 0.0000; }
            //$dps = (($item['dmg_min1'] + $item['dmg_max1'])/2)/(float)($item['delay']/1000);
            $dps = number_format($dps,2);
            $info .= "($dps per second)";
        }else{
            /** TODO: PUT A SWITCH HERE FOR CLASS TYPE FOR CORRECT DISPLAY ON ITEMS **/
            //$other      = tableItem('subclass1','id',$item['subclass'],'name',$class);
            if($class_ > 0 && $subclass > 0 ){
                $other = $class[$class_][$subclass];
                $info .= "<div style=\'float:right;\'>".$other."</div>";
            }
        }
        
        $info .= "<br/>Durability: ".$item['MaxDurability']."/".$item['MaxDurability'];
        $info .= "<br/>Required Level: ".$item['RequiredLevel'];
        $info .= "<br/>Item Level: ".$item['ItemLevel'];
        $money = moneyFormat($item['SellPrice']);
        $info .= "<br>Selling Price: ";
        $money = explode("-",$money);
        $info .= $money[0]."<img src=\'img/Gold.png\'> ";
        $info .= $money[1]."<img src=\'img/Silver.png\'> ";
        $info .= $money[2]."<img src=\'img/Copper.png\'> ";
        return $info;
    }
    /*****************************************************************************/
    
    function mobPInfo($mob){
        global $qualityColor;
        $info  = "<font color=\'#ffffff\' size=2 face=\'tahoma\'>";
        $info .= "<font color=\'orange\'><b>".$mob['name']."</b></font>";
        $info .= "<table width=\'100%\'>";
        $info .= "<tr><td>Level (min-max)</td><td>".$mob['minlevel']."-".$mob['maxlevel']."</td></tr>";
        $info .= "<tr><td>Health:</td><td>".$mob['minhealth']."/".$mob['maxhealth']."</td></tr>";
        $info .= "<tr><td>Damage:</td><td>".$mob['mindmg']."-".$mob['maxdmg']."</td></tr>";
        $info .= "<tr><td>Ranged Dmg:</td><td>".$mob['minrangedmg']."-".$mob['maxrangedmg']."</td></tr>";
        $info .= "<tr><td>Attack Pwr:</td><td>".$mob['attackpower']."</td></tr>";
        $info .= "<tr><td>Ranged Atk Pwr:</td><td>".$mob['rangedattackpower']."</td></tr>";
        $info .= "<tr><td>DPS:</td><td>".calcDps($mob['baseattacktime'],$mob['mindmg'],$mob['maxdmg'])."dps</td></tr>";
        $info .= "<tr><td>Ranged Dmg:</td><td>".$mob['minrangedmg']."-".$mob['maxrangedmg']."</td></tr>";
        $info .= "</table>";
        return $info;
    }
    
     /**
     * RETURNS A STRING OF INFO FOR THE POPUP
     * */
    function itemPInfo($item)
    {
        $class = $item['class'];
        $subclass = $item['subclass'];
        $item['name'] = str_ireplace("'","",$item['name']);
        return showTip($item, $class,$subclass);
    }
    /**
     * CLEANS UP A USER INPUT
     * */
    function cleanStr($dirty)
    {
        $clean = stripslashes($dirty);
        $clean = mysql_real_escape_string($dirty);
        return $clean;
    }
    
    function moneyFormat($cp /* copper pieces */)
    {
        $gp = floor($cp/10000); $cp -= $gp * 10000;
        $sp = floor($cp/100);   $cp -= $sp * 100;
        return "$gp-$sp-$cp";
    /*
        return "<br/>Sell Price: 
                    $gp<img src='img/Gold.png' />
                    $sp<img src='img/Silver.png' />
                  $cp<img src='img/Copper.png' />";
    */
    }
    
    function getQualityName($quality)
    {
        switch($quality){
            case 0: return "Poor";      break;
            case 1: return "Common";    break;
            case 2: return "Uncommon";  break;
            case 3: return "Rare";      break;
            case 4: return "Epic";      break;
            case 5: return "Legendary"; break;
            case 6: return "Artifact";  break;
            case 7: return "Heirloom";  break;
        }
    }
    
    /**
     * USED FOR ITEM INFO
     * */
    function moneyStr($money)
    {
        $money = moneyFormat($money);
        $money = explode("-",$money);
        $info = "";
        $info .= $money[0]."<img src='img/Gold.png'> ";
        $info .= $money[1]."<img src='img/Silver.png'> ";
        $info .= $money[2]."<img src='img/Copper.png'> ";
        return $info;
    }
    
    function calcDps($delay,$min,$max)
    {
        
        if($min + $max > 0 )
        {
            $delay = $delay/1000;
            $dps = $min + $max; 
            $dps = (float)($dps / 2); 
            $dps = (float)($dps / $delay);
        }else{ $dps = 0.0000; }
        //$dps = (($item['dmg_min1'] + $item['dmg_max1'])/2)/(float)($item['delay']/1000);
        $dps = number_format($dps,2);
        return $dps;
    }
    
    function questPInfo($quest)
    {
        // CLEAN UP THE TITLE
        $quest['Title'] = str_ireplace("'","",$quest['Title']);
        $quest['Objectives'] = str_ireplace("'","",$quest['Objectives']);
        $info  = "<font color=\'#ffffff\' size=2 face=\'tahoma\'>";
        $info .= "<font color=\'orange\'><b>".$quest['Title']."</b></font>";
        $info .= "<div style=\'float:right;color:#c0c0c0;\'>Level: ".$quest['MinLevel']."</div><br><br/>";
        $info .= $quest['Objectives']."<br/><br/>";
        $info .= "Requirements:<br/>";
        for($i = 1; $i<=4; $i++){
            if($quest['ReqItemId'.$i] > 0){ $info .= "- ".itemName($quest['ReqItemId'.$i])." x".$quest['ReqItemCount'.$i]."<br/>"; }
            // future use
            //if($quest['ReqItemId'.$i] > 0){ $info .= "- ".itemName($quest['ReqItemId'.$i])." x".$quest['ReqItemCount'.$i]."<br/>"; }
            //if($quest['ReqItemId'.$i] > 0){ $info .= "- ".itemName($quest['ReqItemId'.$i])." x".$quest['ReqItemCount'.$i]."<br/>"; }
            //if($quest['ReqItemId'.$i] > 0){ $info .= "- ".itemName($quest['ReqItemId'.$i])." x".$quest['ReqItemCount'.$i]."<br/>"; }
        }
        return $info;
    }
    
    
    /**
     * RETURNS XP OF A QUEST
     *  THANKS TO..http://wow-v.com/forums/index.php?topic=11591.5;wap2
     *      --- AND --
     *  THE AUTHORS OF WOWD 
     * */
    function questXP($quest)
    {
      
        if ($quest['QuestLevel'] >= 55) return intval($quest['RewMoneyMaxLevel'] / 6);
        else if ($quest['QuestLevel'] == 54) return intval($quest['RewMoneyMaxLevel'] / 4.8);
        else if ($quest['QuestLevel'] == 53) return intval($quest['RewMoneyMaxLevel'] / 3.666);
        else if ($quest['QuestLevel'] == 52) return intval($quest['RewMoneyMaxLevel'] / 2.4);
        else if ($quest['QuestLevel'] == 51) return intval($quest['RewMoneyMaxLevel'] / 1.2);
        else if ($quest['QuestLevel'] <= 50) return intval($quest['RewMoneyMaxLevel'] / 0.6);
        return 0;
    }
    
    /**
     * RETURNS THE NAME OF A MOB/NPC
     * */
    function itemName($id)
    {
        $database = MANGOS_WORLD;include('dbconn.php');
        $sql = "SELECT * FROM `item_template` WHERE `entry` = $id";
        include('dbselect.php');
        $r = mysql_fetch_array($query);
        return $r['name'];
    }
    
     /**
     * RETURNS THE NAME QUEST INFO
     * */
    function questNfo($id)
    {
        $database = MANGOS_WORLD;include('dbconn.php');
        $sql = "SELECT * FROM `quest_template` WHERE `entry` = $id";
        include('dbselect.php');
        $r = mysql_fetch_array($query);
        return $r;
    }
    
     /**
     * RETURNS THE NAME OF A MOB/NPC
     * */
    function mobName($id)
    {
        $database = MANGOS_WORLD;include('dbconn.php');
        $sql = "SELECT * FROM `creature_template` WHERE `entry` = $id";
        include('dbselect.php');
        $r = mysql_fetch_array($query);
        return $r['name'];
    }
    
    /**
     * RETURNS THE NAME QUEST INFO
     * */
    function itemNfo($id)
    {
        $database = MANGOS_WORLD;include('dbconn.php');
        $sql = "SELECT * FROM `item_template` WHERE `entry` = $id";
        include('dbselect.php');
        $r = mysql_fetch_array($query);
        return $r;
    }
    
    /**
     * RETURNS THE NAME OF A FACTION
     * */
    function factionName($id)
    {
        $database = MANGOS_VWOW;include('dbconn.php');
        $sql = "SELECT * FROM `factions` WHERE `id` = $id";
        include('dbselect.php');
        $r = mysql_fetch_array($query);
        return $r['name'];
    }
    
    /**
     * RETURNS THE MOB ARRAY
     * */
    function mobMapNfo($id)
    {
        $database = MANGOS_WORLD;include('dbconn.php');
        $sql = "SELECT * FROM `creature` WHERE `id` = $id";
        include('dbselect.php');
        while ($r = mysql_fetch_array($query)){
            return $r;
        }
    }
    
    /**
     * GET ZONE LOCATION
     * worldareatable.dbc
     * */
    function zoneName($posMap, $posX, $posY)
    {
        $database = MANGOS_VWOW;include('dbconn.php');
        $sql = "SELECT * FROM `zones`";include('dbselect.php');
        
        while ($map = mysql_fetch_array($query))
        {
            if( $map['x_max'] > $posX && $map['x_min']< $posX &&
                $map['y_max'] > $posY && $map['y_min']< $posY &&
                /** DONT WANT KALMADOR OR AZEROTH - WE JUST WANT THE GENREAL AREA */
                $map['areaID'] != 0 && 
                $map['mapID'] == $posMap )
                    return $map['name'];
        }
        return 'wandering';
    }
    
    
    /**
     * RETURNS LIST OF REALM NAMES
     * */
    function realmNames()
    {
        $database = MANGOS_REALMD;include('dbconn.php');
        $sql = "SELECT * FROM `realmlist`";
        include('dbselect.php');
        return mysql_fetch_array($query);    
    }
    
    function uptime()
    {
        $database = MANGOS_REALMD;include('dbconn.php');
        $sql = "SELECT * FROM `uptime` ORDER BY `starttime` DESC LIMIT 1";
        include('dbselect.php');
        $uptime_results = mysql_fetch_array($query);
        if ($uptime_results['uptime'] > 86400) 
            $uptime =  round(($uptime_results['uptime'] / 24 / 60 / 60),2)." Days";
        elseif($uptime_results['uptime'] > 3600)
            $uptime =  round(($uptime_results['uptime'] / 60 / 60),2)." Hours";
        else
            $uptime =  round(($uptime_results['uptime'] / 60),2)." Min";
        return $uptime;

    }
    
    /**
     * RETURNS TOTAL PLAYERS ONLINE
     * */
    function onlinePlayers()
    {
        $database = MANGOS_CHAR;include('dbconn.php');
        $sql = "SELECT * FROM `characters` WHERE `online` = 1";
        include('dbselect.php');
        return mysql_num_rows($query);
        
    }
    function localXY($mapid,$x,$y)
    {
        $database = MANGOS_VWOW;include('dbconn.php');
        $sql = "SELECT * FROM zones WHERE ($mapid = mapID and x_min<$x and x_max>$x and y_min<$y and y_max>$y and zoneID != 13 and zoneID != 14)";
        include('dbselect.php');
        $row = mysql_fetch_array($query);
        $loc['x'] = round(100 - ($y - $row["y_min"]) / (($row["y_max"] - $row["y_min"]) / 100),1);
	$loc['y'] = round(100 - ($x - $row["x_min"]) / (($row["x_max"] - $row["x_min"]) / 100),1);
        $loc['name'] = $row['name'];
        return $loc;

    }
?>    