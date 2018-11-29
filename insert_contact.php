<?php 
    session_start();
    include('assets/config.php');
    $user_id = $_SESSION['user_id'];

	$cell_phone_number_err="";


	if (isset($_POST['submit'])) {
        $firstname = $_POST['fname'];
		$lastname = $_POST['lname'];
        $nickname = $_POST['nickname'];
        $profile_pic='';
		$profile= $_FILES['profile']['name'];
        $profile_tmp = $_FILES['profile']['tmp_name'];
        $cell_phone_number = $_POST["cphone"];
		$home_phone_number = $_POST['hphone'];
		$work_phone_number = $_POST['wphone'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zip_code = $_POST['zipcode'];
        $bio = $_POST['bio'];


        
        if(empty(trim($cell_phone_number)) ){
            $cell_phone_number_err = "Please enter a Cell Phone Number";
        } else{
            
            $cell_phone_number = mysqli_real_escape_string($conn,$cell_phone_number);

			$sql = "SELECT * FROM contacts WHERE Phone_Number='".$cell_phone_number."'";
			
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            
            $count = mysqli_num_rows($result);

            if($count == 1) {
                $cell_phone_number_err = "This cellphone number is already taken.";
            }else {
                
                $cell_phone_number = trim($_POST["cphone"]);
            }
            
		}
		
		

        // Moving Picture to new directory
		move_uploaded_file($profile_tmp, "img/$profile");
       
        if(empty($cell_phone_number_err)){
            $sql = "INSERT INTO contacts (First_Name,Last_Name,Nickname,Phone_Number,Work_Phone_Number,Home_Phone_Number,City,State,ZIpcode,Profile_Picture,Bio,User_ID) VALUES 
            ('$firstname','$lastname','$nickname','$cell_phone_number','$work_phone_number','$home_phone_number','$city','$state','$zip_code','$profile','$bio','$user_id')";

            if (mysqli_query($conn, $sql)) {
                header("location:insert_contact.php?contact_added=1");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

        }else{
			header("location: insert_contact.php?taken_cellnum=1");
		}
        
        mysqli_close($conn);

	}

 

?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Contact</title>
	<?php include('assets/head_info.php'); ?>
	<script>tinymce.init({selector:'textarea'});</script>
	<style>
		.profile img{
			padding: 5px;
			border-radius: 10px;
			border: 1px solid #337ab7;
			text-align:center;	
		}
	</style>
	<script>
		function profpic(){
			var prof = document.getElementById('profile');
			alert(prof.value);
		}
	
	</script>
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
				<h4 style="text-align:center; margin:20px;">Add New Contact</h4>
			</div>
		</div>
		
		<div class="row">
			
			<form action="insert_contact.php" method="post" enctype="multipart/form-data">
			<div style="text-align:center" class="col-sm-3 col-sm-offset-2">
			
				<div class="form-group">
					<div class="profile">
						<img src="img/logo.png"/><br>
						<label  for="profile">Profile Picture</label>
						<input  type="file" id="profile"  class="btn btn-primary btn-block" name="profile"/>
						
					</div>
					
				</div>
			</div>
			<div class="col-sm-5">
				<div class="form-group">
					<label for="first-name">First Name</label>
					<input type="text" class="form-control text-field" id="fname"  name="fname" placeholder="First Name" autofocus />
				</div>
				<div class="form-group">
					<label for="last-name">Last Name</label>
					<input type="text" class="form-control text-field"  name="lname" placeholder="Last Name" autofocus />
				</div>
				<div class="form-group">
					<label for="nickname">Nickname</label>
					<input type="text" class="form-control text-field"  name="nickname" placeholder="Nickname" autofocus />
				</div>
				<div class="form-group">
					<label for="cell-phone">Cell Phone</label>
					<input type="text" class="form-control text-field"  name="cphone"   placeholder="Cell Phone" autofocus />
				</div>
				<div class="form-group">
					<label for="home-phone">Home Phone</label>
					<input type="text" class="form-control text-field"  name="hphone" placeholder="Home Phone Number" autofocus />
				</div>
				<div class="form-group">
					<label for="work-phone">Work Phone</label>
					<input type="text" class="form-control text-field"  name="wphone" placeholder="Work Phone Number" autofocus />
				</div>
				<div class="form-group">
					<label for="city">City</label>
					<input type="text" class="form-control text-field"  name="city" placeholder="City" autofocus />
				</div>
				<div class="form-group">
					<label for="state">State</label>
					<input type="text" class="form-control text-field"  name="state" placeholder="State" autofocus />
				</div>
				<div class="form-group">
					<label for="zipcode">Zipcode</label>
					<input type="text" class="form-control text-field"  name="zipcode" placeholder="Zipcode" autofocus />
				</div>
				<div class="form-group">
					<label for="bio">Bio</label>
					<textarea class="form-control text-field" placeholder="About you . . ." id="bio"  name="bio" cols="30" rows="10"></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div style="margin-top:10px" class="form-group">
					<button type="submit" name="submit" class="btn btn-primary btn-block" ><span class="glyphicon glyphicon-save"></span> Insert Contact  </button>
					
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
<div class="modal" id="add_err" role="dialog">
	<div class="modal-dialog">

	<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" id=close" onclick="$('#add_err').fadeOut();$('#fname').focus()">&times;</button>
				<h4 class="modal-title"><strong>Warning!!!</strong></h4>
			</div>
			<div class="modal-body">
				<p><span class="glyphicon glyphicon-alert alert-info"></span>&nbsp;&nbsp;Cell number is empty or it is already taken</p>
			</div>
			<div class="modal-footer">
				<button type="button" onclick="$('#add_err').fadeOut();$('#fname').focus()"class="btn btn-primary" ><span class="glyphicon glyphicon-ok"></span> Ok</button>
				<button type="button" onclick="$('#add_err').fadeOut();$('#fname').focus()"class="btn btn-danger" ><span class="glyphicon glyphicon-remove"></span> Cancel</button>
			</div>
		</div>
	</div>
</div>
<div class="modal" id="add_success" role="dialog">
	<div class="modal-dialog">

	<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" id=close" onclick="$('#add_success').fadeOut();$('#fname').focus()">&times;</button>
				<h4 class="modal-title"><strong>Congrats!!!</strong></h4>
			</div>
			<div class="modal-body">
				<p><span class="glyphicon glyphicon-info-sign alert-info"></span>&nbsp;&nbsp;New Contact Successfully Added</p>
			</div>
			<div class="modal-footer">
				<button type="button" onclick="$('#add_success').fadeOut();$('#fname').focus()"class="btn btn-primary" ><span class="glyphicon glyphicon-ok"></span> Ok</button>
				<button type="button" onclick="$('#add_success').fadeOut();$('#fname').focus()"class="btn btn-danger" ><span class="glyphicon glyphicon-remove"></span> Cancel</button>
			</div>
		</div>
	</div>
</div>

<?php
	if(isset($_GET['taken_cellnum']) == 1 ){ ?>
	<script type='text/javascript'>
		 

		var modal = document.getElementById('add_err');
		$('#add_err').fadeIn();

		
		window.onclick = function(event) {
			if (event.target == modal) {
				$('#add_err').fadeOut();
			}
		}
	</script>	
<?php	
	}
	if(isset($_GET['contact_added']) == 1 ){ ?>
	<script type='text/javascript'>
		var modal = document.getElementById('add_success');
		$('#add_success').fadeIn();

		
		window.onclick = function(event) {
			if (event.target == modal) {
				$('#add_success').fadeOut();
			}
		}
	</script>		 
<?php	
	}
?>
</body>
</html>		
