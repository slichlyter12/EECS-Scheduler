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
			<fieldset class="formGroup">
				<legend>Event Information:</legend>
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
				<p>Room: <input type="text" name="room"></p>
				<p>Date: <input type="date" name="date"></p>
				<p>Start Time: <input type="time" name="start_time"></p>
				<p>End Time: <input type="time" name="end_time"></p>
				<p id="equipment">
					Equipment Needed: <br>
					<div class="equipment"><input type="checkbox" name="equipment[]" value="laptop" data-description="Intel i7 processor, 16GB RAM, 120GB SSD">Laptop</div>
					<div class="equipment"><input type="checkbox" name="equipment[]" value="projector" data-description="A big one">Projector</div>
					<div class="equipment"><input type="checkbox" name="equipment[]" value="laser-pointer" data-description="A green one">Laser Pointer</div>
				</p>
				<p id="equipment_description"></p>
			</fieldset>
			<fieldset class="formGroup">
				<legend>Student Information:</legend>
				<p>Name: <input type="text" placeholder="First Last" name="name"></p>
				<p>ID: <input type="number" name="id"></p>
				<p>Email: <input type="email" name="email"></p>
			</fieldset>
			<fieldset class="formGroup">
				<legend>Thesis Information:</legend>
				<p>Title: <input type="text" name="thesis_title"></p>
				<p>Abstract: <textarea name="thesis_abstract"></textarea></p>
			</fieldset>
			<fieldset class="formGroup">
				<legend>Committee Members:</legend>
				<?php
					for($i = 1; $i < $MAX_COMMITTEE_MEMBERS + 1; $i++) {
						echo "
							<p class='member'>-- Member $i --</p>
							<p>Name: <input type='text' name='committee_members_name[]' placeholder='First Last'></p>
							<p>Email: <input type='email' name='committee_email[]' placeholder='onid@oregonstate.edu'></p>
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
	</body>
	<script>
		$(".equipment").click(function() {
			var equipment_descriptions = "";
			var checked = $(".equipment input:checked");
			for (var i = 0; i < checked.length; i++) {
				if (i > 0) {
					equipment_descriptions += ", "
				}
				equipment_descriptions += $(checked[i]).data("description");
			}
			$("#equipment_description").text(equipment_descriptions);
		});
	</script>
</html>
