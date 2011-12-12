<?php
if(!isset($_SESSION['userid'])) { header('location:index.php?st=noforum');die(); }
mysql_select_db($mangos['vwow'])or die("cannot select DB");

$sql="SELECT * FROM `forum_question` ORDER BY id DESC";
// OREDER BY id DESC is order result by descending
$result=mysql_query($sql);
?>
<table width="100%" border="1" align="center" cellpadding="3" cellspacing="1" >
<tr>
<td width="6%" align="center" ><strong>#</strong></td>
<td width="53%" align="center" ><strong>Topic</strong></td>
<td width="15%" align="center" ><strong>Views</strong></td>
<td width="13%" align="center" ><strong>Replies</strong></td>
<td width="13%" align="center" ><strong>Date/Time</strong></td>
</tr>

<?php
while($rows=mysql_fetch_array($result)){ // Start looping table row
?>
<tr>
<td bgcolor="#0c0c0c"><? echo $rows['id']; ?></td>
<td bgcolor="#0c0c0c"><a href="index.php?st=v_topic&id=<? echo $rows['id']; ?>"><? echo $rows['topic']; ?></a><BR></td>
<td align="center" bgcolor="#0c0c0c"><? echo $rows['view']; ?></td>
<td align="center" bgcolor="#0c0c0c"><? echo $rows['reply']; ?></td>
<td align="center" bgcolor="#0c0c0c"><? echo $rows['datetime']; ?></td>
</tr>

<?php
// Exit looping and close connection
}
//  mysql_close();
?>
<tr>
<td colspan="5" align="right" ><a href="index.php?st=c_topic"><strong>Create New Topic</strong> </a></td>
</tr>
</table>