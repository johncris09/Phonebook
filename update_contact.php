<?php 
	session_start();
	include("assets/config.php");

	if (isset($_GET['id'])) {
		
		$id = $_GET['id'];

		$get_contact = "select * from contacts where contact_id = '$id'";

		$get_contact = mysqli_query($conn, "select * from contacts where contact_id = '$id'");

		$row = mysqli_fetch_array($get_contact);
	}
 ?>
 <?php 
	$cell_phone_number_err='';
	$profile_tmp='';
	if (isset($_POST['submit'])) {

		$id = $_POST['id'];
		
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$nickname = $_POST['nickname'];
		$profile = $_FILES['profile']['name'];
		if ($profile != "") {
			$profile_tmp = $_FILES['profile']['tmp_name'];
		}else{
			$profile = $row['Profile_Picture'];
		}
		$phone_number = $_POST['cell_phone_number'];
		$home_phone_number = $_POST['home_phone_number'];
		$work_phone_number = $_POST['work_phone_number'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zipcode = $_POST['zipcode'];
		$bio = $_POST['bio'];
		
		move_uploaded_file($profile_tmp, "img/$profile");
		$update_contact = "update contacts set FIrst_Name='$firstname', Last_Name='$lastname', Nickname='$nickname', Phone_Number='$phone_number', Home_Phone_Number='$home_phone_number', Work_Phone_Number='$work_phone_number', City='$city', State='$state', ZIpcode='$zipcode', Profile_Picture='$profile', 	Bio='$bio' where Contact_ID = '$id'";
	
		if (mysqli_query($conn, $update_contact)) {
			header("location: update_contact.php?id=$_GET[id]&contact_updated=1");
			
		} else {
			header("location: update_contact.php?id=$_GET[id]&duplicate_entry=1");
		}
		
		
		mysqli_close($conn);
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
	<script>tinymce.init({selector:'textarea'});</script>
	<?php include('assets/head_info.php'); ?>
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
					<h4 style="text-align:center; margin:20px;">Update Contact</h4>
				</div>
			</div>
			<div style="padding:10px;" class="row">
				<form action="update_contact.php?id=<?php echo $_GET['id'] ?>" method="post" enctype="multipart/form-data">
				<div style="text-align:center" class="col-sm-3 col-sm-offset-2">
					<div class="form-group">
						<div class="profile">
							<?php if( $row["Profile_Picture"] == "" ){?>
								<img src="img/logo.png"/><br>
							<?php }else{ ?>
								<img class="img img-thumbnail" src=<?php echo '"img/'.$row['Profile_Picture'].'"' ?> alt='Profile Pic' style="width:95%;height:230px;">
								
							<?php } ?>


							
							<label  for="profile">Profile Picture</label>
							<input  type="file" class="btn btn-block btn-primary" name="profile"/>
							
						</div>
					</div>
				</div>
				<div class="col-sm-5">
					<!-- Use as User id when updating contact -->
					<input type="hidden" name="id" value="<?php echo $row["Contact_ID"]; ?>">

					<div class="form-group">
						<label for="first-name">First Name</label>
						<input type="text" id="firstname" class="form-control text-field"  name="firstname" value="<?php echo $row['First_Name']?>" placeholder="First Name" autofocus />
					</div>
					<div class="form-group">
						<label for="last-name">Last Name</label>
						<input type="text" class="form-control text-field"  name="lastname" value="<?php echo $row['Last_Name']?>" placeholder="Last Name" />
					</div>
					<div class="form-group">
						<label for="nickname">Nickname</label>
						<input type="text" class="form-control text-field"  name="nickname" value="<?php echo $row['Nickname']?>" placeholder="Nickname" />
					</div>
					<div class="form-group">
						<label for="cell-phone">Cell Phone</label>
						<input type="text" class="form-control text-field"  name="cell_phone_number" value="<?php echo $row['Phone_Number']?>" placeholder="Cell Phone" />
					</div>
					<div class="form-group">
						<label for="home-phone">Home Phone</label>
						<input type="text" class="form-control text-field"  name="home_phone_number" value="<?php echo $row['Home_Phone_Number']?>" placeholder="Home Phone Number" />
					</div>
					<div class="form-group">
						<label for="word-phone">Work Phone</label>
						<input type="text" class="form-control text-field"  name="work_phone_number" value="<?php echo $row['Work_Phone_Number']?>" placeholder="Work Phone Number" />
					</div>
					<div class="form-group">
						<label for="city">City</label>
						<input type="text" class="form-control text-field"  name="city" value="<?php echo $row['City']?>" placeholder="City" />
					</div>
					<div class="form-group">
						<label for="state">State</label>
						<input type="text" class="form-control text-field"  name="state" value="<?php echo $row['State']?>" placeholder="State" />
					</div>
					<div class="form-group">
						<label for="zipcode">Zipcode</label>
						<input type="text" class="form-control text-field"  name="zipcode" value="<?php echo $row['ZIpcode']?>" placeholder="Zipcode" />
					</div>
					<div class="form-group">
						<label for="bio">Bio</label>
						<textarea class="form-control text-field" id="bio"  name="bio" cols="30" rows="10"><?php echo $row['Bio']?></textarea>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<div style="margin-top:10px" class="form-group">
						<button type="submit" name="submit" class="btn btn-primary btn-block" ><span class="glyphicon glyphicon-edit"></span> Update Contact  </button>
					</div>
				</div>
			</div>
			</form>
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">

					<!-- Footer -->
					<?php include('assets/footer.php'); ?>

				</div>
			</div>
		</div>
	</div>
	<div class="modal" id="update_success" role="dialog">
		<div class="modal-dialog">

		<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" id=close" onclick="$('#update_success').fadeOut();$('#firstname').focus()">&times;</button>
					<h4 class="modal-title"><strong>Congrats!!!</strong></h4>
				</div>
				<div class="modal-body">
					<p><span class="glyphicon glyphicon-info-sign alert-info"></span>&nbsp;&nbsp;New Contact Successfully Updated</p>
				</div>
				<div class="modal-footer">
					<button type="button" onclick="$('#update_success').fadeOut();$('#firstname').focus()"class="btn btn-primary" ><span class="glyphicon glyphicon-ok"></span> Ok</button>
					<button type="button" onclick="$('#update_success').fadeOut();$('#firstname').focus()"class="btn btn-danger" ><span class="glyphicon glyphicon-remove"></span> Cancel</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" id="duplicate_entry" role="dialog">
		<div class="modal-dialog">

		<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" id=close" onclick="$('#duplicate_entry').fadeOut();$('#firstname').focus()">&times;</button>
					<h4 class="modal-title"><strong>Warning!!!</strong></h4>
				</div>
				<div class="modal-body">
					<p><span class="glyphicon glyphicon-alert alert-info"></span>&nbsp;&nbsp;Duplicate Enrty for Cell Phone Number</p>
				</div>
				<div class="modal-footer">
					<button type="button" onclick="$('#duplicate_entry').fadeOut();$('#firstname').focus()" class="btn btn-primary" ><span class="glyphicon glyphicon-ok"></span> Ok</button>
					<button type="button" onclick="$('#duplicate_entry').fadeOut();$('#firstname').focus();" class="btn btn-danger" ><span class="glyphicon glyphicon-remove"></span> Cancel</button>
				</div>
			</div>
		</div>
	</div>
	<?php
	if(isset($_GET['contact_updated']) == 1 ){ ?>
		<script type='text/javascript'>
			$('#update_success').fadeIn();
			
			window.onclick = function(event) {
				if (event.target == modal) {
					$('#add_err').fadeOut();
				}
			}
		</script>	
	<?php }
	if(isset($_GET['duplicate_entry']) == 1 ){ ?>
		<script type='text/javascript'>
			$('#duplicate_entry').fadeIn();
			
			window.onclick = function(event) {
				if (event.target == modal) {
					$('#duplicate_entry').fadeOut();
				}
			}
		</script>	
	<?php } ?>
</body>
</html>		