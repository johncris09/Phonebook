

<nav class="navbar navbar-default bg-primary">
    <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">
                <img style="float:left;" alt="My Phonebook Brand " src="img/logo.png" width="25" height="25" />
                &nbsp;&nbsp;<span id="brand-title">My Phonebook</span>
                
             </a>
        </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class=""><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
           
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome </span> <?php echo $_SESSION['login_user']; ?> <span class="glyphicon glyphicon-user"><!--span class="caret"--></span></a>
                <ul class="dropdown-menu">
                <li id="logout"><a  href="?logout=1" ><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>    
                </ul>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

 <div class="modal" id="Logout_msg" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"  data-dismiss="modal" onclick="$('#Logout_msg').fadeOut();">&times;</button>
                <h4 class="modal-title"><strong>Logout!!!</strong></h4>
            </div>
            <div class="modal-body">
                <p><span class="glyphicon glyphicon-question-sign alert-info"></span>&nbsp;&nbsp;Do you really want to logout ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="location.href='logout.php'" class="btn btn-primary" ><span class="glyphicon glyphicon-ok"></span> Yes</button>
                <button type="button"  class="btn btn-danger" data-dismiss="modal" onclick="$('#Logout_msg').fadeOut();" ><span class="glyphicon glyphicon-remove"></span> No</button>
            </div>
        </div>
    </div>
</div>

<?php
    if(isset($_GET['logout']) == 1){
    
?>

    <script type='text/javascript'>
        
        $('#Logout_msg').fadeIn();
        window.onclick = function(event) {
            if (event.target == modal) {
                $('#Logout_msg').fadeOut();
            }
        
        }
    </script>
<?php }?>

