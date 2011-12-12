<?php
if(!isset($_SESSION['userid'])) { header('location:index.php?st=noforum');die(); }
mysql_selectdb($mangos['vwow']);

// get data that sent from form
$topic=$_POST['topic'];
$detail=$_POST['detail'];
$name=$_POST['name'];
$email=$_POST['email'];

$datetime=date("d/m/y h:i:s"); //create date time

$sql="INSERT INTO `forum_question` (topic, detail, name, email, datetime)VALUES('$topic', '$detail', '$name', '$email', '$datetime')";
$result=mysql_query($sql);

if($result){
echo "Successful<BR>";
echo "<a href=index.php?st=forum>View your topic</a>";
}
else {
echo "ERROR";
}
//mysql_close();
?>