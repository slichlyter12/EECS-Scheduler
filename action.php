<?php
	
	session_start();
	
	include_once("scripts.php");
	
	if (!isset($_POST["submit"])) {
		header("Location: index.php");
	}
		
	date_default_timezone_set("America/Los_Angeles");
	
	/* echo highlight_string("<?php\n\$data =\n" . var_export($_POST, true) . ";\n?>"); */
	
	$data =
	array (
	  'event' => $_POST['event'],
	  'degree' => $_POST['degree'],
	  'major' => $_POST['major'],
	  'room' => $_POST['room'],
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
	  'members_email' =>
	  array(
		0 => $_POST['committee_email'][0],
	    1 => $_POST['committee_email'][1],
	    2 => $_POST['committee_email'][2],
	    3 => $_POST['committee_email'][3],
	    4 => $_POST['committee_email'][4],
	    5 => $_POST['committee_email'][5]
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
			
	switch ($data['event']) {
		case 'final_thesis': 
			// open final thesis
			$email_subject = "Final Thesis";
			$script = post_final_thesis($data);
			break;
		case 'final_non_thesis':
			// open final non-thesis
			$email_subject = "Final Non-Thesis";
			$script = post_final_non_thesis($data);
			break;
		case 'phd_prelim':
			// open phd prelim
			$email_subject = "PhD Preliminary Oral Exam";
			$script = post_phd_prelim($data);
			break;
		case 'phd_qual':
			// open phd qualifier
			$email_subject = "PhD Qualifying Exam";
			$script = post_phd_qualifier($data);
			break;
		case 'meng':
			// open meng
			$email_subject = "MEng Final Exam";
			$script = post_meng($data);
			break;
		case 'program_meeting':
			// open program meeting
			$email_subject = "PhD Program Meeting";
			$script = post_program_meeting($data);
			break;
		default: 
			// error handle
			$script = "No Event Selected!";
			break;
	}
	
	$_SESSION["script"] = $script;
	$_SESSION["data"] = $data;
		
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $email_subject; ?> Script</title>
		<link rel="stylesheet" type="text/css" href="main.css">
	</head>
	<body>
 		<div id="script"><?php echo $script; ?></div>
		<form id="email_form" method="post" action="email.php">
			<input type="hidden" name="subject" value="<?php echo $email_subject; ?>">
			<button type="submit" value="email">Email this to <?php echo $data["name"]; ?></button>
		</form>
	</body>
</html>
