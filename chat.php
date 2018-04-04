<?php
ob_start();
include("db.php"); 
?>
	
<?php
		$ref_id = $_GET['ref_id'];
	
		$query = "SELECT * FROM `ADMIN_CHAT` WHERE ref_id = '{$ref_id}' ORDER BY `id` DESC";
		
		$run = $connection->query($query);


		while ($row = $run->fetch_array()){
			
			$message = $row['message'];
			$time = $row['time'];
			$name = $row['name'];
			
		?>
		


			<div id="chat_data">
				<span style="color:black;"><?php echo $name ?>:</span>
				<p>
				<span style="color:blue; font-size:smaller;"><?php echo $message ?></span>
				</p><p>
				<span style="float:left; font-size: x-small"><?php echo $time ?></span>
				</p><br>
			</div>

<?php }
?>


					
			