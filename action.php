<?php
	
	session_start();
	
	include_once("scripts.php");
	
	if (!isset($_POST["submit"])) {
		header("Location: index.php");
	}
		
	date_default_timezone_set("America/Los_Angeles");
	
	echo highlight_string("<?php\n\$data =\n" . var_export($_POST, true) . ";\n?>");
	
	$data =
	array (
	  'event' => $_POST['event'],
	  'degree' => $_POST['degree'],
	  'major' => $_POST['major'],
	  'date' => $_POST['date'],
	  'start_time' => $_POST['start_time'],
	  'end_time' => $_POST['end_time'],
	  'name' => $_POST['name'],
	  'id' => $_POST['id'],
	  'email' => $_POST['email'],
	  'thesis_title' => $_POST['thesis_title'],
	  'thesis_abstract' => $_POST['thesis_abstract'],
	  'committee_members_name' => 
	  array (
	    0 => $_POST['committee_members_name'][0],
	    1 => $_POST['committee_members_name'][1],
	    2 => $_POST['committee_members_name'][2],
	    3 => $_POST['committee_members_name'][3],
	    4 => $_POST['committee_members_name'][4],
	    5 => $_POST['committee_members_name'][5]
	  ),
	  'members_role' => 
	  array (
	    0 => $_POST['members_role'][0],
	    1 => $_POST['members_role'][1],
	    2 => $_POST['members_role'][2],
	    3 => $_POST['members_role'][3],
	    4 => $_POST['members_role'][4],
	    5 => $_POST['members_role'][5]
	  ),
	  'committee_members_school' => 
	  array (
	    0 => $_POST['committee_members_school'][0],
	    1 => $_POST['committee_members_school'][1],
	    2 => $_POST['committee_members_school'][2],
	    3 => $_POST['committee_members_school'][3],
	    4 => $_POST['committee_members_school'][4],
	    5 => $_POST['committee_members_school'][5]
	  ),
	  'submit' => $_POST['submit']
	);
	
	$data = getScripts($data);
	$event_title = $data["event_title"];
	$script = $data["script"];
	$announcement = getAnnouncement($data);
	
// 	$_SESSION["data"] = $data;
		
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $event_title; ?> Script</title>
		<link rel="stylesheet" type="text/css" href="main.css">
	</head>
	<body>
 		<div id="script"><?php echo $script; ?></div>
 		<hr>
 		<div id="announcement"><?php echo $announcement; ?></div>
	</body>
</html>
