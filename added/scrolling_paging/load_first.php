<?php
$sql=mysql_query("SELECT * FROM send_result_income LIMIT 20");
while($row=mysql_fetch_array($sql))
		{
		$msgID= $row['rep_text'];
		$msg= $row['orn'];

?>
<div id="<?php echo $msgID; ?>"  align="left" class="message_box" >
<span class="number"><?php echo $msgID; ?></span><?php echo $msg; ?> 
</div>

<?php
}
?>
