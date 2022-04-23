<?php include ('include/config.php');
session_start();
//date_default_timezone_set('Africa/Algiers');
date_default_timezone_set('Europe/London');

if(!isset($_SESSION['email']))
{
    session_destroy();
    
    echo "<script>window.location='index.php';</script>";
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
<title>Information | Admin</title>
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
          <h1>Information</h1>
        </div>
      </div>
    </div>
    <div class="col-sm-8">
      <div class="page-header float-right">
        <div class="page-title">
          <ol class="breadcrumb text-right">
            <li><a href="#">Dashboard</a></li>
            <li class="active">Add Information</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
   <?php
   if (isset($_POST["Submit"])) {
   

	
	$subcommitte_id = $_POST['subcommitte_id'];
	$title = $_POST['description'];
	$description = $_POST['description'];
	$image = '';
	if(isset($_FILES['image']['name']))
	{
		
		$imagename = time().'.'.pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
	    $uploadfile = FILE_URL.'info/'.$imagename;
	    $res = move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);
		
		if($res)
		{
			$image = $imagename;
		}
		

	}
	$sql_insert = "INSERT INTO  ksmic_information(subcommitte_id,title,description,image,created_date)
	VALUES('".$subcommitte_id."','".$title."','".$description."','".$image."',NOW())";
	$res_insert = mysqli_query($conn,$sql_insert) or die(mysqli_error($conn));
	if($res_insert)
	{
		?>
			<div class="alert alert-info">Information has been added successfully.</div>
		<?php 
	}
	else
	{
		?>
			<div class="alert alert-danger">Sorry! Try again later.</div>
		<?php 
	}
	
	}
   ?> 
  <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
  
  <div class="form-group row">
     <div class="col-sm-2">Select Community:</div>
     <div class="col-sm-10">
      <select name="subcommitte_id" class="form-control" style="width:70%" required>
	  	<option value="">Select Community</option>
		<?php
			$sql_com = "Select * from  community where id = '".$_SESSION['ucommunity_id']."'";
			$res_com = mysqli_query($conn,$sql_com);
			while($row_com = mysqli_fetch_assoc($res_com))
			{
			?>
			<option value="<?php echo $row_com['id'];?>"><?php echo $row_com['community_name'];?></option>
			<?php 
			}
		?>
	  </select>
    </div>
  </div>
  
  <div class="form-group row">
     <div class="col-sm-2">Title:</div>
     <div class="col-sm-10">
      <input type="text" class="form-control" name="title" placeholder="Enter title" style="width:70%" required>
    </div>
  </div>

  <div class="form-group row">
     <div class="col-sm-2">Description:</div>
     <div class="col-sm-10">
      <textarea name="description"  class="form-control" style="width:70%" required></textarea>
    </div>
  </div>
  
  <div class="form-group row">
     <div class="col-sm-2">Upload Image<small>(jpg,jpeg,gif,png)</small>:</div>
     <div class="col-sm-10">
      <input type="file" class="form-control" name="image"  style="width:70%">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-6 col-sm-4">
      <button type="submit" class="btn btn-primary mb-2" name="Submit" value="submitinfo">Submit</button>
    </div>
  </div>
</form>
<div class="row">
      <?php 		
		echo $message;
		 ?>
    </div>
  </div>
  
  <!-- .content --> 
  
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
	
function deleteThisAnnouncement(id){
	var result = confirm("Want to delete?");
	if (result) {
		jQuery.ajax({
			type: "POST",	
			url: 'ajaxfile.php',
			data: {a_id: id,type:'delete_announcement'},	
			success: function(data){
				location.reload();	
			}	
		});	
	}
}
</script> 
<script type="text/javascript">
	$(document).ready(
	function() {
		
		$(".modal").on('hide.bs.modal',	function(){		setInterval(	function()	{$('body').css('padding','0px');},	500)	}	)
		
		$("#frmCSVImport").on(
		"submit",
		function() {

			$("#response").attr("class", "");
			$("#response").html("");
			var fileType = ".csv";
			var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+("
					+ fileType + ")$");
			if (!regex.test($("#file").val().toLowerCase())) {
				$("#response").addClass("error");
				$("#response").addClass("display-block");
				$("#response").html(
						"Invalid File. Upload : <b>" + fileType
								+ "</b> Files.");
				return false;
			}
			return true;
		});
	});
</script>
</body>
</html>