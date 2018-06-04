<?php
	
// 	session_start();
	
	function post_final_thesis($data) {
		$date = date("n/j/Y", strtotime($data['date']));
		$start_time = date('g:ia', strtotime($data['start_time']));
		$end_time = date('g:ia', strtotime($data['end_time']));		
		
		$script = "
			<p>You are scheduled in ROOM on $date from ROOM_TIME. Your final exam is from $start_time - $end_time so this will give you time to set up before your event. Please notify your committee of the date, time, and place.  I will send out an announcement about one week prior and it should also appear in our newsletter.  If you serve refreshments, please clean up afterwards. </p>
			
			<p><b>Schedule Event with EECS and the Graduate School:</b></p>
			
			<p>You have already scheduled your event with EECS.  Now you will need to schedule your exam with the Graduate School no later than two weeks before your exam if you have not done so already.  When you submit this form, the Graduate School will audit your file to make sure you have met the graduation requirements, and they will process the degree completion request. <b>If you do not submit the form to the Graduate School, they will not let you hold your exam.</b> Here is a link to the scheduling form: <a href='http://oregonstate.edu/dept/grad_school/phpforms/event.php'>http://oregonstate.edu/dept/grad_school/phpforms/event.php</a> Please remember to submit one copy of the pretext pages of your <a href='http://oregonstate.edu/dept/grad_school/thesis.php'>thesis</a> to the Graduate School at least two weeks before your final exam. You will also need to distribute copies of your thesis to all committee members, including your Graduate Council Representative, sufficiently early to permit your committee enough time to review your thesis prior to your final exam date.</p>
			
			<p>Once the Graduate School has processed your request, you will receive a confirmation email and your GCR will receive the exam paperwork.  Please remember to also submit your diploma application at least two weeks before your exam by logging into <a href='http://myosu.oregonstate.edu/'>MyOSU</a>, then click on \"Student Records\", and then click on \"Apply for Graduation\" if you have not already done so.</p>
			
			<p>Please come to KEC 1148 to pick up the equipment you reserved and bring your student ID card.  The office is closed from 12:00pm-1:00pm so be sure and come before 12:00pm or after 1:00pm to check out or return your reserved equipment.  Your key card access opens the room.  Please be sure to turn the projector off at the end of your session.</p>
			
			<p>The Graduate School only requires the signed <a href='http://gradschool.oregonstate.edu/sites/gradschool.oregonstate.edu/files/etd_approval-20170310.pdf'>ETD Submission Approval Form</a> and title page of your thesis for their certification process after you have completed your final exam.  Your ETD form needs to be signed by Dr. Bella Bose after you and your major advisor sign it. I can help you get his signature if you leave your ETD form and title page at the front desk for me.  After Dr. Bose signs your ETD form, I will submit it and your title page to the Graduate School.</p>
			
			<p>All MS and PhD students must upload a copy of their thesis to Scholars Archive.  More information can be found here for thesis students: <a href='http://oregonstate.edu/dept/grad_school/etd_guide.php'>http://oregonstate.edu/dept/grad_school/etd_guide.php</a>.</p>
			
			<p><b>Please remember to submit the Grad Exit Checklist to me before you leave OSU!</b> It can be found at: <a href='http://eecs.oregonstate.edu/current-students/graduate/forms/grad-exit-checklist'>http://eecs.oregonstate.edu/current-students/graduate/forms/grad-exit-checklist</a></p>
			
			<p>Please let me know if you have any questions or need any additional information!</p>
			
			<p>Thank you,</p>
		";
		
		return $script;
	}
	
	function post_final_non_thesis($data) {
		$date = date("n/j/Y", strtotime($data['date']));
		$start_time = date('g:ia', strtotime($data['start_time']));
		$end_time = date('g:ia', strtotime($data['end_time']));
		
		$script = "
			<p>You are scheduled in ROOM on $date from ROOM_TIME. Your final exam is from $start_time - $end_time so this will give you time to set up before your event. Please notify your committee of the date, time, and place.  I will send out an announcement about one week prior and it should also appear in our newsletter.  If you serve refreshments, please clean up afterwards. </p>
			
			<p><b>Schedule Event with EECS and the Graduate School:</b></p>
			
			<p>You have already scheduled your event with EECS.  Now you will need to schedule your exam with the Graduate School no later than two weeks before your exam if you have not done so already.  When you submit this form, the Graduate School will audit your file to make sure you have met the graduation requirements, and they will process the degree completion request. <b>If you do not submit the form to the Graduate School, they will not let you hold your exam.</b> Here is a link to the scheduling form: <a href='http://oregonstate.edu/dept/grad_school/phpforms/event.php'>http://oregonstate.edu/dept/grad_school/phpforms/event.php</a>. You will need to distribute copies of your project to all committee members sufficiently early to permit your committee enough time to review your project prior to your final exam date.</p>
			
			<p>Once the Graduate School has processed your request, you will receive a confirmation email and your major advisor will receive the exam paperwork since you are a non-thesis student.  Please remember to also submit your diploma application at least two weeks before your exam by logging into <a href='http://myosu.oregonstate.edu/'>MyOSU</a>, then click on \"Student Records\", and then click on \"Apply for Graduation\" if you have not already done so.</p>
			
			<p>Please come to KEC 1148 to pick up the equipment you reserved and bring your student ID card.  The office is closed from 12:00pm-1:00pm so be sure and come before 12:00pm or after 1:00pm to check out or return your reserved equipment.  Your key card access opens the room.  Please be sure to turn the projector off at the end of your session.</p>
			
			<p>Non-thesis students do not need to turn in an ETD form or title page to the Graduate School.  Your signed final exam card is all the Graduate School needs.  All MS non-thesis students must upload a copy of their project to Scholars Archive.  More information can be found here: <a href='http://ir.library.oregonstate.edu/xmlui/handle/1957/7302'>http://ir.library.oregonstate.edu/xmlui/handle/1957/7302</a>.</p>
			
			<p><b>Please remember to submit the Grad Exit Checklist to me before you leave OSU!</b> It can be found at: <a href='http://eecs.oregonstate.edu/current-students/graduate/forms/grad-exit-checklist'>http://eecs.oregonstate.edu/current-students/graduate/forms/grad-exit-checklist</a></p>
			
			<p>Please let me know if you have any questions or need any additional information!</p>
			
			<p>Thank you,</p>
		";
		
		return $script;
	}
	
	function post_phd_prelim($data) {
		$date = date("n/j/Y", strtotime($data['date']));
		$start_time = date('g:ia', strtotime($data['start_time']));
		$end_time = date('g:ia', strtotime($data['end_time']));
		
		$script = "
			<p>You are scheduled in ROOM on $date from ROOM_TIME. Your PhD Oral Preliminary exam is from $start_time - $end_time so this will give you time to set up before your event. Please notify your committee of the date, time, and place.  I will send out an announcement about one week prior and it should also appear in our newsletter.  If you serve refreshments, please clean up afterwards. </p>
			
			<p><b>Schedule Event with EECS and the Graduate School:</b></p>
			
			<p>You have already scheduled your event with EECS, so now you will need to schedule it with the Graduate School no later than two weeks before your exam if you have not done so already.  When you submit the form, the Graduate School will audit your file and Program of Study. <b>If you do not submit the form to the Graduate School, they will not let you hold your exam.</b> Here is a link to the scheduling form: <a href='http://oregonstate.edu/dept/grad_school/phpforms/event.php'>http://oregonstate.edu/dept/grad_school/phpforms/event.php</a>.</p>
			
			<p>If any changes have been made to your PhD Program of Study since you submitted it to the Graduate School, fill out the <a href='http://oregonstate.edu/dept/grad_school/Survival_Guide/Graduate_Forms/pfc.pdf'>Petition for Change of Program Form</a> and then get the required signatures.  I can help you get Dr. Bose's signature and submit the form to the Graduate School for you.</p>
			
			<p>After your major advisor approves your written thesis proposal, you will need to distribute copies to all committee members including your Graduate Council Representative (GCR) at least three weeks prior to your oral exam.  For more information on the PhD Oral Preliminary exam please see your major's advising guide found here: 
				<ul>
					<li>CS - <a href='http://eecs.oregonstate.edu/current-students/graduate/cs-program#model'>http://eecs.oregonstate.edu/current-students/graduate/cs-program#model</a></li>
					<li>ECE - <a href='http://eecs.oregonstate.edu/current-students/graduate/ece-program#model'>http://eecs.oregonstate.edu/current-students/graduate/ece-program#model</a></li>
				</ul>
			</p>
			
			<p>Please come to KEC 1148 to pick up the equipment you reserved and bring your student ID card.  The office is closed from 12:00pm-1:00pm so be sure and come before 12:00pm or after 1:00pm to check out or return your reserved equipment.  Your key card access opens the room.  Please be sure to turn the projector off at the end of your session.</p>
			
			<p>The GCR is responsible for bringing the exam paperwork to the exam.</p>
			
			<p><b>FYI - At least one complete academic term must elapse between the time of the preliminary oral examination and the final oral examination.</b></p>
			
			<p>Please let me know if you have any questions or need any additional information!</p>
			
			<p>Thank you,</p>
		";
		
		return $script;
	}
	
	function post_phd_qualifier($data) {
		$date = date("n/j/Y", strtotime($data['date']));
		$start_time = date('g:ia', strtotime($data['start_time']));
		$end_time = date('g:ia', strtotime($data['end_time']));
		
		$script = "
			<p>You are scheduled in ROOM on $date from ROOM_TIME. Your PhD Qualifying exam is from $start_time - $end_time so this will give you time to set up before your event. Please notify your committee of the date, time, and place.  I will send out an announcement about one week prior and it should also appear in our newsletter.  If you serve refreshments, please clean up afterwards. </p>
			
			<p><b>You do not need to send the event schedule form to the Graduate School for this event.</b></p>
			
			<p>Please come to KEC 1148 to pick up the equipment you reserved and bring your student ID card.  The office is closed from 12:00pm-1:00pm so be sure and come before 12:00pm or after 1:00pm to check out or return your reserved equipment.  Your key card access opens the room.  Please be sure to turn the projector off at the end of your session.</p>
			
			<p>If you are a CS student, please be sure to bring <b>one</b> copy of the PhD Qualifying Exam Evaluation Form to the exam that is already filled out with your committee members' name and affiliation.  This form should be returned to the EECS Graduate Coordinator to be added to your EECS file with the committee's final decision.  If you are an ECE student, please be sure to bring <b>five</b> copies of the PhD Qualifying Exam Evaluation Form to the exam that is already filled out with your committee members' name and affiliation.  One summary form should be returned to the EECS Graduate Coordinator to be added to your EECS file with the committee's final decision.</p>
			
			<p>CS and ECE now have different forms, so please choose the correct form from below:
				<ul>
					<li><a href='http://eecs.oregonstate.edu/sites/eecs.oregonstate.edu/files/forms/graduate/CS_PhD_Qualifying_Exam_Form.doc'>CS - Ph.D. Qualifying Exam Evaluation Form</a></li>
					<li><a href='http://eecs.oregonstate.edu/sites/eecs.oregonstate.edu/files/forms/graduate/ECE_PhD_Qualifying_Exam_Form.doc'>ECE - Ph.D. Qualifying Exam Evaluation Form </a></li>
				</ul>
			</p>
			
			<p>For more information on the PhD qualifying exam please see your major's advising guide found here:
				<ul>
					<li>CS - <a href='http://eecs.oregonstate.edu/current-students/graduate/cs-program#model'>http://eecs.oregonstate.edu/current-students/graduate/cs-program#model</a></li>
					<li>ECE - <a href='http://eecs.oregonstate.edu/current-students/graduate/ece-program#model'>http://eecs.oregonstate.edu/current-students/graduate/ece-program#model</a></li>
				</ul>
			</p>
			
			<p>Please let me know if you have any questions or need any additional information!</p>
			
			<p>Thank you,</p>
		";
		
		return $script;
	}
	
	function post_meng($data) {
		$date = date("n/j/Y", strtotime($data['date']));
		$start_time = date('g:ia', strtotime($data['start_time']));
		$end_time = date('g:ia', strtotime($data['end_time']));
		
		$script = "
			<p>You are scheduled in ROOM on $date from ROOM_TIME. Your MEng final exam is from $start_time - $end_time so this will give you time to set up before your event. Please notify your committee of the date, time, and place.  I will send out an announcement about one week prior and it should also appear in our newsletter.  If you serve refreshments, please clean up afterwards. </p>
			
			<p><b>For your exam, you will need to prepare a 15-20 minute PowerPoint presentation on a project you have worked on in one of your graduate classes here at OSU.  The other 15-20 minutes of your exam will be oral questions on your coursework.  Please bring a whiteboard marker with you for the coursework questions!</b></p>
			
			<p><b>You have already scheduled your event with EECS.</b> Now you'll need to schedule with the Graduate School no later than <b>two</b> weeks before your exam if you have not done so already.  Since you are a MEng student, you don't have to attach an abstract or provide a thesis title.  When you submit the form, the Graduate School will audit your file to make sure you have met the graduation requirements, and they will process a degree completion request. <b>If you do not submit the form to the Graduate School, they will not let you hold your exam.</b> Here is a link to the scheduling form: <a href='http://oregonstate.edu/dept/grad_school/phpforms/event.php'>http://oregonstate.edu/dept/grad_school/phpforms/event.php</a>. Your exam paperwork will be sent to your major advisor from the Graduate School.  Please remember to also submit your diploma application by logging into <a href='http://myosu.oregonstate.edu/'>MyOSU</a>, then click on \"Student Records\", and then click on \"Apply for Graduation\".</p>
			
			<p>Please come to KEC 1148 to pick up the equipment you reserved and bring your student ID card.  The office is closed from 12:00pm-1:00pm so be sure and come before 12:00pm or after 1:00pm to check out or return your reserved equipment.  Your key card access opens the room.  Please be sure to turn the projector off at the end of your session.</p>
			
			<p><b>Please remember to submit the Grad Exit Checklist to me before you leave OSU!</b> It can be found at: <a href='http://eecs.oregonstate.edu/current-students/graduate/forms/grad-exit-checklist'>http://eecs.oregonstate.edu/current-students/graduate/forms/grad-exit-checklist</a>.</p>
			
			<p>Please let me know if you have any questions or need any additional information!</p>
			
			<p>Thank you,</p>
		";
		
		return $script;
	}
	
	function post_program_meeting($data) {
		$date = date("n/j/Y", strtotime($data['date']));
		$start_time = date('g:ia', strtotime($data['start_time']));
		$end_time = date('g:ia', strtotime($data['end_time']));
		
		$script = "
			<p>You are scheduled in ROOM on $date from $start_time - $end_time for your PhD Program Meeting.  Please notify your committee of the date, time, and place.</p>
			
			<p>You do <b>not</b> need to submit the event schedule form to the Graduate School for this event. Your key card access opens the room.</p>
			
			<p>Please bring <b>five</b> copies of your completed PhD Program of Study form (the form can be found here <a href='http://gradschool.oregonstate.edu/forms#program'>http://gradschool.oregonstate.edu/forms#program</a>) to the meeting for your committee members. The form should be typed.  After you and your major advisor go over your completed program before your meeting, if you want to bring the typed form to me to look over for completeness, I would be happy to do that. Then you can print out your final copies for the meeting.</p>
			
			<p><b>You will also need to print the Doctoral Program Meeting Checklist (<a href='http://oregonstate.edu/dept/grad_school/forms/DocPrgMtgChcklist.doc'>Word</a>) (<a href='http://oregonstate.edu/dept/grad_school/forms/DocPrgMtgChcklist.pdf'>PDF</a>) and take it to your meeting. Your Graduate Council Representative (GCR) will complete and sign this form and return it to the Graduate School.</b></p>
			
			<p>After the program meeting, please submit the program meeting checklist (if your GCR has not already submitted it) and your signed PhD Program of Study to the EECS front desk and I will have Dr. Bose sign the program for you. After it is signed, I will send it to the Graduate School to be processed. The Graduate School will email an approved copy to you as soon as it has been approved.</p>
			
			<p>Thank you, </p>
		";
		
		return $script;
	}
	
	function getAnnouncement($data) {
		$date = date("l, F n, Y", strtotime($data['date']));
		$start_time = date('g:ia', strtotime($data['start_time']));
		$end_time = date('g:ia', strtotime($data['end_time']));
		$event_title = $data["event_title"];
		$degree = $data["formatted_degree"];
		$event = $data["event"];
		$name = $data["name"];
		$committee_names = $data["committee_members_name"];
		$committee_roles = $data["members_role"];
		$thesis_title = $data["thesis_title"];
		$thesis_abstract = $data["thesis_abstract"];
 		
		// Top part of announcement
		$announcement = "
		<div class='announcement'>
			<table>
				<tr><td>School of Electrical Engineering and Computer Science</td></tr>
				<tr><td>Oregon State University</td></tr>
			</table>
							
			<p>$degree $event_title &ndash; $name</p>
			
			<table>
				<tr><td>Date:</td><td>$date</td></tr>
				<tr><td>Time:</td><td>$start_time - $end_time</td></tr>
				<tr><td>Place:</td><td>ROOM</td></tr>
			</table>
		";
		
		// Committee
		$announcement .= "<table>";
		for ($i = 0; $i < sizeof($committee_names); $i++) {
			$name = ucwords($committee_names[$i]);
			$role = ucwords(str_replace('_', ' ', $committee_roles[$i]));
			if (!empty($name)) {
				$announcement .= "<tr><td>$role:</td><td>$name</td></tr>";
			}
		}
		$announcement .= "</table>";
		
		// Bottom part of announcement (Thesis)
		if ($event != "final_non_thesis") {
			$announcement .= "
				<p>Title: $thesis_title</p>
				
				<p>Abstract: $thesis_abstract</p>
			";
		}
		
		// close .announcement div
		$announcement .= "</div>";
		
		return $announcement;
	}
	
	function getFileTask($data) {
		$name = $data["name"];
		$major = strtoupper($data["major"]);
		$degree = $data["formatted_degree"];
		$event_title = $data["event_title"];
		$sid = $data["id"];
		
		// get major professor
		$committee_names = $data["committee_members_name"];
		$committee_roles = $data["members_role"];
		$i = 0;
		while ($committee_names[$i] != "") {
			if ($committee_roles[$i] == "major_advisor") {
				$major_prof = $committee_names[$i];
			}
			$i++;
		}
		
		return "File Task: $name &mdash; $major &mdash; $degree $event_title &mdash; $major_prof &mdash; $sid";
	}
	
	
	/****************************************************************************************************************
	 *	Name: getScripts()																							*
	 *	Input: $data array, this is the main array generated by the form the user fills out							*
	 *	Output: An updated $data array with all the old values in addition to an `event_title` and `script` field	*
	 **************************************************************************************************************/
	function getScripts($data) {
		switch ($data['event']) {
			case 'final_thesis': 
				// open final thesis
				$event_title = "Final Thesis";
				$script = post_final_thesis($data);
				break;
			case 'final_non_thesis':
				// open final non-thesis
				$event_title = "Final Non-Thesis";
				$script = post_final_non_thesis($data);
				break;
			case 'phd_prelim':
				// open phd prelim
				$event_title = "PhD Preliminary Oral Exam";
				$script = post_phd_prelim($data);
				break;
			case 'phd_qual':
				// open phd qualifier
				$event_title = "PhD Qualifying Exam";
				$script = post_phd_qualifier($data);
				break;
			case 'meng':
				// open meng
				$event_title = "MEng Final Exam";
				$script = post_meng($data);
				break;
			case 'program_meeting':
				// open program meeting
				$event_title = "PhD Program Meeting";
				$script = post_program_meeting($data);
				break;
			default: 
				// error handle
				$event_title = "None";
				$script = "No Event Selected!";
				break;
		}
		
		$data["event_title"] = $event_title;
		$data["script"] = $script;
		
		return $data;
	}
	
	function formatDegree($data) {

		$degree = $data["degree"];
		switch ($degree) {
			case "ms":
				$formattedDegree = "MS";
				break;
			case "meng":
				$formattedDegree = "MEng";
				break;
			case "phd":
				$formattedDegree = "PhD";
				break;
			default: 
				$formattedDegree = "";
				break;
		}
		
		$data["formatted_degree"] = $formattedDegree;
		
		return $data;
	}
	
?>