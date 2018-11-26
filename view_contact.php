<?php
    $contact_id='';
    if(isset($_GET['view_contact_id'])){
        $contact_id = $_GET['view_contact_id'];
    }
    
    $view_contact = mysqli_query($conn, "select * from contacts where contact_id = '$contact_id'");
   

?>


<div class="modal" id="view_contact" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <?php while ($row = mysqli_fetch_array($view_contact)) { ?>
                <button type="button" class="close" id="close" onclick="$('#view_contact').fadeOut()">&times;</button>
                <h4 class="modal-title" ><strong><?php echo $row['First_Name']. "  " .  $row['Last_Name']; ?></strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-5">
                        <!-- View Contact -->
                       
                        <?php    if($row['Profile_Picture']==""){ ?>    
                                <img class="img-thumbnail" src="img/logo.png"  alt='Profile Pic' style="width:95%;height:230px;">
                                <h4 class="nickname"><?php echo $row['Nickname']; ?></h4>
                        <?php }else{ ?>
                                <img class="img-thumbnail" src=<?php echo '"img/'.$row['Profile_Picture'].'"' ?> alt='Profile Pic' style="width:95%;height:230px;">
                                <h4 class="nickname"><?php echo $row['Nickname']; ?></h4>

                        <?php } ?>
                    </div>
                    <div class="col-sm-7">
                        <table class="table table-responsive table-bordered table-condensed table-hover table-striped">
                            <tr>
                                <td>Phone #</td>
                                <td class="value"><?php echo $row['Phone_Number'] ?></td>
                            </tr>
                            <tr>
                                <td>Work Phone #</td>
                                <td class="value"><?php echo $row['Phone_Number'] ?></td>
                            </tr>
                            <tr>
                                <td>Home Phone #</td>
                                <td class="value"><?php echo $row['Home_Phone_Number']; ?></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td class="value"><?php echo $row["City"] . ", " . $row["State"] . " " . $row["ZIpcode"]?> </td>

                            </tr>
                           

                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <blockquote class="well blockquote-reverse pull-right"> <?php echo $row['Bio']; ?> </blockquote>
                    </div>
                </div>
                            
            
            
            
            </div>
            
            <?php } ?>
            
            <div class="modal-footer">
                <button type="button" onclick="$('#view_contact').fadeOut();" class="btn btn-primary" ><span class="glyphicon glyphicon-ok"></span> Ok</button>
                <button type="button" onclick="$('#view_contact').fadeOut();" class="btn btn-danger" ><span class="glyphicon glyphicon-remove"></span> Cancel</button>
            </div>
        </div>
    </div>
</div>