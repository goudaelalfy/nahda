<?php
$last_msg_id=$_GET['last_msg_id'];
 $sql=mysql_query("SELECT * FROM send_result_income WHERE ref_id < '$last_msg_id'  LIMIT 5");
 $last_msg_id="";

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
