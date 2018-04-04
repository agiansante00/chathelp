<?php
ob_start();
include("db.php");


$query = "SELECT * FROM `ADMIN_HELP` ORDER BY `id` DESC";
$run = $connection->query($query);
?>

<table style="width:100%">
  <tr>
    <th>Date</th>
    <th>Name</th> 
    <th>Issue</th>
    <th>URL</th>
	<th>Completed</th>
  </tr>


<?php
	
while ($row = $run->fetch_array()){
		$name = $row['name'];
		$id = $row['id'];
		
		$time = $row['time'];
		
		$issue = $row['issue'];
		$ref_id = $row['ref_id'];
		$url = 'slug.php?help=' . $ref_id . "&admin_id=admin";
		$delete = 'admin.php?id=' . $id;
		
		?>
		<tr>
			<td><?php echo $time; ?></td>
			<td><?php echo $name; ?></td>
			<td><?php echo $issue;?></td>
			<td><a href="<?php echo $url;?>">Answer User</a></td>
			<td><a href="<?php echo $delete;?>">Delete</a></td>
		</tr>
				
		
		
		
		<?php
				}
				
				if (isset($_GET['id'])){
					$id = $_GET['id'];
				
					
					$query = "SELECT * FROM `ADMIN_HELP` WHERE id = {$id}";
					$run = $connection->query($query);
					
					while ($row = $run->fetch_array()){
						$ref_if = $row['ref_id'];
						}
			
					$query = "DELETE FROM `ADMIN_HELP` WHERE `id` = {$id}";
					$run = $connection->query($query);
					
					$query = "DELETE FROM `ADMIN_CHAT` WHERE `ref_id` = '{$ref_id}' ";
					$run = $connection->query($query);
					header('Location: admin.php');				
					}
?>
</table>



