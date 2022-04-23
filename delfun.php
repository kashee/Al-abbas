<?php 
include ('include/config.php');
if(isset($_REQUEST['postid']) && $_REQUEST['postid'] != '' && isset($_REQUEST['statuspost']) && $_REQUEST['statuspost'] == '2'){
	$sqldel = "DELETE FROM ksmic_post where id=".(int)$_REQUEST['postid'];
	//$res = 1;
	$res = mysqli_query($conn,$sqldel);
	echo $res;
	
}

if(isset($_REQUEST['eventid']) && $_REQUEST['eventid'] != '' && isset($_REQUEST['statusevent']) && $_REQUEST['statusevent'] == '2'){
	$sqldel = "DELETE FROM ksmic_event where id=".(int)$_REQUEST['eventid'];
	//$res = 'eventdel';
	$res = mysqli_query($conn,$sqldel);
	echo $res;
	
}

