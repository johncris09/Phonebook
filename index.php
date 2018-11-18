<?php
   include('session.php');
   include('config.php');
   

	$contacts = array();

	$all_contacts = "select * from contacts where contact_status = '1'";

	$sql_all_contacts = $conn->query($all_contacts);

	$total_contacts = $sql_all_contacts->num_rows;

	while ($row = mysqli_fetch_assoc($sql_all_contacts)) {
		$contacts[] = $row;
	}
 
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
			<div class="floatl"><h1><?php echo $total_contacts ?> Contact(s) Total</h1></div>
			<a class="floatr" href="insert_contact.php"><input class="cancel_contact_button" type="button" value="New Contact"></a>		
			<div class="clear"></div>
				<hr class="pageTitle">
				<table id="contactsTable" class="display">
					<thead>
						<tr align="left">
							<th>Name:</th>
							<th>Nickname:</th>
							<th>Cell Phone:</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
					 	<?php foreach ($contacts as $contact) {?>
						<tr>
							<td><a href="contact.php?id=<?php echo $contact["contact_id"]; ?>"><?php echo $contact["contact_fname"] . " " . $contact["contact_lname"]; ?></a></td>
							<td><?php echo $contact["contact_nickname"]; ?></td>
							<td><?php echo $contact["contact_cphone"]; ?></td>
							<td><a href="update_contact.php?id=<?php echo $contact["contact_id"]; ?>"><i class="fa fa-pencil"></i></a> | <a href="delete_contact.php?id=<?php echo $contact["contact_id"] ?>"><i class="fa fa-trash-o"></i></a></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
		</div>
	</div>	
</body>
</html>		