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

if (isset($_POST["Submit"])) {	
	$announcement = app2db($_POST["announcement"]);	
	$sqlInsert = "INSERT into announcement (announcement,curenttimedate) values ('". $announcement ."','".date('Y-m-d H:i:s')."')";

	$result = mysqli_query($conn, $sqlInsert);					
	if (! empty($result)) {
		$last_id = mysqli_insert_id($conn);
		$sql = "INSERT INTO `ksmic_post`(`title`,`description`,`timeanddate`,`type`,`typeid`) VALUES ('Announcement','".$announcement."','".date("D M H:i:s O Y")."','Announcement','".$last_id."')";
		
		mysqli_query($conn, $sql);
		
//		$sql = "INSERT INTO `globaluser_notification`(`title`,`message`,`type`) VALUES ('Announcement','".$announcement."','Global')";
//		mysqli_query($conn, $sql);
		$type = "success";
		$message = "Updated Successfully";
		
		
		$url = 'https://fcm.googleapis.com/fcm/send';
		/*api_key available in:
		Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key*/    $api_key = FIREBASE_API_KEY;
		$Body = urldecode($announcement);					
		$fields = array (
			"to" => "/topics/global",
			"collapse_key" => "collapse",
			 "priority" => "high",
			 'notification' => array(
				"click_action" =>"Notification",
				"title"=> 'Announcement',
				 "body" => $Body
				),
			'data' => array (
				"title"=> 'Announcement',
				"body" => $Body,
				"notifytype" => "announcement"
			)
		);
		//echo '<pre>';
		//print_r($fields);
		//echo json_encode($fields);
		//header includes Content type and api key
	
		$headers = array(
			'Content-Type:application/json',
			'Authorization:key='.$api_key
		);
					
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		if ($result === FALSE) {
			die('FCM Send Error: ' . curl_error($ch));
		}
		curl_close($ch);
		//echo $result;	
		//return $result;
	}
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
<title>Announcement | Admin</title>
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
          <h1>Announcement</h1>
        </div>
      </div>
    </div>
    <div class="col-sm-8">
      <div class="page-header float-right">
        <div class="page-title">
          <ol class="breadcrumb text-right">
            <li><a href="#">Dashboard</a></li>
            <li class="active">Announcement</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
    <form class="form-inline" method="post" action="">
  <div class="form-group mb-2">
    <label for="staticEmail2" class="sr-only">Email</label>
    <input type="text" readonly style="font-weight: bold;" class="form-control-plaintext" id="staticEmail2" value="Announcement">
  </div>
  <div class="form-group mx-sm-3 mb-2">
    <label for="inputPassword2" class="sr-only">Password</label>
    <textarea class="form-control" name="announcement" cols="60" rows="4" ></textarea>
	
  </div>
  <button type="submit" class="btn btn-primary mb-2" name="Submit" value="submitannounce">Submit</button>
  
</form>      
      <?php 		
		echo $message;
		 ?>
    </div>
  </div>
  <div class="content mt-3">
    <?php include ('alert.php'); ?>
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <?php
				$sqlSelect = "SELECT * FROM announcement ORDER BY id DESC LIMIT 100";
				$result = mysqli_query($conn, $sqlSelect);            
				if (mysqli_num_rows($result) > 0) {
				?>
              <table id="" class="table table-striped table-bordered">
                <thead>
                  <tr>
					<th>Date/Time</th>
                    <th>Announcement</th>
                    <th>Delete</th>					
                  </tr>
                </thead>
                <tbody>
				<?php
				while ($row = mysqli_fetch_array($result)) {
				
				
				$strtosting = strtotime($row['curenttimedate']);
				?>
				<tr>
					<td><?=date('d-m-Y / g:i a',$strtosting);?></td>
					<td><?php  echo nl2br(db2app($row['announcement'])); ?></td>
					<td><input type="button" name="delete" value="Delete" class="btn btn-info" onClick="deleteThisAnnouncement(<?=$row['id'];?>)"></td>
				</tr>
				<?php
				}
				?>
                </tbody>
              </table>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- .animated --> 
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