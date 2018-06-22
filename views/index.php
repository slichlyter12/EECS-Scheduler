<?php
	
	session_start();
	
	$page_title = "Student Scheduler";
	include("../../libs2/head.php");
	
?>
<h1 class="title">EECS Student Scheduler</h1>
<div class="test">
	<div class="testing">
		<form id="scheduler_form" method="post" action="confirmation.php">
			<div id="event_student">
				<fieldset class="formGroup" id="event_information">
					<legend>Event Information:</legend>
					<p>Degree: 
						<select name="degree">
							<option value="ms">MS</option>
							<option value="meng">MEng</option>
							<option value="phd">PhD</option>
						</select>
					</p>
					<p>Major: 
						<select name="major">
							<option value="cs">CS</option>
							<option value="ece">ECE</option>
						</select>
					</p>
					<p>
						Event to Schedule: 
						<select name="event" required>
							<option value="">---- Select Event Type ----</option>
							<option value="final_thesis">Final Exam - Thesis</option>
							<option value="final_non_thesis">Final Exam - Non Thesis</option>
							<option value="phd_prelim">PhD Oral Preliminary Exam</option>
							<option value="phd_qual">PhD Qualifying Exam</option>
							<option value="meng">MEng Final Exam</option>
							<option value="program_meeting">PhD Program Meeting</option>
						</select>
					</p>
					<p>Date: <input type="date" name="date" required></p>
					<p class="important_note"><b>Note:</b> Enter exact exam time, setup time will be added later if applicable</p>
					<p>Start Time: <input type="time" name="start_time" required></p>
					<p>End Time: <input type="time" name="end_time" required></p>
					<p id="equipment">
						Equipment Needed: <br>
						<div class="equipment"><input type="checkbox" name="equipment[]" value="laptop">Laptop</div>
						<div class="equipment"><input type="checkbox" name="equipment[]" value="projector">Projector</div>
						<div class="equipment"><input type="checkbox" name="equipment[]" value="laser-pointer">Laser Pointer</div>
					</p>
					<p id="equipment_description"></p>
				</fieldset>
				<fieldset class="formGroup" id="student_information">
					<legend>Student Information:</legend>
					<p>Name: <input type="text" placeholder="First Last" name="name" required></p>
					<p>ID #: <input type="number" name="id" required></p>
					<p>OSU Email: <input type="email" name="email" required></p>
				</fieldset>
			</div>
			<fieldset class="formGroup" id="thesis_information">
				<legend>Thesis Information:</legend>
				<p id="thesis_title">Title: <input type="text" name="thesis_title"></p>
				<p>Abstract: <textarea name="thesis_abstract"></textarea></p>
				<p class="note">Note: The abstract box is resizable by clicking and dragging the bottom-right corner &uarr;</p>
			</fieldset>
			<fieldset class="formGroup" id="committee_members">
				<legend>Committee Members:</legend>
				<h4 id="committee_note">Note: Select Event Above</h4>
			</fieldset>
			<button id="add_member_button" type="button">Add Committee Member</button>
			<input id="event_submit" type="submit" name="submit" value="Submit">
		</form>
	</div>
</div>
<script type="text/javascript" src="../committee.js"></script>
<script type="text/javascript" src="../controller.js"></script>

<?php include_once("addon_menu.php"); ?>
<?php include_once("../../libs2/audience_menu.php"); ?>
<?php include_once("../../libs2/foot.php"); ?>

