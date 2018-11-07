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
	if (eventSelector.val() == "meng") {
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
		
		// add co-advisor
		let coAdvisor = addCommitteeMember("co_advisor", true);
		majorAdvisorWrapper.before(coAdvisor);
		
		// remove committee member
		$(".committee").first().remove();
	} else {
		// co-advisor was set to the first, so remove it
		$(".committee_wrapper").first().remove();
		currentMembersCount--;
		
		// add committee member back
		addCommitteeMember("committee");
	}
	
	majorAdvisorWrapper.children(".member").text(title);
	majorAdvisorWrapper.children(".hidden_role").val(role);
}

// adds minor advisor below major advisor
function switchMinorAdvisor() {
	let majorAdvisorWrapper = $(".committee_wrapper#1");
	let check = $("#minorAdvisorCheckbox");
	
	if (check.is(":checked")) {
		let minorAdvisor = addCommitteeMember("minor_advisor", true, true);
		majorAdvisorWrapper.after(minorAdvisor);
	} else {
		// remove minor_advisor class 
		$(".minor_advisor").remove();
		currentMembersCount--;
	}
}