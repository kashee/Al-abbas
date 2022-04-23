<?php
include ('include/config.php');

function get_reminder_day_event_query($day){
	$query = "SELECT ke.id AS first_id, ke.*, en.* FROM ksmic_event as ke
			  INNER JOIN eventnotification as en ON ke.id = en.eventid
			  WHERE en.notificationstatus = 1 
			  AND DATE(ke.startdate_server) = DATE_ADD(CURDATE(), INTERVAL ".$day." DAY)
			  AND FIND_IN_SET('".$day."', REPLACE(ke.remindarday,' ',''))";
	return $query;
}

$reminder_arr = array();	

$result_7 = mysqli_query($conn, get_reminder_day_event_query(7));
while ($row = mysqli_fetch_array($result_7)) 
{
	$reminder_arr[] = $row;
}

$result_3 = mysqli_query($conn, get_reminder_day_event_query(3));
while ($row = mysqli_fetch_array($result_3)) 
{
	$reminder_arr[] = $row;
}

$result_1 = mysqli_query($conn, get_reminder_day_event_query(1));
while ($row = mysqli_fetch_array($result_1)) 
{
	$reminder_arr[] = $row;
}
echo "<pre>";//print_r($reminder_arr);
foreach ($reminder_arr as $key => $reminder){

	$reminder_title = "Event Reminder";
	$reminder_event = urldecode($reminder["etitle"]);
	$reminder_tokan = $reminder["firetoken"];
	
	//echo $reminder_title . ' ' . $reminder_event . ' ' . $reminder_tokan;
	push_notification_for_tokens($reminder_title, $reminder_event, $reminder_tokan);
	//print_r();
}
?>