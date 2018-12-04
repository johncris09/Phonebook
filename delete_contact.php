<?php
    $contact_id='';
    if(isset($_GET['delete_contact_id'])){
        $contact_id = $_GET['delete_contact_id'];
    }
    if(isset($_POST['delete'])){
        $delete_id = $_POST['delete_id'];
        $delete_contact = mysqli_query($conn, "delete from contacts where contact_id = '$delete_id'");
        echo"<script>location.href='index.php'</script>";

    }
    mysqli_close($conn);
?>


<div class="modal" id="delete_contact_id" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <form action="index.php?delete_contact_id=<?php echo  $contact_id; ?>" method="post">
        <input type="hidden" name="delete_id" value="<?php echo  $contact_id; ?>">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id=close" onclick="$('#delete_contact_id').fadeOut();">&times;</button>
                <h4 class="modal-title"><strong>Delete!!!</strong></h4>
            </div>
            <div class="modal-body">
                <p><span class="glyphicon glyphicon-info-sign alert-info"></span>&nbsp;&nbsp;Are you sure you want to delete this data ?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" name="delete"   class="btn btn-primary" ><span class="glyphicon glyphicon-ok"></span> Yes</button>
                <button type="button" onclick="$('#delete_contact_id').fadeOut();" class="btn btn-danger" ><span class="glyphicon glyphicon-remove"></span> No</button>
            </div>
        </div>
        </form>
    </div>
</div>