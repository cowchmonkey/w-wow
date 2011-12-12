<?php
    
    //include_once('includes/dbvars.php');
    //i//nclude_once('includes/ttips.php');
    
    /**
     * CLEANS UP A USER INPUT
     * */
    function cleanStr($dirty){
        $clean = stripslashes($dirty);
        $clean = mysql_real_escape_string($dirty);
        return $clean;
    }
    
    function tableItem($table,$field,$comp,$value, $class){
        global $mangos;
        @mysql_selectdb($mangos['vwow']) or
            die('Cannot connect to '.$mangos['vwow']);
        $sql = "SELECT * FROM `$table` WHERE `$field` = $comp";
        $query = mysql_query($sql) or die("bad query:$sql<p/>".mysql_error());
        $result = mysql_fetch_array($query) or die("bad query tableItem:<br>table:$table<br/>field:$field<br/>comp:$comp<br/>value$value<br/>class:$class<p/>$sql<p/>".mysql_error());
        return $result[$value];    
    }
    
    
    /**
     * RETURNS A FORMATED HTML STRING FOR THE TOOL TIP
     * CURRENTLY WORKS WELL WITH WEAPONS AND SOME ITEMS. WILL BE CLEANED UP
     * LATER. CURRENTLY ONLY ISSUE IS THE TYPE THAT SHOWS. I.E. BAG MAY COME UP
     * AS AN 'AXE'
     * *************************************************************************/
    function showTip($item, $class_, $subclass){
        
        /** TODO CSS THIS - CURRENTLY FOR TESTING **/
        include('includes/dbvars.php');
        //$color      = tableItem('colors','id',$item['Quality'],'color',$class);
        $color = $qualityColor[$item['Quality']];
        //$binding    = tableItem('bindtype','id',$item['bonding'],'bindtype',$class);
        $binding = $binding[$item['bonding']];
                             
        $info  = "<font color=\'#ffffff\' size=2 face=\'tahoma\'>";
        $info .= "<font color=\'$color\'><b>".$item['name']."</b></font>&nbsp;";
        $info .= "<br/><div style=\'float:left;\'>$binding</div>";     
        
        if($class == 2){ // weapon show damage and such...
            //$weapon     = tableItem('subclass2','id',$item['subclass'],'name',$class);
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
    
    function calcDps($delay,$min,$max){
        
        if($min + $max > 0 ){
            $delay = $delay/1000;
            $dps = $min + $max; 
            $dps = (float)($dps / 2); 
            $dps = (float)($dps / $delay);
        }else{ $dps = 0.0000; }
        //$dps = (($item['dmg_min1'] + $item['dmg_max1'])/2)/(float)($item['delay']/1000);
        $dps = number_format($dps,2);
        return $dps;
    }
    
    /**
     * USED FOR ITEM INFO
     * */
    function moneyStr($money){
        $money = moneyFormat($money);
        $money = explode("-",$money);
        $info = "";
        $info .= $money[0]."<img src='img/Gold.png'> ";
        $info .= $money[1]."<img src='img/Silver.png'> ";
        $info .= $money[2]."<img src='img/Copper.png'> ";
        return $info;
    }
    function getIcon($modelID){
        global $mangos;
        @mysql_selectdb($mangos['vwow']) or
            die('Cannot connect to '.$mangos['vwow']);
            
        $sql = "SELECT * FROM  `icons` WHERE `id` = $modelID";
        $query = mysql_query($sql) or die(mysql_error());
        $icon = mysql_fetch_array($query);
        return $icon['iconname'];
    }
    
    /*
    function getColor($quality){
        include('includes/config.php');
        mysql_selectdb($mangos['vwow']) or
            die('Cannot connect to '.$mangos['vwow']);
        $sql = "SELECT * FROM `colors` WHERE `id`=$quality";
        $query = mysql_query($sql);
        $color = mysql_fetch_array($query);
        return $color['color'];
    }
    */
    
    function getQualityName($quality){
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
    
    function moneyFormat($cp /* copper pieces */){
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
    
    /**
     * RETURNS A STRING OF INFO FOR THE POPUP
     * */
    function itemPInfo($item){
        $class = $item['class'];
        $subclass = $item['subclass'];
        $item['name'] = str_ireplace("'","",$item['name']);
        return showTip($item, $class,$subclass);
        /*
        switch ($class){
            case 1: return showContainerTip($item, $class);break;
            case 2: return showWeaponTip($item, $class);   break;
            default: return showWeaponTip($item, $class); 
            
        }
        */
    }
    
    function questPInfo($quest){
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
     * RETURNS THE NAME OF A MOB/NPC
     * */
    function mobName($id){
        global $mangos;
        $sql = "SELECT * FROM `creature_template` WHERE `entry` = $id";
        $query = @mysql_query($sql) or die("Bad Query:<br/>$sql<p/>".mysql_error());
        $r = mysql_fetch_array($query);
        return $r['name'];
    }
    
    /**
     * RETURNS THE NAME OF A MOB/NPC
     * */
    function gobName($id){
        global $mangos;
        $sql = "SELECT * FROM `gameobject_template` WHERE `entry` = $id";
        $query = mysql_query($sql);
        $r = mysql_fetch_array($query);
        return $r['name'];
    }
    
    /**
     * RETURNS THE NAME OF A MOB/NPC
     * */
    function itemName($id){
        global $mangos;
        mysql_selectdb($mangos['world_server']) or die("bad db in itemName()");
        $sql = "SELECT * FROM `item_template` WHERE `entry` = $id";
        $query = mysql_query($sql) or die("func:itemName() bad query $sql");
        $r = mysql_fetch_array($query);
        return $r['name'];
    }
    
    /**
     * RETURNS THE NAME OF A FACTION
     * */
    function factionName($id){
        global $mangos;
        mysql_selectdb($mangos['vwow']) or die("bad db in itemName()");
        $sql = "SELECT * FROM `factions` WHERE `id` = $id";
        $query = mysql_query($sql) or die("func:factionName() bad query $sql");
        $r = mysql_fetch_array($query);
        return $r['name'];
    }
    
    /**
     * RETURNS THE NAME QUEST INFO
     * */
    function questNfo($id){
        global $mangos;
        mysql_selectdb($mangos['world_server']) or die("bad db in itemName()");
        $sql = "SELECT * FROM `quest_template` WHERE `entry` = $id";
        $query = mysql_query($sql) or die("func:itemName() bad query $sql");
        $r = mysql_fetch_array($query);
        return $r;
    }
    
    
    /**
     * RETURNS THE NAME QUEST INFO
     * */
    function itemNfo($id){
        global $mangos;
        mysql_selectdb($mangos['world_server']) or die("bad db in itemName()");
        $sql = "SELECT * FROM `item_template` WHERE `entry` = $id";
        $query = mysql_query($sql) or die("func:itemName() bad query $sql");
        $r = mysql_fetch_array($query);
        return $r;
    }
    
    /**
     * RETURNS THE MOB ARRAY
     * */
    function mobMapNfo($id){
        global $mangos;
        mysql_selectdb($mangos['world_server']) or die("bad db in itemName()");
        $sql = "SELECT * FROM `creature` WHERE `id` = $id";
        $query = mysql_query($sql) or die("func:mobMapNfo() bad query $sql");
        while ($r = mysql_fetch_array($query)){
            return $r;
        }
    }
    
    
    /**
     * RETURNS XP OF A QUEST
     *  THANKS TO..http://wow-v.com/forums/index.php?topic=11591.5;wap2
     *      --- AND --
     *  THE AUTHORS OF WOWD 
     * */
    function questXP($quest){
      
        if ($quest['QuestLevel'] >= 55) return intval($quest['RewMoneyMaxLevel'] / 6);
        else if ($quest['QuestLevel'] == 54) return intval($quest['RewMoneyMaxLevel'] / 4.8);
        else if ($quest['QuestLevel'] == 53) return intval($quest['RewMoneyMaxLevel'] / 3.666);
        else if ($quest['QuestLevel'] == 52) return intval($quest['RewMoneyMaxLevel'] / 2.4);
        else if ($quest['QuestLevel'] == 51) return intval($quest['RewMoneyMaxLevel'] / 1.2);
        else if ($quest['QuestLevel'] <= 50) return intval($quest['RewMoneyMaxLevel'] / 0.6);
        return 0;
    }
    
    /**
     * GET ZONE LOCATION
     * COORDS TABLE FROM WOWD
     * */
    function zoneName($posMap, $posX, $posY){
        global $mangos;
        
        mysql_selectdb($mangos['vwow']);
        $sql = "SELECT * FROM `zones`";
        $query = mysql_query($sql) or die("bad query:<br/>$sql<p/>".mysql_error());
        while ($map = mysql_fetch_array($query)){
            if( $posX <= $map['x_max'] && $posX >= $map['x_min'] &&
                $posY <= $map['y_max'] && $posY >= $map['y_min'] && $map['areatableID'] != 0 ){
                    
                return $map['name'];
            }
        }
        return 'wandering';
    }
    
    /**
     * RETURNS TOTAL PLAYERS ONLINE
     * */
    function onlinePlayers(){
        global $mangos;
        mysql_selectdb($mangos['characters']);
        $sql = "SELECT * FROM `characters` WHERE `online` = 1";
        $query = mysql_query($sql);
        return mysql_num_rows($query);
        
    }
    
    /**
     * RETURNS LIST OF REALM NAMES
     * */
    function realmNames(){
        global $mangos;
        mysql_selectdb($mangos['realmd']) or die("cant load db in realmNames()");
        $sql = "SELECT * FROM `realmlist`";
        $query = mysql_query($sql) or die("bad query for realmNames()<br/>$sql<p/>".mysql_error());
        return mysql_fetch_array($query);    
    }
    
    function uptime(){
        global $mangos;
        mysql_selectdb($mangos['realmd']);
        $sql = mysql_query ("SELECT * FROM `uptime` ORDER BY `starttime` DESC LIMIT 1");
        $uptime_results = mysql_fetch_array($sql);
        if ($uptime_results['uptime'] > 86400) 
            $uptime =  round(($uptime_results['uptime'] / 24 / 60 / 60),2)." Days";
        elseif($uptime_results['uptime'] > 3600)
            $uptime =  round(($uptime_results['uptime'] / 60 / 60),2)." Hours";
        else
            $uptime =  round(($uptime_results['uptime'] / 60),2)." Min";
        return $uptime;

    }
    
    function raceStats(){
        $race = array();
        $class = array();
        for($n=1; $n <= 11; $n++){
            $sql = "SELECT COUNT(race) FROM `characters` WHERE `race`=".$n;
            $query = mysql_query($sql);
            $race[$n] = mysql_result($query, 0);
            mysql_free_result($query);
        }
        for($n=1; $n <= 11; $n++){
            $sql = "SELECT COUNT(class) FROM `characters` WHERE `class`=".$n;
            $query = mysql_query($sql);
            $class[$n] = mysql_result($query, 0);
            mysql_free_result($query);
        }

        echo "Humans: ".$race[1]."<br>";
        echo "Dwarves: ".$race[3]."<br>";
        echo "Night Elf: ".$race[4]."<br>";
        echo "Gnome: ".$race[7]."<br>";
        echo "Orc: ".$race[2]."<br>";
        echo "Undead: ".$race[5]."<br>";
        echo "Tauren: ".$race[6]."<br>";
        echo "Troll: ".$race[8]."<br>";
        echo "Druid: ".$class[11]."<br>";
        echo "Hunter: ".$class[3]."<br>";
        echo "Mage: ".$class[8]."<br>";
        echo "Paladin: ".$class[2]."<br>";
        echo "Priest: ".$class[5]."<br>";
        echo "Rogue: ".$class[4]."<br>";
        echo "Shaman: ".$class[7]."<br>";
        echo "Warlock: ".$class[9]."<br>";
        echo "Warrior: ".$class[1]."<br>";
    }
    
    function userInfo($id){
         global $mangos;
        mysql_selectdb($mangos['realmd']);
        $sql = "SELECT * FROM `account` WHERE `id` = $id";
        $query = mysql_query($sql);
        return mysql_fetch_array($query);
    }
    
?>