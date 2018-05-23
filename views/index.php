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
		<form id="scheduler_form" method="post" action="../action.php">
			<div id="event_student">
				<fieldset class="formGroup" id="event_information">
					<legend>Event Information:</legend>
					<p>Degree: 
						<select name="degree">
							<option value="ms">MS</option>
							<option value="meng">MEng</option>
							<option value="phd" selected>PhD</option>
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
					<p>Email: <input type="email" name="email" required></p>
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
<script>
	
	// validate form (make sure id is only 9 characters long)
	$("#scheduler_form").validate({
		rules: {
			id: {
				rangelength: [9, 9]
			}
		},
		messages: {
			id: "Please enter a number 9 characters long"
		}
	});
	
	// define events for each major and initialize members count for ids
	let msEvents 	= ["", "final_thesis", "final_non_thesis"];
	let mengEvents 	= ["", "meng"];
	let phdEvents 	= ["", "final_thesis", "phd_prelim", "phd_qual", "program_meeting"];
	var currentMembersCount = 0;
	
	// set number of committee members and GCRs for each event
	let numCommitteeMembers = {
			"phd_qual": 4,
			"meng": 3,
			"final_non_thesis": 3,
			"final_thesis": 4,
			"phd_prelim": 5,
			"": 0
		};
	let numGCR = {
			"final_thesis": 1,
			"phd_prelim": 1,
			"": 0
		};
		
	// add event handler to add committee mumber button
	let add_member_button = document.getElementById("add_member_button");
	add_member_button.addEventListener('click', function (event) {
		addCommitteeMember();
	});
	
	// when the degree dropdown has changed, update the events dropdown
	let degreeSelector = $("select[name='degree']");
	degreeSelector.on("change", function() {
		updateEvents();
	});
	updateEvents();
	
	// when the event dropdown has changed, check if thesis is selected
	let eventSelector = $("select[name='event']");
	eventSelector.on("change", function() {
		// check if thesis input is needed for this event
		checkThesis();
		
		// get selected event and show committee members needed for this event
		let eventSelected = $("select[name='event'] option:selected");
		showCommitteeMembers(eventSelected);
	});
	
	// update events based on degree selected
	function updateEvents() {
		let eventSelector = $("select[name='event'] option");
		let degree = degreeSelector.find(":selected").val();
		
		// Set all to disabled
		eventSelector.each(function() {
			$(this).attr("disabled", true);
		});
			
		// Enable events per degree				
		switch (degree) {
			case "ms": enableSelectorFromList(eventSelector, msEvents); break;
			case "meng": enableSelectorFromList(eventSelector, mengEvents); break;
			case "phd":
			default: enableSelectorFromList(eventSelector, phdEvents); 
		}
		
		// check if thesis input should be displayed
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
	
	// Disables thesis if the non-thesis option is selected and updates committee members
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
	
	// Checks if co-advisor checkbox is checked, if so display other co-advisor, else show major advisor
	function switchCoAdvisor() {
		let majorAdvisorWrapper = $(".committee_wrapper#1");
		let check = $("#coAdvisorCheckbox");
		
		// set values for change
		var title = "Major Advisor";
		var role = "major_advisor";
		if (check.is(":checked")) {
			title = "Co-Major Advisor"
			role = "co_advisor";
			let coAdvisor = addCommitteeMember("co_advisor", true);
			majorAdvisorWrapper.before(coAdvisor);
		} else {
			// co-advisor was set to the first, so remove it
			$(".committee_wrapper").first().remove();
			currentMembersCount--;
		}
		
		majorAdvisorWrapper.children(".member").text(title);
		majorAdvisorWrapper.children(".hidden_role").val(role);
	}
</script>

<?php include_once("addon_menu.php"); ?>
<?php include_once("../../libs2/audience_menu.php"); ?>
<?php include_once("../../libs2/foot.php"); ?>

