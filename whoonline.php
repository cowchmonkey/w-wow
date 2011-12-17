
<center><table border="0" width="100%">
  <tr>
   <td><b>Nick:    </b></td>
   <td><b>Race:    </b></td>
   <td><b>Class:    </b></td>
   <td><b>Level:    </b></td>
   <td><b>Gender:    </b></td>
  </tr>
  
<?php

$database = MANGOS_CHAR;include('dbconn.php');
$sql = "SELECT name, race, class, level, gender FROM characters WHERE online = 1";
include('dbselect.php');
$num_online = mysql_num_rows($query);

$class = array(1=>"Warrior",2=>"Paladin",3=>"Hunter",4=>"Rogue",5=>"Priest",6=>"Death Knight",7=>"Shaman",8=>"Mage",9=>"Brujo",11=>"Druid");
$race = array(1=>"Human",2=>"Orc",3=>"Dwarf",4=>"Night Elf",5=>"Undead",6=>"Tauren",7=>"Gnome",8=>"Troll",10=>"Blood Elf",11=>"Draenei");
$gender = array(0=>"Male",1=>"Female");

if($num_online < 1) {
  echo "<tr><td colspan='4' align='center'>No Players Online!</td></tr></table>";
}

for($i=0; $i<= $num_online; $i++) {
  $row = mysql_fetch_array($query);
  $t_name = $row['name'];
  $t_race = $row['race'];
  $t_class = $row['class'];
  $t_lvl = $row['level'];
  $t_gender = $row['gender'];
  
  echo "<tr><td><b>$t_name</b></td>";
  echo "<td><b>$race[$t_race]</b></td>";
  echo "<td><b>$class[$t_class]</b></td>";
  echo "<td><b>$t_lvl</b></td>";
  echo "<td><b>$gender[$t_gender]</b></td>
    </tr></table>";
}
?>