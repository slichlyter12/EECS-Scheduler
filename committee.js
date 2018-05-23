/************************************************************************************
 * addCommitteeMember()																*
 * Input: 	role_title:string (default, major_advisor, co_advisor, gcr, committee) 	*
 *			createOnly:bool															*
 * Output: 	appends committee member to list of members (#committeeMembers) 		*
 *				OR 																	*
 *			returns created committee member										*
 ************************************************************************************/
function addCommitteeMember(role_title = 'default', createOnly = false) {
		
	//increment counter
	currentMembersCount++;
	
	// grab fieldset handle
	let fieldset = document.getElementById("committee_members");
	
	// create wrapper
	let committee_wrapper = document.createElement("div");
	committee_wrapper.setAttribute("class", "committee_wrapper " + role_title);
	committee_wrapper.setAttribute("id", currentMembersCount);
	
	// CREATE COMMITTEE MEMBERS FORM:
	// name
	let name = makeName(role_title);
	committee_wrapper.appendChild(name);
	
	// co-major advisor checkbox
	if (role_title == "major_advisor") {
		let coAdvisorCheck = makeCoAdvisorCheck();
		committee_wrapper.appendChild(coAdvisorCheck);
		
		// add event handler to show co-advisor
		coAdvisorCheck.addEventListener("change", function (event) {
			switchCoAdvisor();
		});
	} 
	
	// name input
	let nameInput = makeNameInput();
	committee_wrapper.appendChild(nameInput);
	
	// role input
	if (role_title == 'default') {
		let role = makeRole();
		committee_wrapper.appendChild(role);
	} else {
		let role = makeHiddenRole(role_title);
		committee_wrapper.appendChild(role);
	}
	
	// school department input
	let schoolDepartment = makeSchoolDepartment();
	committee_wrapper.appendChild(schoolDepartment);
	
	// return wrapper or append wrapper to fieldset
	if (createOnly) {
		return committee_wrapper;
	} else {
		// append hr and wrapper to form
		committee_wrapper.appendChild(document.createElement("hr"));
		
		// append to list of committee members
		fieldset.appendChild(committee_wrapper);
	}
}

// make title above member input
function makeName(role) {
	let title = getTitle(role);
	if (role == "default") { role = "Committee"; }
	let member = document.createElement("p");
	member.setAttribute("style", "font-weight: bold");
	let memberText = document.createTextNode(title);
	member.setAttribute("class", "member");
	member.appendChild(memberText);
	
	return member;
}

// make Name text input
function makeNameInput() {
	let name = document.createElement("p");
	name.setAttribute("class", "name_input");
	let nameText = document.createTextNode("Name: ");
	let nameInput = document.createElement("input");
	nameInput.setAttribute("type", "text");
	nameInput.setAttribute("name", "committee_members_name[]");
	nameInput.setAttribute("placeholder", "First Last");
	name.appendChild(nameText);
	name.appendChild(nameInput);
	
	return name;
}

// make co-advisor check box
function makeCoAdvisorCheck() {
	let wrapper = document.createElement("p");
	let checkbox = document.createElement("input");
	checkbox.setAttribute("type", "checkbox");
	checkbox.setAttribute("value", "coadvisor");
	checkbox.setAttribute("id", "coAdvisorCheckbox");
	let text = document.createTextNode(" I have co-major advisors");
	wrapper.appendChild(checkbox);
	wrapper.appendChild(text);
	
	return wrapper;
}

// Makes Role selection input
function makeRole() {
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
	
	return role;
}

function makeHiddenRole(value) {
	let role = document.createElement("input");
	role.setAttribute("class", "hidden_role");
	role.setAttribute("type", "hidden");
	role.setAttribute("name", "members_role[]");
	role.setAttribute("value", value);
	
	return role;
}

// Makes School Department text input
function makeSchoolDepartment() {
	let schoolDepartment = document.createElement("p");
	let schoolDepartmentText = document.createTextNode("School Department: ");
	let schoolDepartmentInput = document.createElement("input");
	schoolDepartmentInput.setAttribute("type", "text");
	schoolDepartmentInput.setAttribute("name", "committee_members_school[]");
	schoolDepartment.appendChild(schoolDepartmentText);
	schoolDepartment.appendChild(schoolDepartmentInput);
	
	return schoolDepartment;
}

/********************************************************************
*	Function: getTitle()											*
*	Input: value from role selector									*
*	Output: human readable string representative of value			*
*********************************************************************/
function getTitle(value) {
	var formalized = "";
	switch (value) {
		case 'major_advisor': formalized = "Major Advisor"; break;
		case 'co_advisor': formalized = "Co-Major Advisor"; break;
		case 'gcr': formalized = "GCR"; break;
		case 'committee': 
		default: formalized = "Committee";
	}
	
	return formalized;
}

function showCommitteeMembers(event) {
	event = event[0].value;
	let members = (numCommitteeMembers[event] ? numCommitteeMembers[event] : 0);
	let gcr = (numGCR[event] ? numGCR[event] : 0);
	
	// clear committee members note
	let note = $("#committee_note");
	if (event != "default" && (note != undefined || note != null)) {
		note.remove();
	}
	
	// clear old committees and reset counter
	let old_committee = $(".committee_wrapper");
	old_committee.remove();
	currentMembersCount = 0;
	
	// ADD NEW COMMITTEE MEMBERS
	// add major advisor if other fields exist
	if (members + gcr > 0) {
		addCommitteeMember("major_advisor");
	}
	// add general committee members (subtract one for major advisor)
	if (members > 0) {
		members--;
	}
	for (var i = 0; i < members; i++) {
		addCommitteeMember("committee");
	}
	// add GCR members
	for (var i = 0; i < gcr; i++) {
		addCommitteeMember("gcr");
	}
}