<?php 
include ('include/config.php');
include ('include/mailconfig.php');

if(isset($_REQUEST['event']) && $_REQUEST['event'] == 'changeadmin'){
	$communityId = $_REQUEST['communityID'];
	$adminID = $_REQUEST['adminID'];
	$query = "update community set userid = '". $adminID ." ' where id = ".(int)$communityId;
	mysqli_query($conn, $query);
	echo "true";
}

if(isset($_REQUEST['event']) && $_REQUEST['event'] == 'deletecontact'){
	$contactId = $_REQUEST['contactId'];
	$query = "delete from contactus where id=".$contactId;
	mysqli_query($conn, $query);
	echo "true";
}

if(isset($_REQUEST['contactid']) && $_REQUEST['contactid'] != '' && isset($_REQUEST['statusv']) && $_REQUEST['statusv'] != ''){
	$update = mysqli_query($conn, "update contactus set `status`='".$_REQUEST['statusv']."' where id=".(int)$_REQUEST['contactid']);
	
	$update_user_query  = "update ksmic_user set `userrole`='".$_REQUEST['statusv']."' where emailid = '".$_REQUEST['email']."'";
	mysqli_query($conn, $update_user_query);
	
		if($_REQUEST['statusv'] != 0){
			$mail_message = 'Salam,
                               Please check your home screen on Al Abbas App and see the login button. Please Sign Up by providing us the correct details for your status to be updated.

                               Duas,
                               KSIMC Birmingham';
			send_mail($_REQUEST['email'], 'Please Check Your Signing In Status.', $mail_message);
		}
	echo $update_user_query;
}

if(isset($_REQUEST['eventid']) && $_REQUEST['eventid'] != '' && isset($_REQUEST['statusevent']) && $_REQUEST['statusevent'] != ''){
	$update = mysqli_query($conn,"update ksmic_event set `eventstatus`='".$_REQUEST['statusevent']."' where id=".(int)$_REQUEST['eventid']);
	
	
	$get_usertokan = mysqli_query($conn,"SELECT c.userid,c.etitle,u.usertokan FROM `ksmic_event` c, ksmic_user u WHERE c.id = '".$_REQUEST['eventid']."' AND c.userid = u.id");
	$resulttokan = mysqli_fetch_array($get_usertokan);
	if(isset($resulttokan['usertokan'])){
		$title = '';
		$msg = '';
		if($_REQUEST['statusevent'] == 0){ 
			$title = 'Event Approval';
			$msg = urldecode($resulttokan['title']).' Event is not approved.';
		}
		if($_REQUEST['statusevent'] == 1){
			$title = 'Event Approval';
			$msg = urldecode($resulttokan['title']).' Event is approved.';
		}		

		push_notification_for_tokens($title,$msg,$resulttokan['usertokan']);
		
		// END single Event create user noti
		
		$resultcheckevent = mysqli_query($conn,"SELECT * FROM ksmic_event where eventstatus=1 AND id =".$_REQUEST['eventid']);
		$reget = mysqli_fetch_array($resultcheckevent);
		if($reget){
			$globaluser = "INSERT INTO `globaluser_notification`(`title`,`message`,`eventid`,`communityid`,`type`) VALUES ('".$reget['etitle']."','".$reget['info']."','".$reget['id']."','".$reget['communityid']."','Event')";
			
			mysqli_query($conn, $globaluser);
			sendNotificationToCommunity(FIREBASE_API_KEY, urldecode($reget['etitle']), urldecode($reget['info']), $reget['communityid'], 0, "event");
						
		}

		$nitiresult = mysqli_query($conn,"SELECT * FROM ksmic_notification where eventid =".$_REQUEST['eventid']);
		$notifycount = mysqli_num_rows($nitiresult);
		if($notifycount == 0){			
			$resultevent = mysqli_query($conn,"SELECT * FROM ksmic_event where eventstatus=1 AND id =".$_REQUEST['eventid']);
			$get = mysqli_fetch_array($resultevent);	
			if($get){
				$startdate = date("Y-m-d", strtotime($get['startdate']));
				$repeattime = date("h:i", strtotime($get['startdate']));
				$enddate = date("Y-m-d", strtotime($get['enddate']));
				$todaydate = date("Y-m-d");				
				if($todaydate < $startdate){
					$enddate = date("Y-m-d", strtotime($get['enddate']));
					$sql = "INSERT INTO `ksmic_notification`(`startdate`,`title`,`message`,`image`,`eventid`,`repeatday`,`isrepeat`,`repeattime`,`expirydate`) VALUES ('".$startdate."','".$get['etitle']."','".$get['info']."','".$get['image']."','".$get['id']."','".$get['remindarday']."','1','".$repeattime."','".$enddate."')";
					mysqli_query($conn,$sql);
					
				}				
				if($todaydate >= $startdate){
					$tomorrow = date("Y-m-d", strtotime("+ 1 day"));
					$enddate = date("Y-m-d", strtotime($get['enddate']));					
					$sql = "INSERT INTO `ksmic_notification`(`startdate`,`title`,`message`,`image`,`eventid`,`repeatday`,`isrepeat`,`repeattime`,`expirydate`) VALUES ('".$tomorrow."','".$get['etitle']."','".$get['info']."','".$get['image']."','".$get['id']."','".$get['remindarday']."','1','".$repeattime."','".$enddate."')";
					mysqli_query($conn,$sql);					
				}											
			}
		}
		//ksmic_notification
		if($update){			
			$result = mysqli_query($conn,"SELECT * FROM ksmic_post where eventid =".$_REQUEST['eventid']);
			$nums = mysqli_num_rows($result);
			if($nums == 0){
				$resultevent = mysqli_query($conn,"SELECT * FROM ksmic_event where id =".$_REQUEST['eventid']);
				$get = mysqli_fetch_array($resultevent);
				$title=$get['etitle'];
				$description=$get['info'];
				$city=$get['location'];
				$subadminid=$get['userid'];
				$communityid=$get['communityid'];
				$assets=json_encode(array(array('path'=>$get['image'],'type'=>'image')));
				$sql = "INSERT INTO `ksmic_post`(`title`,`description`,`assets`,`city`,`subadminid`,`communityid`,`poststatus`,`timeanddate`,`curenttimezone`,`eventid`,`type`,`typeid`) VALUES ('".$title."','".$description."','".$assets."','".$city."','".$subadminid."','".$communityid."','1','".date("D M d H:i:s O Y",time())."','Europe/London','".$_REQUEST['eventid']."','Event','1')";
				// 0 means from post
				// 1 means from event
				mysqli_query($conn,$sql);
			}
			 
		}
	
	}
	
}

if(isset($_REQUEST['postid']) && $_REQUEST['postid'] != '' && isset($_REQUEST['statuspost']) && $_REQUEST['statuspost'] != ''){
	mysqli_query($conn,"update ksmic_post set `poststatus`='".$_REQUEST['statuspost']."' where id=".(int)$_REQUEST['postid']);
		
	$get_usertokan = mysqli_query($conn,"SELECT c.subadminid,c.title,u.usertokan,c.communityid FROM `ksmic_post` c, ksmic_user u WHERE c.id = '".$_REQUEST['postid']."' AND c.subadminid = u.id");
	$resulttokan = mysqli_fetch_array($get_usertokan);
	$title = '';
	$msg = '';
	if($_REQUEST['statuspost'] == 0){ 
		$title = 'Post Approval';
		$msg = $resulttokan['title'].' Post is not approved.';
	}
	if($_REQUEST['statuspost'] == 1){
		$title = 'Post Approval';
		$msg = $resulttokan['title'].' Post is approved.';
	}
	print_r($resulttokan);
	if(isset($resulttokan['usertokan'])){				
		push_notification_for_tokens($title,$msg,$resulttokan['usertokan']);
	}
	sendNotificationToCommunity(FIREBASE_API_KEY, $title, $msg, $resulttokan['communityid'], 0, "post");
	
}

if(isset($_REQUEST['userid']) && $_REQUEST['userid'] != '' && isset($_REQUEST['userrole']) && $_REQUEST['userrole'] != ''){
	//mysqli_query($conn,"update ksmic_user set `userrole`='".$_REQUEST['userrole']."' where id=".(int)$_REQUEST['userid']);
}

if(isset($_REQUEST['commnunityid']) && $_REQUEST['commnunityid'] != '' && isset($_REQUEST['comstatus']) && $_REQUEST['comstatus'] != ''){
	mysqli_query($conn,"update community set `comstatus`='".$_REQUEST['comstatus']."' where id=".(int)$_REQUEST['commnunityid']);
}

if(	isset($_REQUEST['commnunityid']) && $_REQUEST['commnunityid'] != '' && 
	isset($_REQUEST['name']) && $_REQUEST['name'] != '' &&
	isset($_REQUEST['ctype']) && $_REQUEST['ctype'] != ''){
		
	$community_id=$_POST['commnunityid'];	
	$community_name=$_POST['name'];
	$community_type=$_POST['ctype'];
	$imagename = time().'.'.pathinfo($_FILES['cimage']['name'], PATHINFO_EXTENSION);
		
	$uploadfile = FILE_URL.'community/'.$imagename;
	
	move_uploaded_file($_FILES['cimage']['tmp_name'], $uploadfile);			
	
	$imgQuery = isset($_FILES['cimage']['name']) && $_FILES['cimage']['name'] != ''? ",community_image='".$imagename."'" : "";
	
	$query = "update community set 
								community_name='".$community_name."'"
				   			    .",community_type='".$community_type."'"
								.$imgQuery
								." where id = ".$community_id;
	
	mysqli_query($conn, $query);
}

if(isset($_REQUEST['a_id']) && $_REQUEST['a_id'] != '' &&
   isset($_REQUEST['type']) && $_REQUEST['type'] == 'delete_announcement' ){
  
   $query = "DELETE FROM `announcement` WHERE `id` = ".$_REQUEST['a_id'];
   
   mysqli_query($conn, $query);
}

