<?php
 	include('assets/session.php');

	$user_id = $_SESSION['user_id'];
	
   	if(isset($_POST['submit'])){
		$contact_fields = $_POST['contact_fields']; 
		$search_value	= $_POST['search_value'];
		header("location: ?fields_name=$contact_fields&value=$search_value");
	}
	
	

	$search_value = '';
	$fields_name  = '';

	//Fields Name
	if(isset($_GET['fields_name'])==1){
		if($_GET['fields_name'] === "Name"){
			$fields_name = 'CONCAT(First_Name," ", Last_Name)';
		}else{
			$fields_name = $_GET['fields_name'];
		}
	}

	//Value
	if(isset($_GET['value'])==1){
		$search_value = $_GET['value'];
	}

	if( !(empty($search_value)) || !(empty($fields_name))  ){
		$q= "Select Contact_ID, CONCAT(First_Name,' ', Last_Name) as Name, Nickname, Phone_Number from contacts where $fields_name LIKE '%$search_value%' AND User_ID ='$user_id'";
	
	}else{
		$q= "Select Contact_ID, CONCAT(First_Name,' ', Last_Name) as Name, Nickname, Phone_Number from contacts where User_ID ='$user_id'";
	}

   	
	
	$result = mysqli_query($conn, $q);
	

	

	// Total Contacts
	$total_contacts = mysqli_num_rows($result);
	


 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Homepage</title>
	<?php include('assets/head_info.php'); ?>
	<style>
		td a{
			font-size: 18px;
		}
	</style>
</head>
<body>
	<div class="wrapper">

<!-- content section -->
		</div class="container">	
				
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<?php include('assets/header.php'); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<h4 style="text-align:center; margin:20px;">List of Contact(<?php echo $total_contacts; ?>)</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2" >
					<form  role="form" actio="" method="post" style="margin-bottom:20px;" class="navbar-form">
						
						<table>
							<tr>
								<td>
								<?php
									$sql = "Select CONCAT(First_Name,' ', Last_Name) as Name, Nickname, Phone_Number from contacts";
									if( $fields = mysqli_query($conn,$sql) ){
										//Get fields information for all fields
										echo "<select name='contact_fields' class='form-control' required>";
										echo "<option value=''>Search by</option>";
										while( $fieldinfo = mysqli_fetch_field($fields) ){
											echo '<option value="'.$fieldinfo->name.'">'.$fieldinfo->name.'</option>';
										}
										echo "</select>";
										//Free result set
										mysqli_free_result($fields);
									}
								?>	


								</td>
								<td><input type="text" oninput="searchq()" name="search_value" value="<?php echo $search_value;  ?>" class="form-control" title="Search" autofocus required> </td>
								<td><button style="float:right" id="submit" type="submit" name="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button></td>
							</tr>


						</table>
						
					</form>
					
				<div class="container-fluid">
					
					<table class="table  table-condensed table-hover table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Nickname</th>
								<th>Phone Number</th>
								<th>Operation</th>
							</tr>
						</thead>
						<tbody>
							<?php $count=1;while ($row = mysqli_fetch_array($result)) { ?>
							<tr>
								<td><?php echo $count++; ?></td>
								<td><?php echo $row['Name'] ?></td>
								<td><?php echo $row['Nickname'] ?></td>
								<td><?php echo $row['Phone_Number'] ?></td>
								<td>
									<a href="index.php?view_contact_id=<?php echo $row["Contact_ID"]; ?>"><span class="glyphicon glyphicon-eye-open" title="View Profile"></span></a> |
									<a href="update_contact.php?id=<?php echo $row["Contact_ID"]; ?>"><span class="glyphicon glyphicon-pencil" title="Update"></span> </a> | 
									<a href="index.php?delete_contact_id=<?php echo $row["Contact_ID"] ?>"><span class="glyphicon glyphicon-trash" title="Delete"></span></i></a>
								</td>

							</tr>
							<?php } ?>
						</tbody>
					</table>
					
					<?php 
						if($total_contacts<1 && !(empty($search_value))){
							if( $fields_name=='CONCAT(First_Name," ", Last_Name)' ){
								$fields_name = "Name";
							}
					?>

						<h3 style="text-align:center;margin-top:30px;"><?php echo $fields_name .' "'.$search_value.'"';  ?> Not Found!!!</h3>
					<?php } ?>
					

					
					</div>
				</div>

			</div>
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">

					<!-- Footer -->
					<?php include('assets/footer.php'); ?>

				</div>
			</div>
			
			<!-- View Contact -->
			<?php
			if(isset($_GET['view_contact_id']) == 1 ){ ?>
				<?php include('view_contact.php'); ?>
				<script type='text/javascript'>
					$('#view_contact').fadeIn();
					
					window.onclick = function(event) {
						if (event.target == modal) {
							$('#view_contact').fadeOut();
						}
					}
				</script>	
			<?php } ?>


			<!-- Dekete Contact -->
			<?php
			if(isset($_GET['delete_contact_id']) == 1 ){ ?>
				<?php include('delete_contact.php'); ?>
				<script type='text/javascript'>
					$('#delete_contact_id').fadeIn();
					
					window.onclick = function(event) {
						if (event.target == modal) {
							$('#delete_contact_id').fadeOut();
						}
					}
				</script>	
			<?php } ?>
	</div>	

</div>
</body>
</html>		