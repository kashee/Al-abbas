<?php include ('include/config.php');
session_start();
if(!isset($_SESSION['email']))
{
    session_destroy();
    
    echo "<script>window.location='index.php';</script>";
    exit;
     
}
if (isset($_REQUEST['imgname'])) {
    unlink(FILE_URL.'header/'.$_REQUEST['imgname']);
	echo "<script>window.location='homeheader.php';</script>";
	exit;
}

if (isset($_REQUEST['headerimage']) && $_REQUEST['headerimage'] == 'Submit') {
	
   foreach($_FILES['headerimage']['name'] as $key=>$value){
		$imagename = time().'-'.$_FILES['headerimage']['name'][$key];
		$uploadfile = FILE_URL.'header/'.$imagename;
		$res = move_uploaded_file($_FILES['headerimage']['tmp_name'][$key], $uploadfile);
   }
   echo "<script>window.location='homeheader.php';</script>";
   
   exit;
}



?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Header Images | Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="apple-touch-icon" href="apple-icon.png">
<link rel="shortcut icon" href="favicon.ico">
<link rel="stylesheet" href="assets/css/normalize.css">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/themify-icons.css">
<link rel="stylesheet" href="assets/css/flag-icon.min.css">
<link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
<link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">
<!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
<link rel="stylesheet" href="assets/scss/style.css">
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>

<!-- Left Panel -->

<?php include ('include/sidemenu.php'); ?>

<!-- Left Panel --> 

<!-- Right Panel -->

<div id="right-panel" class="right-panel">

<!-- Header-->
<?php include ('include/header.php'); ?>
<!-- Header-->

<div class="breadcrumbs">
  <div class="col-sm-4">
    <div class="page-header float-left">
      <div class="page-title">
        <h1>Header Images</h1>
      </div>
    </div>
  </div>
  <div class="col-sm-8">
    <div class="page-header float-right">
      <div class="page-title">
        <ol class="breadcrumb text-right">
          <li><a href="#">Dashboard</a></li>
          <li class="active">Header Images</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="container">
    <div class="row">
    <form action="" method="post" enctype="multipart/form-data">
		<input type="file" name="headerimage[]" multiple>
		<input type="submit" name="headerimage" class="btn btn-primary" value="Submit">
    </form>
    </div>
</div>    




<div class="container">
    <div class="row">
      <?php
								$dirnameh = FILE_URL."header/";
								$directoryh = $dirnameh;
								$scanned_directoryh = array_diff(scandir($directoryh), array('..', '.'));
								$t = 1;
								foreach($scanned_directoryh as $key=>$val){
                                ?>
      <div class="col-lg-2 col-md-4 col-xs-6 thumb" style="text-align:center;"> <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                   data-image="<?=IMAGE_URL.'header/'.$val;?>"
                   data-target="#image-gallery"> <img class="img-thumbnail"
                         src="<?=IMAGE_URL.'header/'.$val;?>"
                         height="150" width="150"
                         alt=""> </a> 
                         <a href="?imgname=<?=$val;?>" style="color: red; font-size: 19px;"><i class="fa fa-trash" aria-hidden="true"></i></a>
                         </div>
      <?php
								$t++;}
                                ?>
      <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="image-gallery-title"></h4>
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span> </button>
            </div>
            <div class="modal-body"> <img id="image-gallery-image" class="img-responsive col-md-12" src=""> </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i> </button>
              <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i> </button>
            </div>
          </div>
        </div>
      </div>
    </div>

  <style>
.btn:focus, .btn:active, button:focus, button:active {
  outline: none !important;
  box-shadow: none !important;
}

#image-gallery .modal-footer{
  display: block;
}

.thumb{
  margin-top: 15px;
  margin-bottom: 15px;
}
.img-thumbnail{height:150px;}
</style>
  
  <!-- .content --> 
  
</div>

</div>
<script src="assets/js/vendor/jquery-2.1.4.min.js"></script> 
<script src="assets/js/popper.min.js"></script> 
<script src="assets/js/plugins.js"></script> 
<script src="assets/js/main.js"></script> 
<script src="assets/js/lib/data-table/datatables.min.js"></script> 
<script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script> 
<script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script> 
<script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script> 
<script src="assets/js/lib/data-table/jszip.min.js"></script> 
<script src="assets/js/lib/data-table/pdfmake.min.js"></script> 
<script src="assets/js/lib/data-table/vfs_fonts.js"></script> 
<script src="assets/js/lib/data-table/buttons.html5.min.js"></script> 
<script src="assets/js/lib/data-table/buttons.print.min.js"></script> 
<script src="assets/js/lib/data-table/buttons.colVis.min.js"></script> 
<script src="assets/js/lib/data-table/datatables-init.js"></script> 
<script>
    function openEditModal(t_id) {
        console.log(t_id);
        var url='ajax/getCategoryData.php?id='+t_id;
        
        $.ajax({
            url: url,
            type: 'GET',
            success: function (resp) {
                //console.log(resp);
                var json = $.parseJSON(resp);

                var idd=json.id;
                var category=json.category;
                
                //console.log(category);
                $('#idd').val(idd);
                $('#category').val(category);

                
                
                $('#editModal').modal('show');
                
                                    
            },
            error: function(e) {
                alert('Error: '+e);
            }
        });
    }
	
function mychangestatus(id){
	var cstatusv = $('#cstatus'+id).val();	
	jQuery.ajax({
		type: "POST",	
		url: 'ajaxfile.php',
		data: {userid: id,userrole:cstatusv},	
		success: function(data){	
			location.reload();	
		}	
	});
}
</script> 
<script>
let modalId = $('#image-gallery');

$(document)
  .ready(function () {

    loadGallery(true, 'a.thumbnail');

    //This function disables buttons when needed
    function disableButtons(counter_max, counter_current) {
      $('#show-previous-image, #show-next-image')
        .show();
      if (counter_max === counter_current) {
        $('#show-next-image')
          .hide();
      } else if (counter_current === 1) {
        $('#show-previous-image')
          .hide();
      }
    }

    /**
     *
     * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
     * @param setClickAttr  Sets the attribute for the click handler.
     */

    function loadGallery(setIDs, setClickAttr) {
      let current_image,
        selector,
        counter = 0;

      $('#show-next-image, #show-previous-image')
        .click(function () {
          if ($(this)
            .attr('id') === 'show-previous-image') {
            current_image--;
          } else {
            current_image++;
          }

          selector = $('[data-image-id="' + current_image + '"]');
          updateGallery(selector);
        });

      function updateGallery(selector) {
        let $sel = selector;
        current_image = $sel.data('image-id');
        $('#image-gallery-title')
          .text($sel.data('title'));
        $('#image-gallery-image')
          .attr('src', $sel.data('image'));
        disableButtons(counter, $sel.data('image-id'));
      }

      if (setIDs == true) {
        $('[data-image-id]')
          .each(function () {
            counter++;
            $(this)
              .attr('data-image-id', counter);
          });
      }
      $(setClickAttr)
        .on('click', function () {
          updateGallery($(this));
        });
    }
  });

// build key actions
$(document)
  .keydown(function (e) {
    switch (e.which) {
      case 37: // left
        if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
          $('#show-previous-image')
            .click();
        }
        break;

      case 39: // right
        if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
          $('#show-next-image')
            .click();
        }
        break;

      default:
        return; // exit this handler for other keys
    }
    e.preventDefault(); // prevent the default action (scroll / move caret)
  });

</script>
</body>
</html>