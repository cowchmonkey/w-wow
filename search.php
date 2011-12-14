<form action="index.php" method="get">
<table class="search">
	<tr>
		<td>
			<img src="FAST_theme/search.jpg"/>
		</td>
	</tr><tr>
		<td><input type="text" name="sr" class="search"/></td>
	</tr><tr>
		<td>
			<div class="drop_search">
				<select name="pt">
					<option value="its"><?php echo $lang[LANG]['items'];?></option>
					<option value="qts"><?php echo $lang[LANG]['quest'];?></option>
					<option value="mbs"><?php echo $lang[LANG]['mobs'];?></option>
					<option value="sps"><?php echo $lang[LANG]['spells'];?></option>
				</select>
			</div>
		</td>
	</tr>
</table>
</form>