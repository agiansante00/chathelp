<?php
	include('db.php');
		
			$message = $_GET['message'];
			$ref_id = $_GET['refid'];
			$name = $_GET['chatname'];
			
			$message = mysql_real_escape_string($message);
			$query = "INSERT INTO `ADMIN_CHAT`(`ref_id`, `name`, `message`) VALUES ('{$ref_id}','{$name}','{$message}')";
// 			$query = "INSERT INTO `ADMIN_CHAT`(`message`,`ref_id`) VALUES ('{$message}','{$ref_id}')";
			$run = $connection->query($query);
			
			
			
			?>
