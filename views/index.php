<?php
	
	session_start();

// 	CONFIG:
	$MAX_COMMITTEE_MEMBERS = 6;	
	
	$page_title = "Student Scheduler";
	include("../../libs2/head.php");
	
?>
<h1 class="title">EECS Student Scheduler</h1>
<div class="test">
	<div class="testing">
		<form method="post" action="action.php">
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
			</div>
			<fieldset class="formGroup" id="thesis_information">
				<legend>Thesis Information:</legend>
				<p id="thesis_title">Title: <input type="text" name="thesis_title"></p>
				<p>Abstract: <textarea name="thesis_abstract"></textarea></p>
				<p id="resize_note">Note: The abstract box is resizable by clicking and dragging the bottom-right corner &uarr;</p>
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
									<option value='co_advisor'>Co-Major Advisor</option>
									<option value='gcr'>GCR</option>
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
	</div>
</div>
<script>
	let msEvents = ["default", "final_thesis", "final_non_thesis"];
	let mengEvents = ["default", "meng"];
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
			
		// Enable events per degree		
		if (degree == "ms") {
			enableSelectorFromList(eventSelector, msEvents);
		} else if (degree == "meng") {
			enableSelectorFromList(eventSelector, mengEvents);
		} else {
			enableSelectorFromList(eventSelector, phdEvents);				
		}
		
		checkThesis();
	}
	
	// Enables `selector` items in the `list`
	function enableSelectorFromList(selector, list) {
		selector.each(function() {
			if (list.includes($(this).val())) {
				$(this).attr("disabled", false);
			}
		});
	}
	
	// Disables thesis if the non-thesis option is selected
	function checkThesis() {
		let eventSelector = $("select[name='event'] option:selected");
		let thesis_fieldset = $("fieldset#thesis_information");
		if (eventSelector.val() == "final_non_thesis") {
			thesis_fieldset.addClass("disabled");
			thesis_fieldset.find("input").val("N/A");
			thesis_fieldset.find("textarea").val("N/A");
		} else {
			thesis_fieldset.removeClass("disabled");
			if (thesis_fieldset.find("input").val() == "N/A") {
				thesis_fieldset.find("input").val("");
				thesis_fieldset.find("textarea").val("");
			}
		}
	}
</script>

<?php include_once("addon_menu.php"); ?>
<?php include_once("../../libs2/audience_menu.php"); ?>
<?php include_once("../../libs2/foot.php"); ?>

