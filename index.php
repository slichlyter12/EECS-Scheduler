<?php
	
	session_start();

// 	CONFIG:
	$MAX_COMMITTEE_MEMBERS = 6;	
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>EECS Scheduler</title>
		<link rel="stylesheet" type="text/css" href="main.css">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
	</head>
	<body>
		<h1 class="title">EECS Student Scheduler</h1>
		<form method="post" action="action.php">
			<fieldset class="formGroup" id="event_information">
				<legend>Event Information:</legend>
				<p>Degree: 
					<select name="degree">
						<option value="ms">MS</option>
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
					<select name="event">
						<option value="default">---- Select Event Type ----</option>
						<option value="final_thesis">Final Exam - Thesis</option>
						<option value="final_non_thesis">Final Exam - Non Thesis</option>
						<option value="phd_prelim">PhD Oral Preliminary Exam</option>
						<option value="phd_qual">PhD Qualifying Exam</option>
						<option value="meng">MEng Final Exam</option>
						<option value="program_meeting">PhD Program Meeting</option>
					</select>
				</p>
				<p>Date: <input type="date" name="date"></p>
				<p>Start Time: <input type="time" name="start_time"></p>
				<p>End Time: <input type="time" name="end_time"></p>
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
				<p>Name: <input type="text" placeholder="First Last" name="name"></p>
				<p>ID: <input type="number" name="id"></p>
				<p>Email: <input type="email" name="email"></p>
			</fieldset>
			<fieldset class="formGroup" id="thesis_information">
				<legend>Thesis Information:</legend>
				<p>Title: <input type="text" name="thesis_title"></p>
				<p>Abstract: <textarea name="thesis_abstract"></textarea></p>
			</fieldset>
			<fieldset class="formGroup" id="committee_members">
				<legend>Committee Members:</legend>
				<?php
					for($i = 1; $i < $MAX_COMMITTEE_MEMBERS + 1; $i++) {
						echo "
							<p class='member'>-- Member $i --</p>
							<p>Name: <input type='text' name='committee_members_name[]' placeholder='First Last'></p>
							<p>
								Role:
								<select name='members_role[]'>
									<option value='committee'>Committee</option>
									<option value='major_advisor'>Major-Advisor</option>
								</select>
							</p>
							<p>School/Department: <input type='text' name='committee_members_school[]' placeholder='EECS'></p>
							<hr>
						";
					}	
				?>
			</fieldset>
			<input type="submit" name="submit" value="Submit">
		</form>
		<script>
			let msEvents = ["default", "final_thesis", "final_non_thesis", "meng"];
			let phdEvents = ["default", "final_thesis", "final_non_thesis", "phd_prelim", "phd_qual", "program_meeting"];
			
			let degreeSelector = $("select[name='degree']");
			degreeSelector.on("change", function() {
				updateEvents();
			});
			updateEvents();
			
			let eventSelector = $("select[name='event']");
			eventSelector.on("change", function() {
				checkThesis();
			});
			
			function updateEvents() {
				let eventSelector = $("select[name='event'] option");
				let degree = degreeSelector.find(":selected").val();
				
				// Set all to disabled
				eventSelector.each(function() {
					$(this).attr("disabled", true);
				});
					
				// Enable all per degree		
				if (degree == "ms") {
					enableSelectorFromList(eventSelector, msEvents);
				} else {
					enableSelectorFromList(eventSelector, phdEvents);				
				}
				
				checkThesis();
			}
			
			function enableSelectorFromList(selector, list) {
				selector.each(function() {
					if (list.includes($(this).val())) {
						$(this).attr("disabled", false);
					}
				});
			}
			
			function checkThesis() {
				let eventSelector = $("select[name='event'] option:selected");
				if (eventSelector.val() == "final_non_thesis") {
					let thesis_fieldset = $("fieldset#thesis_information");
					thesis_fieldset.addClass("disabled");
					thesis_fieldset.find("input").val("N/A");
					thesis_fieldset.find("textarea").val("N/A");
					console.log(thesis_fieldset.find("input").val("N/A"));
				}
			}
		</script>
	</body>
</html>
