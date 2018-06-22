<?php
	
	// start session
	session_start();
	
	// set debug level
	$debug = 0;
	if (!$debug) {
		error_reporting(0);
	}
	
	// get scripts functions
	include_once("../scripts.php");
	
	// if user didn't come from the from, redirect them there 
	if (!isset($_POST["submit"])) {
		header("Location: index.php");
	}
		
	// set default timezone for date functions
	date_default_timezone_set("America/Los_Angeles");
	
	// set main $data array
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
	
	// See scripts.php getScripts() function definition for explanation of this block
	$data = getScripts($data);
	$data = formatDegree($data);
	$event_title = $data["event_title"];
	$script = $data["script"];
	
	// get announcement
	$announcement = getAnnouncement($data);
	
	// get file task
	$fileTask = getFileTask($data);
	
	// put html message into string
	$email_message = "<style>\n";
	$email_message .= file_get_contents("../main.css")."\n";
	$email_message .= "</style>\n";
	$email_message .= highlight_string(var_export($_POST, true), true)."\n";
	$email_message .= $script."\n";
	$email_message .= "<hr>\n";
	$email_message .= $announcement."\n";
	$email_message .= $fileTask."\n"; 
	
// 	echo $email_message;
		
	// send email function
	function send_email($email_to, $email_from, $email_bcc, $subject, $message){
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers = $headers . 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers = $headers . $email_from . $email_bcc;
	    if (mail($email_to,$subject,$message,$headers)) {
			return true;
		} else {
			return false;
		};
	 }
	 
	 // define email message data
	 $toEmail = "lichlyts@oregonstate.edu";
// 	 $toEmail = "calvin.hughes@oregonstate.edu";
	 $fromEmail = "From: event.scheduler@oregonstate.edu";
	 $bccEmail = "";
	 $subject = "New Event Scheduled - " . $data['name'];
	 $message = $email_message;
	 
	 // send email, if failed say so; if not, also say so
	 if (send_email($toEmail, $fromEmail, $bccEmail, $subject, $message)) {
		 $confirmation = "<h3 style='color: green'>Thank you for your submission! The grad coordinator will schedule your room and email you with more information at their earliest convenience!</h3>";
	 } else {
		 $confirmation = "<h3 style='color: red'>Submission Error! Please try again.</h3>";
	 }
	 
	 // SHOW CONFIRMATION HTML
	 $page_title = "Student Scheduler";
	 include("../../libs2/head.php");
?>

<h1 class="title">EECS Student Scheduler</h1>
<div class="test">
	<div class="testing">
		<?php echo $confirmation; ?>
	</div>
</div>

<?php include_once("addon_menu.php"); ?>
<?php include_once("../../libs2/audience_menu.php"); ?>
<?php include_once("../../libs2/foot.php"); ?>

