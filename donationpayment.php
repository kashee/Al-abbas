<?php include ('include/config.php');
session_start();
if(!isset($_SESSION['email']))
{
    session_destroy();
    
    echo "<script>window.location='index.php';</script>";
    exit;
     
}
if (isset($_POST['update'])) {
    
    $id = $_POST['ids'];
    $category = $_POST['category'];
    $sql = mysqli_query($conn,"UPDATE `contactus` SET `category`='".$category."' WHERE id='".$id."'");

    if (isset($sql)) {
        $success = "Category has been updated";
    } else {
        $fail = "Something went wrong";
    }
}
if (isset($_REQUEST['delete'])) {
    $delete = mysqli_query($conn,"delete from contactus where id = '".$_REQUEST['delete']."'");

    if ($delete) {
        $success = "Category has been deleted";
    } else {
        $fail = "Something went wrong";
    }
}

if (isset($_GET['page_no']) && $_GET['page_no']!="") {
	$page_no = $_GET['page_no'];
	} else {
		$page_no = 1;
        }
		
$total_records_per_page = 10;
$offset = ($page_no-1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
$result_count = mysqli_query($conn,"SELECT COUNT(*) As total_records FROM `ksmic_donation`");
$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total page minus 1
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Donation List | Admin</title>
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
                        <h1>Donation List</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Donation List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

            <div class="content mt-3">
            <?php include ('alert.php'); ?>
                <div class="animated fadeIn">
                    <div class="row">
                    <div class="col-md-12">
                        <div class="card">                            
                        <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Donee</th> 
                                <th>Donor Name</th> 
                                <th>Donor Email</th>
                                <th>Donor Mobile No</th>
                                <th>Donor Address</th>
                                <th>Title / Marja</th>
								<th>Donation For</th> 
                                <th>Amount</th>                               
                                <th>Receipt</th>
                                <?php /*?><th>Notes</th><?php */?>
                                <?php /*?><th>Status</th><?php */?>
                              </tr>
                            </thead>
                            <tbody>                      
                                <?php
								$t = $offset+1;
                                $get_category = mysqli_query($conn,"select * from ksmic_donation ORDER BY id DESC LIMIT $offset, $total_records_per_page");
                                while ($result = mysqli_fetch_array($get_category))
                                {
                                ?>
                                <tr>
                                <td><?php echo $t; ?></td>
                                <td><?php echo $result ['type']; ?></td>
                                <td><?php echo $result ['name']; ?></td>
                                <td><?php echo $result ['emailaddress']; ?></td>
                                <td><?php echo $result ['contact']; ?></td>
                                <td><?php echo $result ['address']; ?></td>
								<td><?php echo $result ['title']; ?></td>
								<td><?php echo $result['specifydonation'];?></td>
                                <td>&pound;<?php echo ($result ['amount']/100); ?></td>
                                <td>
									<?php if($result ['status'] == 1) { ?>
									<a href="<?php echo $result ['receipt_url']; ?>" target="_blank">view</a>
								<?php } else { echo "Payment failed Error :- ".db2app($result ['receipt_url']); }?>									
								</td>
                                <?php /*?><td><?php echo $result ['community_notes']; ?></td><?php */?>   
                                <?php /*?><td><select class="form-control" id="cstatus<?=$result['id']; ?>" onChange="mychangestatus('<?=$result['id']; ?>');">
                                <option value="0" <?php if($result['comstatus'] == 0){ ?>selected<?php } ?>>Deactive</option>
                                <option value="1" <?php if($result['comstatus'] == 1){ ?>selected<?php } ?>>Active</option>
  							    </select></td> <?php */?>                         
                                </tr>
                                <?php
                                $t++;
                                }
                                ?>                       
                            </tbody>
                        </table>
                        <ul class="pagination">
	<?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
    
	<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous</a>
	</li>
       
    <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){
		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}
        }
		echo "<li><a>...</a></li>";
		echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
		echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
		}

	 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
		echo "<li><a href='?page_no=1'>1</a></li>";
		echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
           if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li><a>...</a></li>";
	   echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
	   echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
		
		else {
        echo "<li><a href='?page_no=1'>1</a></li>";
		echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}                   
                }
            }
	}
?>
    
	<li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
	</li>
    <?php if($page_no < $total_no_of_pages){
		echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
		} ?>
</ul>
                        </div>
                        </div>
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
		data: {commnunityid: id,comstatus:cstatusv},	
		success: function(data){	
			location.reload();	
		}	
	});
}
</script>


</body>
</html>
