<?php if(!isset($_SESSION['userid'])) {
    header('location:index.php?st=noforum');
    die();
}
$user = userInfo($_SESSION['userid']);
?>
<p/>
<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" >
<tr>
<form id="form1" name="form1" method="post" action="index.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" >

<tr>
<td width="14%"><strong>Topic</strong></td>
<td width="2%">:</td>
<td width="84%"><input name="topic" type="text" id="topic" size="50" /></td>
</tr>
<tr>
<td valign="top"><strong>Detail</strong></td>
<td valign="top">:</td>
<td><textarea name="detail" cols="50" rows="3" id="detail"></textarea></td>
</tr>
<tr>
<td><strong>Name</strong></td>
<td>:</td>
<td><?php echo $user['username'];?></td>
</tr>
<!--
<tr>
<td><strong>Email</strong></td>
<td>:</td>
<td><input name="email" type="text" id="email" size="50" /></td>
</tr>
-->
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Submit" /> <input type="reset" name="Submit2" value="Reset" />
<input type="hidden" name="st" value="a_topic"/>
<input type="hidden" name="name" id="name" value="<?php echo $user['username'];?>"/>
</td>
</tr>
</table>
</td>
</form>
</tr>
</table>
