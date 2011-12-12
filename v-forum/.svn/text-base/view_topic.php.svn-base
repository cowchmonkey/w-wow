<?php
if(!isset($_SESSION['userid'])) {
    header('location:index.php?st=noforum');
    die();
}
$user = userInfo($_SESSION['userid']);

$tbl_name="forum_question"; // Table name

// Connect to server and select databse.

mysql_select_db($mangos['vwow'])or die("cannot select DB");

// get value of id that sent from address bar
$id=$_GET['id'];

$sql="SELECT * FROM $tbl_name WHERE id='$id'";
$result=mysql_query($sql);

$rows=mysql_fetch_array($result);
?>
<table width="400" border="0" align="center" cellpadding="0" cellspacing="1">
<tr>
<td><table width="100%" border="0" cellpadding="3" cellspacing="1" bordercolor="1">
<tr>
<td ><strong><? echo $rows['topic']; ?></strong></td>
</tr>

<tr>
<td ><? echo $rows['detail']; ?></td>
</tr>

<tr>
<td ><strong>By :</strong> <? echo $rows['name']; ?> <strong>Email : </strong><? echo $rows['email'];?></td>
</tr>

<tr>
<td ><strong>Date/time : </strong><? echo $rows['datetime']; ?></td>
</tr>
</table></td>
</tr>
</table>
<BR>
<?php
$tbl_name2="forum_answer"; // Switch to table "forum_answer"

$sql2="SELECT * FROM $tbl_name2 WHERE question_id='$id'";
$result2=mysql_query($sql2);

while($rows=mysql_fetch_array($result2)){
?>
<table width="400" border="0" align="center" cellpadding="0" cellspacing="1">
<tr>
<td><table width="100%" border="0" cellpadding="3" cellspacing="1">
<tr>
<td ><strong>ID</strong></td>
<td >:</td>
<td ><? echo $rows['a_id']; ?></td>
</tr>
<tr>
<td width="18%" ><strong>Name</strong></td>
<td width="5%" >:</td>
<td width="77%" ><? echo $rows['a_name']; ?></td>
</tr>
<tr>
<td ><strong>Email</strong></td>
<td >:</td>
<td ><? echo $rows['a_email']; ?></td>
</tr>
<tr>
<td ><strong>Answer</strong></td>
<td >:</td>
<td ><? echo $rows['a_answer']; ?></td>
</tr>
<tr>
<td ><strong>Date/Time</strong></td>
<td >:</td>
<td ><? echo $rows['a_datetime']; ?></td>
</tr>
</table></td>
</tr>
</table><br>

<?
}

$sql3="SELECT view FROM $tbl_name WHERE id='$id'";
$result3=mysql_query($sql3);

$rows=mysql_fetch_array($result3);
$view=$rows['view'];

// if have no counter value set counter = 1
if(empty($view)){
$view=1;
$sql4="INSERT INTO $tbl_name(view) VALUES('$view') WHERE id='$id'";
$result4=mysql_query($sql4);
}

// count more value
$addview=$view+1;
$sql5="update $tbl_name set view='$addview' WHERE id='$id'";
$result5=mysql_query($sql5);

//mysql_close();
?>
<BR>
<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" >
<tr>
<form name="form1" method="post" action="index.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1">
   
<tr>
<td width="18%"><strong>Name</strong></td>
<td width="3%">:</td>
<td width="79%"><?php echo $user['username'];?></td>
</tr>

<tr>
<td><strong>Email</strong></td>
<td>:</td>
<td><input name="a_email" type="text" id="a_email" size="45"></td>
</tr>
<tr>
<td valign="top"><strong>Answer</strong></td>
<td valign="top">:</td>
<td><textarea name="a_answer" cols="45" rows="3" id="a_answer"></textarea></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input name="id" type="hidden" value="<? echo $id; ?>"></td>
<td><input type="submit" name="Submit" value="Submit"> <input type="reset" name="Submit2" value="Reset">
<input type="hidden" name="st" value="answer"/>
<input type="hidden" name="a_name" id="a_name" value="<?php echo $user['username'];?>"/>
</td>
</tr>
</table>
</td>
</form>
</tr>
</table>