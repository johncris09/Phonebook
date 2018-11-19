<?php 
    include("config.php");
    if(isset($_POST['delete'])){
        $delete_id = $_POST['delete_id'];
        $delete_contact = mysqli_query($conn, "delete from contacts where contact_id = '$delete_id'");
        header("location: index.php");

    }
    mysqli_close($conn);
 ?>
 

 <!DOCTYPE html>
<html>
<head>
	<title>Phonebook</title>
</head>
<body>
    <form action="delete_contact.php?id=<?php echo  $_GET['id']; ?>" method="post">
        <input type="text" name="delete_id" value="<?php echo $_GET['id'] ?>">
						
        <h1>Are you sure you want to delete this data?</h1>
        <input type="submit"  value="Yes" name="delete"/>
        <a href="index.php" >No</a>
    </form>
</body>
</html>