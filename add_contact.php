<?php 
	
	include('config.php');
	session_start();

	$user_id = $_SESSION['user_id'];
	// Define variables and initialize with empty values
	$firstname = $lastname=  $nickname=$profile_pic=$cell_phone_number="";
	$home_phone_number=$work_phone_number=$city=$zip_code=$state=$bio='';
	$firstname_err= $lastname_err= $nickname_err= $profile_pic_err=$cell_phone_number_err='';
	$home_phone_number_err=$work_phone_number_err=$city_err=$zip_code_err=$state_err=$bio_err='';


	if(isset($_POST['submit']) && $_SERVER["REQUEST_METHOD"] == 'POST'){

		if(isset($_POST['firstname'])){
			$firstname = mysqli_real_escape_string($conn ,$_POST['firstname']); 
		}

		if(isset($_POST['lastname'])){
			$lastname = mysqli_real_escape_string($conn ,$_POST['lastname']); 
		}
		
		if(isset($_POST['nickname'])){
			$lastnamnicknamee = mysqli_real_escape_string($conn ,$_POST['nickname']); 
		}
		
		
		if(isset($_FILES['profile_pic'])){
			
			$profile_pic = addslashes(file_get_contents($_FILES["profile_pic"]["tmp_name"]));  
      
			//$profile_pic = $_FILES['profile_pic']['name'];
			//$profile_pic_tmp = $_FILES['profile_pic']['tmp_name'];
			
			//move_uploaded_file($profile_pic_tmp, "img/$profile_pic");
			/*
			$profile_pic = $_FILESp['profile_pic']['tmp_name'];
			$profile_pic = getimagesize($profile_pic);
			
			if(getimagesize($_FILES['profile_pic']['tmp_name'])==FALSE){
				echo " error ";
			}else{
				$profile_pic = $_FILES['image']['tmp_name'];
				$profile = addslashes(file_get_contents($profile));
				saveimage($image);

			}*/
		}
		
		
		if(empty(trim($_POST["cell_phone_number"]))&&isset($_POST['cell_phone_number'])){
            $cell_phone_number_err= "Please enter a Cell Phone Number";
        } else{
            
            $cell_phone_number = mysqli_real_escape_string($conn,$_POST['cell_phone_number']);

			$sql = "SELECT * FROM contacts WHERE Phone_Number='".$cell_phone_number."'";
			
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            
            $count = mysqli_num_rows($result);

            if($count == 1) {
                $cell_phone_number_err = "This cellphone number is already taken.";
            }else {
                
                $cell_phone_number = trim($_POST["cell_phone_number"]);
            }
            
        }

		
		if(isset($_POST['home_phone_number'])){
			$home_phone_number = mysqli_real_escape_string($conn ,$_POST['home_phone_number']); 
		}

		if(isset($_POST['work_phone_number'])){
			$work_phone_number = mysqli_real_escape_string($conn ,$_POST['work_phone_number']); 
		}
		
		if(isset($_POST['city'])){
			$city = mysqli_real_escape_string($conn ,$_POST['city']); 
		}

		if(isset($_POST['state'])){
			$state = mysqli_real_escape_string($conn ,$_POST['state']); 
		}
		
		if(isset($_POST['zip_code'])){
			$zip_code = mysqli_real_escape_string($conn ,$_POST['zip_code']); 
		}
		
		if(isset($_POST['bio'])){
			$bio = mysqli_real_escape_string($conn ,$_POST['bio']); 
		}



		if(empty($cell_phone_number_err)){
            

			//you can save contact with cellphone number only


            $sql = "INSERT INTO contacts (First_Name,Last_Name,Nickname,Phone_Number,Work_Phone_Number,Home_Phone_Number,City,State,ZIpcode,Profile_Picture,Bio,User_ID) VALUES 
			('$firstname','$lastname','$nickname','$cell_phone_number','$work_phone_number','$home_phone_number','$city','$state','$zip_code','$profile_pic','$bio','$user_id')";

            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

        
            
            
        }else{

           ;
        }

	}else{
		echo 'Yehh';
	}








 ?>
<!DOCTYPE html>
<html>
<head>
	 
    <script>tinymce.init({selector:'textarea'});</script>
    
</head>
<body>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<div class="form-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
			<label>First Name</label>
			<input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
			<span class="help-block"><?php echo $firstname_err; ?></span>
		</div>    
		<div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
			<label>Last Name</label>
			<input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
			<span class="help-block"><?php echo $lastname_err; ?></span>
		</div>    
		<div class="form-group <?php echo (!empty($nickname_err)) ? 'has-error' : ''; ?>">
			<label>Nickname</label>
			<input type="text" name="nickname" class="form-control" value="<?php echo $nickname; ?>">
			<span class="help-block"><?php echo $nickname_err; ?></span>
		</div>  
		<div class="form-group <?php echo (!empty($profile_pic_err)) ? 'has-error' : ''; ?>">
			<label>Profile</label>
			<input type="file" name="profile_pic" id="profile_pic" class="form-control" value="<?php echo $profile_pic; ?>">
			<span class="help-block"><?php echo $profile_pic_err; ?></span>
		</div>  
		<div class="form-group <?php echo (!empty($cell_phone_number_err)) ? 'has-error' : ''; ?>">
			<label>Contact Number</label>
			<input type="text" name="cell_phone_number" class="form-control" value="<?php echo $cell_phone_number; ?>">
			<span class="help-block"><?php echo $cell_phone_number_err; ?></span>
		</div> 
		<div class="form-group <?php echo (!empty($home_phone_number_err)) ? 'has-error' : ''; ?>">
			<label>Home Phone Number</label>
			<input type="text" name="home_phone_number" class="form-control" value="<?php echo $home_phone_number; ?>">
			<span class="help-block"><?php echo $home_phone_number_err; ?></span>
		</div> 
		<div class="form-group <?php echo (!empty($work_phone_number_err)) ? 'has-error' : ''; ?>">
			<label>Work Phone Number</label>
			<input type="text" name="work_phone_number" class="form-control" value="<?php echo $work_phone_number; ?>">
			<span class="help-block"><?php echo $work_phone_number_err; ?></span>
		</div> 
		<div class="form-group <?php echo (!empty($city_err)) ? 'has-error' : ''; ?>">
			<label>City</label>
			<input type="text" name="city" class="form-control" value="<?php echo $city; ?>">
			<span class="help-block"><?php echo $city_err; ?></span>
		</div> 
		<div class="form-group <?php echo (!empty($state_err)) ? 'has-error' : ''; ?>">
			<label>State</label>
			<input type="text" name="state" class="form-control" value="<?php echo $state; ?>">
			<span class="help-block"><?php echo $state_err; ?></span>
		</div> 
		<div class="form-group <?php echo (!empty($zip_code_err)) ? 'has-error' : ''; ?>">
			<label>Zip Code</label>
			<input type="text" name="zip_code" class="form-control" value="<?php echo $zip_code; ?>">
			<span class="help-block"><?php echo $zip_code_err; ?></span>
		</div> 
		<div class="form-group <?php echo (!empty($bio_err)) ? 'has-error' : ''; ?>">
			<label>Bio</label>
			<textarea  name="bio" id="bio" cols="30"  rows="10" class="form-control" value="<?php echo $bio; ?>"></textarea>
			<span class="help-block"><?php echo $bio_err; ?></span>
		</div> 
		
		<div class="form-group">
			<input type="submit" name="submit" value="Insert Contact">
			<a href="index.php"><input class="cancel_contact_button" type="button" value="Cancel"></a>
					
		</div>
		 
	</form>


		<!-- content section -->
		<div class="content">
		<div><h1>Create New Contact</h1></div>
			<hr>
			<div class="contact">
				<div class="contact_insert">
					<form action="add_contact.php" method="post" enctype="multipart/form-data">
						<table style="float:left" width="50%">
							<tr>
								<td>First Name:</td>
								<td><input type="text" name="fname" placeholder="First Name"  size="40%"></td>
							</tr>
							<tr>
								<td>Last Name:</td>
								<td><input type="text" name="lname" placeholder="Last Name" size="40%"></td>
							</tr>
							<tr>
								<td>Nickname:</td>
								<td><input type="text" name="nickname" placeholder="Nickname" size="40%"></td>
							</tr>
							<tr>
								<td>Profile Image:</td>
								<td><input type="file" name="profile"></td>
							</tr>
							<tr>
								<td>Cell Phone:</td>
								<td><input type="text" name="cphone" placeholder="Cell Phone" size="40%"></td>
							</tr>
							<tr>
								<td>Home Phone:</td>
								<td><input type="text" name="hphone" placeholder="Home Phone" size="40%"></td>
							</tr>
							<tr>
								<td>Work Phone:</td>
								<td><input type="text" name="wphone" placeholder="Work Phone" size="40%"></td>
							</tr>
							<tr>
								<td>Address:</td>
								<td><input type="text" name="address" placeholder="Address" size="40%"></td>
							</tr>
							<tr>
								<td>City:</td>
								<td><input type="text" name="city" placeholder="City" size="40%"></td>
							</tr>
							<tr>
								<td>State:</td>
								<td><input type="text" name="state" placeholder="State" size="40%"></td>
							</tr>
							<tr>
								<td>Zipcode:</td>
								<td><input type="text" name="zipcode" placeholder="Zipcode" size="40%"></td>
							</tr>
						</table>
						<table style="float:right" width="45%">
							<tr>
								<td>Bio:</td>
								<td><textarea name="bio" id="bio" cols="30" rows="10"></textarea></td>
							</tr>
						</table>
						<div class="clear"></div>
						<input type="submit" name="submit" id="submit" value="Insert Contact">
						<a href="index.php"><input class="cancel_contact_button" type="button" value="Cancel"></a>
					</form>
				</div>
				<div class="clear"></div>
			</div>
		</div>	
</body>
</html>	


 <script>  
 $(document).ready(function(){  
      $('#submit').click(function(){  
           var profile_pic = $('#profile_pic').val();  
           if(profile_pic == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#profile_pic').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#profile_pic').val('');  
                     return false;  
                }  
           }  
      });  
 });  
 </script>  