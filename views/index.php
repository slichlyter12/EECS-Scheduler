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
		<form method="post" action="../action.php">
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
				<h4 id="committee_note">Note: Select Event Above</h4>
<!-- 				<input type="button" id="add_member_button" value="add_1">Add Committee Member</button> -->
			</fieldset>
			<input type="submit" name="submit" value="Submit">
		</form>
	</div>
</div>
<script>
	let msEvents 	= ["default", "final_thesis", "final_non_thesis"];
	let mengEvents 	= ["default", "meng"];
	let phdEvents 	= ["default", "final_thesis", "phd_prelim", "phd_qual", "program_meeting"];
	var currentMembersCount = 0;
	
	let numCommitteeMembers = {
			"phd_qual": 4,
			"meng": 3,
			"final_non_thesis": 3,
			"final_thesis": 4,
			"phd_prelim": 5,
			"default": 0
		};
	let numGCR = {
			"final_thesis": 1,
			"phd_prelim": 1,
			"default": 0
		};
		
// 	let addMemberButton = document.getElementById("add_member_button");
// 	addMemberButton.addEventListener("click", addButtonClicked());
	
	function addButtonClicked() {
		if (addMemberButton.value === "add_1") {
			addCommitteeMember();
		}
	}
		
	function addCommitteeMember() {
			
		//increment counter
		currentMembersCount++;
		
		// grab fieldset handle
		let fieldset = document.getElementById("committee_members");
		
		// CREATE COMMITTEE MEMBERS FORM:
		// name
		let member = document.createElement("p");
		let memberText = document.createTextNode("-- Member " + currentMembersCount + " --");
		member.setAttribute("class", "member");
		member.setAttribute("id", currentMembersCount);
		member.appendChild(memberText);
		
		// name input
		let name = document.createElement("p");
		let nameText = document.createTextNode("Name: ");
		let nameInput = document.createElement("input");
		nameInput.setAttribute("type", "text");
		nameInput.setAttribute("name", "committee_members_name[]");
		nameInput.setAttribute("placeholder", "First Last");
		name.appendChild(nameText);
		name.appendChild(nameInput);
		
		// role input
		let role = document.createElement("p");
		let roleText = document.createTextNode("Role: ");
		let roleSelect = document.createElement("select");
		roleSelect.setAttribute("name", "members_role[]");
		let committeeOption = document.createElement("option");
		committeeOption.text = "Committee";
		committeeOption.setAttribute("value", "committee");
		roleSelect.appendChild(committeeOption);
		let majorAdvisorOption = document.createElement("option");
		majorAdvisorOption.text = "Major Advisor";
		majorAdvisorOption.setAttribute("value", "major_advisor");
		roleSelect.appendChild(majorAdvisorOption);
		let coAdvisorOption = document.createElement("option");
		coAdvisorOption.text = "Co-Major Advisor";
		coAdvisorOption.setAttribute("value", "co_advisor");
		roleSelect.appendChild(coAdvisorOption);
		let gcrOption = document.createElement("option");
		gcrOption.text = "GCR";
		gcrOption.setAttribute("value", "gcr");
		roleSelect.appendChild(gcrOption);
		role.appendChild(roleText);
		role.appendChild(roleSelect);
		
		// school department input
		let schoolDepartment = document.createElement("p");
		let schoolDepartmentText = document.createTextNode("School Department: ");
		let schoolDepartmentInput = document.createElement("input");
		schoolDepartmentInput.setAttribute("type", "text");
		schoolDepartmentInput.setAttribute("name", "committee_members_school[]");
		schoolDepartmentInput.setAttribute("placeholder", "EECS");
		schoolDepartment.appendChild(schoolDepartmentText);
		schoolDepartment.appendChild(schoolDepartmentInput);
		
		// create wrapper
		let committee_wrapper = document.createElement("div");
		committee_wrapper.setAttribute("class", "committee_wrapper");
			
		// append committee members
		committee_wrapper.appendChild(member);
		committee_wrapper.appendChild(name);
		committee_wrapper.appendChild(role);
		committee_wrapper.appendChild(schoolDepartment);
		committee_wrapper.appendChild(document.createElement("hr"));
		fieldset.appendChild(committee_wrapper);
	}
		
	function showCommitteeMembers(event) {
		event = event[0].value;
		let members = (numCommitteeMembers[event] ? numCommitteeMembers[event] : 0);
		let gcr = (numGCR[event] ? numGCR[event] : 0);
		let total = members + gcr;
		
		console.log(total);
		console.log(gcr);
		
		// clear committee members
		if (event != "default") {
			let note = $("#committee_note");
			note.remove();
		}
		
		// clear old committees and reset counter
		let old_committee = $(".committee_wrapper");
		old_committee.remove();
		currentMembersCount = 0;
		
		// add new committee members
		for (var i = 0; i < total; i++) {
			addCommitteeMember();
		}
	}
	
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
		
		showCommitteeMembers(eventSelector);
	}
</script>

<?php include_once("addon_menu.php"); ?>
<?php include_once("../../libs2/audience_menu.php"); ?>
<?php include_once("../../libs2/foot.php"); ?>

