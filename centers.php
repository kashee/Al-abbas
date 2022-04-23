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
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Centers List | Admin</title>
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
<style type="text/css">
.activet {
    background: green;
    color: #fff;
}
.deactivate{
    background: red;
    color: #fff;
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
                        <h1>Community List</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><input type="button" name="Add" value="Add" id="0" class="btn btn-info btn-xs edit_data"  data-toggle="modal" data-target="#edit_data_Modal_0"></li>
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Centers List</li>
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
                        <?php
							$getfmember = mysqli_query($conn,"SELECT
                                            sr.*
                                        FROM
                                            centers AS sr
                                       
                                        ORDER BY
                                            sr.id DESC
									");
						?>
							<table id="datatable1" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>                                
                                <th>Type</th>
                                <th>Url</th>
                                <th>Address</th>
                                <th>Latitide</th>
                                <th>Longitude</th>
                                <th>Edit</th>
                              </tr>
                            </thead>
                            <tbody>     
                                
                            <?php while ($result = mysqli_fetch_array($getfmember)) { ?>
                                    <tr>
                                    <td><?php echo $result ['id']; ?></td> 
                                    <td><?php if($result ['logo']){ ?><img src="<?php echo IMAGE_URL.'centers/'.$result ['logo']; ?>" height="75" width="75"> <?php }?></td>                            
                                    <td><?php echo $result ['name']; ?></td>                                
                                    <td><?php echo $result ['type']; ?></td>
                                    <td><a href="<?php echo $result ['web_url']; ?>" ><?php echo $result ['web_url']; ?></a></td>
                                    <td><address><?php echo $result ['address']; ?></address></td>
                                    <td><?php echo $result ['lat']; ?></td>
                                    <td><?php echo $result ['lng']; ?></td>
                                    <td><input type="button" name="edit" value="Edit" id="<?=$result['id'];?>" class="btn btn-info btn-xs edit_data"  data-toggle="modal" data-target="#edit_data_Modal_<?=$result['id'];?>"></td>

                            </tr>

                            <?php } ?>                     
                            </tbody>
                        </table>
                        </div>
                        </div>
                    </div>
                    </div>
                </div><!-- .animated -->
            </div><!-- .content -->

</div>

<div id="edit_data_Modal_0" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Center</h4>
            </div>
            <div class="modal-body">
				<form id="comunity_data_0" method="post" enctype="multipart/form-data">
                    <label>Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="" required/>
                    <br />
                    <label>Type</label>
                    <select name="ctype" id="ctype" class="form-control" required>
                        <option value="Religion">Religion</option>
                        <option value="Community Care" >Community Care</option>
                        <option value="Business">Business</option>
                        <option value="Influencer">Influencer</option>
                    </select>
                    <br />
                    <label>Web Url</label>
                    <input type="url" name="web_url" id="web_url" class="form-control" value="" required/>
                    <br />
                    <label>Address</label>
                    <textarea rows="2" type="text" name="address" id="address" class="form-control" required></textarea>
                    <br />

                    <div class="row">
                        <div class="col-md-6">
                            <label>Latitude</label>
                            <input type="text" name="lat" id="lat" class="form-control"  required/>
                        </div>
                        <div class="col-md-6">
                            <label>Longitude</label>
                            <input type="text" name="lng" id="lng" class="form-control" required/>
                        </div>
                    </div>

                    <label>Logo</label>
                    <br />

                    <input type="file" name="cimage" id="cimage">
                    <br />
                    <input type="hidden" name="centerid" id="centerid" value="0" />
                    <br />
                    <button  type="button" name="update" id="update" class="btn btn-primary" 
					onClick="updateCommunity('0');">Create</button>
				</form>	
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
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
		data: {commnunityid: id,comstatus:cstatusv},	
		success: function(data){	
			location.reload();	
		}	
	});
}
function changeAdmin(communityID, admin){
	var adminID = admin.value;
	//console.log(adminID + " "+ communityID)
	jQuery.ajax({
		type: "POST",	
		url: 'ajaxfile.php',
		data: {communityID: communityID , adminID : adminID, event : "changeadmin"},	
		success: function(data){	
			//console.log(data);
			location.reload();	
		}	
	});
}
function updateCommunity(t){
//	multipart/form-data
		//$("form#data").submit(function(e) {
		//	e.preventDefault();
		//alert(t);
		var form = $('#comunity_data_'+t)[0];
		var data = new FormData(form);
			console.log(data);			 
			jQuery.ajax({
				type: "POST",	
				url: 'ajaxfile.php',
				enctype: 'multipart/form-data',
				processData: false,
				contentType: false, 
				cache: false,
				timeout: 600000,
				data: data,	
				success: function(data){			
					location.reload();
						
				},
				error: function (e) {
					alert(e+"");
				}	
			});
	//});
}
</script>
<?php
$t = $offset+1;
$get_category = mysqli_query($conn,"SELECT
sr.*
FROM
centers AS sr

ORDER BY
sr.id DESC");
while ($result = mysqli_fetch_array($get_category))
{
?>
<div id="edit_data_Modal_<?=$result['id'];?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Center</h4>
            </div>
            <div class="modal-body">
				<form id="comunity_data_<?=$result['id'];?>" method="post" enctype="multipart/form-data">
                    <label>Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?=$result ['name'];?>" required/>
                    <br />
                    <label>Type</label>
                    <select name="ctype" id="ctype" class="form-control" required>
                        <option value="Religion" <?=($result[ 'type']=='Religion' )? "selected": ""?>>Religion</option>
                        <option value="Community Care" <?=($result[ 'type']=='Community Care' )? "selected": ""?>>Community Care</option>
                        <option value="Business" <?=($result[ 'type']=='Business' )? "selected": ""?>>Business</option>
                        <option value="Influencer" <?=($result[ 'type']=='Influencer' )? "selected": ""?>>Influencer</option>
                    </select>
                    <br />
                    <label>Web Url</label>
                    <input type="url" name="web_url" id="web_url" class="form-control" value="" required/>
                    <br />
                    <label>Address</label>
                    <textarea rows="2" type="text" name="address" id="address" class="form-control" required><?=$result ['address'];?></textarea>
                    <br />

                    <div class="row">
                        <div class="col-md-6">
                            <label>Latitude</label>
                            <input type="text" name="lat" id="lat" class="form-control" value="<?=$result ['lat'];?>" required/>
                        </div>
                        <div class="col-md-6">
                            <label>Longitude</label>
                            <input type="text" name="lng" id="lng" class="form-control" value="<?=$result ['lng'];?>" required/>
                        </div>
                    </div>

                    <label>Logo</label>
                    <br />

                    <input type="file" name="cimage" id="cimage">
                    <br />
                    <input type="hidden" name="centerid" id="centerid" value="<?=$result['id'];?>" />
                    <br />
                    <button  type="button" name="update" id="update" class="btn btn-primary" 
					onClick="updateCommunity('<?=$result['id'];?>');">Update</button>
				</form>	
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php $t++; } ?>  
<script>
$( document ).ready(function() {
    $('#datatable1').DataTable({
        "order": [[0, "desc"]],
		"pageLength": 100
    });
	$(".modal").on('hide.bs.modal',	function(){		setInterval(	function()	{$('body').css('padding','0px');},	500)	}	)
});
</script>
</body>
</html>