<?php include ('include/config.php');
	session_start();
	if(!isset($_SESSION['email']))
	{
		session_destroy();
		
		echo "<script>window.location='index.php';</script>";
		exit;
		
	}
?>
<!doctype html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Payemt Event</title>
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
	<style>

		.img-data {
            display: flex;
        }
        a.img.display-inline {
            padding-left: 10px;
			/* width: 50px; */
    		/* height: 50px; */
        }
        a.img.display-inline:first-child {
            padding-left: 0;
        }
		.ui-w-100 {
			width: 100px !important;
			height: auto;
		} 

		.card {
			background-clip: padding-box;
			box-shadow: 0 1px 4px rgba(24,28,33,0.012);
		}

		.user-view-table td:first-child {
			width: 9rem;
		}
		.user-view-table td {
			padding-right: 0;
			padding-left: 0;
			border: 0;
		}

		.text-light {
			color: #babbbc !important;
		}

		.card .row-bordered>[class*=" col-"]::after {
			border-color: rgba(24,28,33,0.075);
		}

		.text-xlarge {
			font-size: 170% !important;
		}
	</style>
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
					<h1>Event Payment</h1>
				</div>
			</div>
		</div>
		<div class="col-sm-8">
			<div class="page-header float-right">
				<div class="page-title">
					<ol class="breadcrumb text-right">
						<li><a href="#">Dashboard</a></li>
						<li class="active">Event Payment </li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<div class="content mt-3">
		<?php include ('alert.php'); ?>
		<div class="animated fadeIn">
        <?php $getmember = mysqli_query($conn,"SELECT  * FROM  `ksmic_event_particitation` "); ?>
			<div class="row">
				<div class="col-md-12">
							<table id="datatable1" class="table table-responsive table-striped table-bordered" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#Id</th>
                                        <th>Event Title</th> 
                                        <th>Name</th> 
                                        <th>Email</th>
                                        <th>Address</th>  
                                        <th>Contact</th>  
                                        <th>Amount</th>
                                        <th>Status</th>   
                                        <th>Date</th>
                                        <th>Receipt</th> 
                                    </tr>
                                </thead>
                                <tbody>
								<?php while ($result = mysqli_fetch_array($getmember)) { ?>
                                    <tr>
                                        <td><?= $result['id']; ?></td>
                                        <td><?= $result['title']; ?></td>
                                        <td><?= $result['name']; ?> </td>
                                        <td><?= $result['emailaddress']; ?> </td>
                                        <td><?= $result['address']; ?> </td>
                                        <td><?= $result['contact']; ?> </td>
                                        <td>
                                            <?php if($result['paid'] == 0) { ?> 0 <?php } else {?> &#163; <?= $result['amount']; ?> <?php }?>
                                        </td>
                                        <td><?= $result['payment_status']; ?> </td>
                                       
                                        <td><?= $result['createdatetieme']; ?> </td>
                                        <td>
                                            <?php if($result['paid'] == 0) { ?>  <?php } else {?>  <a href="<?= $result['receipt_url']; ?>" >View</a> <?php }?>
                                        </td>
                                    </tr>
								<?php } ?>

								</tbody>
							</table>
						

				</div>
			
			
			</div>
		</div><!-- .animated -->
	</div><!-- .content -->

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
$(document).ready(function () {
    $('#datatable1').DataTable({
        "order": [[0, "desc"]],
		"pageLength": 100,
    });
});


</script>

</body>
</html>
