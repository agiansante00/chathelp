<?php
	ob_start();
	include('db.php');
?>


<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="style.css" media="all">
		
		
		
		<script>
		function ajax(){
			var req = new XMLHttpRequest();
			req.onreadystatechange = function(){
				if(req.readyState == 4 && req.status == 200){
					try{
					document.getElementById('chat').innerHTML = req.responseText;	
					}catch(err){
						console.log("no data entered");
					}
					
				}
			}
			var ref_id = "<?php echo $_GET['help'];?>";
			req.open('GET','chat.php?ref_id=' + ref_id,true);
			req.send();
		}
		setInterval(function(){ajax()},1000);		
		</script>
		
		
		
		
		
		<title>ADMIN HELP</title>			
	</head>
<body>		

<?php	if (!isset($_GET['help'])){?>


	
		<form method='post'>
		<p>ENTER NAME: <input type="text" name="name" value=""/></p>
		<p>ENTER ISSUE: <input type="text" name="issue" value=""/></p>
		<input type='submit' name='button' value='enter'/>
		</form>
		
			<?php
			if (isset($_POST['name'])){
				$name = $_POST['name'];
				$issue = $_POST['issue'];
				$ref_id = hash('crc32', $name);
				$url = 'slug.php?help=' . $ref_id;
				$query = "INSERT INTO `ADMIN_HELP`(`ref_id`, `name`, `issue`) VALUES ('{$ref_id}','{$name}','{$issue}')";
				$run = $connection->query($query);
				header("Location: ". $url);
				
				
				$msg = "NAME: " . $name . " ISSUE: " . $issue ." ". now() . "Help User: " . $url;
				$msg = wordwrap($msg,70);
				mail("agiansante@gmail.com","ATTN: Someone is messaging you",$msg);
			}
		}?>
		
		
<!--
		<?php
		if (isset($_GET['help'])){ 
			$ref_id =  $_GET['help'];
			
			$query = "SELECT `name` FROM `ADMIN_HELP` WHERE ref_id = '{$ref_id}' ";
			$run = $connection->query($query);
			
			while ($row = $run->fetch_array()){
				$name = $row['name'];
				}
				
			if (isset($_GET['admin_id'])){ 
				$name =  $_GET['admin_id'];
			}
			
		?>
-->
			
		<div onload ="ajax();" id="container">
			<div id="chat_box">
				
				<div id="chat">
				</div>
			</div>
			
			<div id="inputbox">				
					<textarea name="message" id="message" placeholder="enter message"></textarea>
					<input type="button" name="enter" value="Press" onclick = "postData()"/>
								
<script>
	function postData(){
		var message = document.getElementById('message').value;
		var refid = "<?php echo $_GET['help'];?>";	
		
		var chatname = "<?php
			if (!isset($_GET['admin_id'])){
				$ref_id =  $_GET['help'];
				$query = "SELECT `name` FROM `ADMIN_HELP` WHERE ref_id = '{$ref_id}' ";
				$run = $connection->query($query);
				while ($row = $run->fetch_array()){
					$name = $row['name'];
					echo $name;
					}	
			}else{
				$name = $_GET['admin_id'];
				echo $name;
			}?>"
			
		console.log(chatname);
		
		document.getElementById("message").value = "";
		
		send_data = new XMLHttpRequest();
		 var PageToSendTo = "ajaxpost.php?";
		 var  varsurl = "message="+message+"&refid="+refid+"&chatname="+chatname;
		 
		 var UrlToSend = PageToSendTo + varsurl;
		 
		 send_data.open("GET", UrlToSend, false);
		 send_data.send();
		}
</script>	
			</div>				
	</div>		
<?php
	}
	?>
	</body>	
</html>


