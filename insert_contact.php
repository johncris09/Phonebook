<?php 
    session_start();
    include('config.php');
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
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

        }
        
        mysqli_close($conn);

	}

 

?>
<!DOCTYPE html>
<html>
<head>
	<script>tinymce.init({selector:'textarea'});</script>
</head>
<body>
	<div class="wrapper">

		

		<!-- content section -->
		<div class="content">
		Create new Contact
			<hr>
			<div class="contact">
				<div class="contact_insert">
					<form action="insert_contact.php" method="post" enctype="multipart/form-data">
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
                                <td><input type="text" name="cphone" placeholder="Cell Phone" size="40%">
                                <span><?php echo $cell_phone_number_err; ?></span>
                                </td>
                            
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
                            <tr>
								<td>Bio:</td>
								<td><textarea name="bio" id="bio" cols="30" rows="10"></textarea></td>
                            </tr>
                            <tr>
                                <td><input class="insert_contact_button" type="submit" name="submit" value="Insert Contact"></td>
                                <td><a href="index.php"><input class="cancel_contact_button" type="button" value="Cancel"></a></td>
                            </tr>
						<div class="clear"></div>
						
						
					</form>
				</div>
				<div class="clear"></div>
			</div>
		</div>	
</body>
</html>		
