<?php
   include("assets/config.php");
   session_start();

   //If User is already Log .
   //No need to log in again.
   if(isset($_SESSION['login_user'])){
      header("location:index.php");
      location.reload();
   }


   $error='';
   $myusername='';
   $mypassword='';
   
   if($_SERVER["REQUEST_METHOD"] == "POST" ) {
      // username and password sent from form 
      if(isset($_POST['username'])){
         $myusername = mysqli_real_escape_string($conn,$_POST['username']);
      }
      if(isset($_POST['username'])){
         $mypassword = mysqli_real_escape_string($conn ,$_POST['password']); 
      }
      
      $sql = "SELECT User.User_ID FROM User WHERE User.User_Name = '$myusername' and User.Password = PASSWORD('$mypassword')";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         //session_register('$user_id');
         $_SESSION['user_id'] = $row['User_ID'];   
         //session_register('$myusername');
         $_SESSION['login_user'] = $myusername;
         header("location: index.php");
         location.reload();
      }else {
         header("location:login.php?login_err=1");
      }
   }   
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Login</title>
      <?php include('assets/head_info.php'); ?>
      <link rel="stylesheet"  href="css/background-carousel.css" type="text/css" />
      <script>
         $('.carousel').carousel();
      </script>
   </head>
   
   <body>
      <!-- Background Carousel -->
      <div class="carousel slide carousel-fade" data-ride="carousel">
          <!-- Wrapper for slides -->
         <div class="carousel-inner" role="listbox">
            <div class="item"></div>
            <div class="item active"></div>
            <div class="item"></div>
            <div class="item"></div>
         </div>
      </div>


   <div id="loginbox" style="margin-top:50px;" class="mainbox col-sm-4 col-sm-offset-4">                    
		<div class="panel panel-primary" >
			<div class="panel-heading">
				<div class="panel-title">Sign In</div>
			</div>     

			<div style="padding-top:30px" class="panel-body " >
            
				<form id="loginform" class="form-horizontal" role="form" action="" method = "post">
               
					<!--Username-->		
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i style="color:#337ab7;" class="glyphicon glyphicon-user"></i></span>
						<input id="username" type="text" class="form-control" name="username" value="" title="Username" placeholder="Username" autofocus autocomplete>                                        
					 </div>
					<!--Password-->	
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i style="color:#337ab7;" class="glyphicon glyphicon-lock"></i></span>
						<input id="password" type="password" title="Password" class="form-control" name="password" placeholder="Password">
               </div>
               <div style="margin-top:10px" class="form-group">
						<!-- Button -->
						<div class="col-sm-12 controls">
                     <button type="submit" class="btn btn-primary " name="submit"><span class="glyphicon glyphicon-user"></span> Login  </button>
                  </div>
               </div>
               <div class="form-group">
						<div class="col-md-12 control">
							<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
								Don't have an account! 
							<a href="register.php" title="Sign Up Here">
								Sign Up Here
							</a>
							</div>
						</div>
					</div>    
				</form>  
			</div>                     
		</div>  
   </div>
   
   
   <div class="modal" id="LoginError" role="dialog">
		<div class="modal-dialog">

		<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" id=close" onclick="$('#LoginError').fadeOut();$('#username').focus()">&times;</button>
					<h4 class="modal-title"><strong>Warning!!!</strong></h4>
				</div>
				<div class="modal-body">
					<p><span class="glyphicon glyphicon-alert alert-info"></span>&nbsp;&nbsp;Invalid Username/Password</p>
				</div>
				<div class="modal-footer">
					<button type="button" onclick="$('#LoginError').fadeOut();$('#username').focus()"class="btn btn-primary" ><span class="glyphicon glyphicon-ok"></span> Ok</button>
					<button type="button" onclick="$('#LoginError').fadeOut();$('#username').focus()"class="btn btn-danger" ><span class="glyphicon glyphicon-remove"></span> Cancel</button>
				</div>
         </div>
      </div>
   </div>
   
  
      <?php
         if(isset($_GET['login_err']) == 1){
            
      ?>
      
         <script type='text/javascript'>

            var modal = document.getElementById('LoginError');
            $('#LoginError').fadeIn();

            
            window.onclick = function(event) {
               if (event.target == modal) {
                  $('#LoginError').fadeOut();
               }
            }
         </script>
      <?php }?>
   </body>
 
</html>