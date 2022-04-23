<?php
if(isset($success)) {
     ?>
     <div class="sufee-alert alert with-close alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> <?php echo $success;?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
     </div>
     <?php
 }
 if(isset($fail)) {
     ?>
     <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> <?php echo $fail;?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
     </div>
     <?php
 }
 ?>