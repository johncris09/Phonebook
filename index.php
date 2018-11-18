<?php
   include('session.php');
   
   $user_id = $_SESSION['user_id'];
   
   $result = mysqli_query($conn, "Select Contact_ID, CONCAT(First_Name,' ', Last_Name) as Name, Nickname, Phone_Number from contacts where User_ID ='$user_id'");
   
 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Phonebook</title>
</head>
<body>
	<div class="wrapper">


		<!-- content section -->
		<div class="content">
			
			<a class="floatr" href="insert_contact.php"><input class="cancel_contact_button" type="button" value="New Contact"></a>		
			<table style="width:100%;text-align:left; border: 1px solid black">
				<thead>
					<tr>
						<th>Name</th>
						<th>Nickname</th>
						<th>Phone Number</th>
						<th>Operation</th>
						
					</tr>
				</thead>
				<tbody>
					<?php while ($row = mysqli_fetch_array($result)) { ?>
					<tr>
						<td><?php echo $row['Name'] ?></td>
						<td><?php echo $row['Nickname'] ?></td>
						<td><?php echo $row['Phone_Number'] ?></td>
						<td>
							<a href="view_contact.php?id=<?php echo $row["Contact_ID"]; ?>">View</a> |
							<a href="update_contact.php?id=<?php echo $row["Contact_ID"]; ?>">Update</a> | 
							<a href="delete_contact.php?id=<?php echo $row["Contact_ID"] ?>">Delete</i></a>
						</td>

					</tr>
					<?php } ?>



				</tbody>

			</table>
			
			
		</div>
	</div>	
</body>
</html>		