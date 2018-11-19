<?php 
    include('session.php');

    $contact_id = $_GET['id'];

    $view_contact = mysqli_query($conn, "select * from contacts where contact_id = '$contact_id'");
   

?>


<!DOCTYPE html>
<html>
<head>
    <title>View Contact</title>
    <style>
       
    </style>
    
</head>
<body>
    <?php while ($row = mysqli_fetch_array($view_contact)) { 
        
            if($row['Profile_Picture']==""){ ?>
            <img src='' alt='Profile Picture'>
        <?php }else{?>
            <img style="width:10%;" src=<?php echo '"img/'.$row['Profile_Picture'].'"' ?> alt='Profile Pic'>
        <?php } ?>
    <table>
        <tr>
            <td>
                
                


            </td>

            <td></td>
        </tr>
        <tr>
            <td>Firstname</td>
            <td><?php echo $row['First_Name']; ?></td>
        </tr>
        <tr>
            <td>Last_Name</td>
            <td><?php echo $row['Last_Name']; ?></td>
        </tr>
        <tr>
            <td>Nickname</td>
            <td><?php echo $row['Nickname']; ?></td>
        </tr>
        <tr>
            <td>Phone_Number</td>
            <td><?php echo $row['Phone_Number']; ?></td>
        </tr>
        <tr>
            <td>Work Phone Number</td>
            <td><?php echo $row['Work_Phone_Number']; ?></td>
        </tr>
        <tr>
            <td>Home Phone Number</td>
            <td><?php echo $row['Home_Phone_Number']; ?></td>
        </tr>
        <!--
        <tr>
            <td>City</td>
            <td>< ?php echo $row['City']; ?>
        </td>
        <tr>
            <td>State</td>
            <td>< ?php echo $row['State']; ?></td>
        </tr>
        -->
        <tr>
        
            <td>Address</td>
            <td><a href="http://maps.google.com/?q=<?php echo  $row["City"] . ", " . $row["State"] . " " . $row["ZIpcode"]?>"><?php echo $row["City"] . ", " . $row["State"] . " " . $row["ZIpcode"]?></a>

            </td>
        </tr>
        <tr>
            <td>Bio</td>
            <td><?php echo $row['Bio']; ?></td>

        </tr>
        <tr>
            <td colspan="2">
                <a href="index.php">Back</a>

            </td>

        </tr>

    </table>
   
           
           

    <?php    }?>
    
</body>
</html>		
