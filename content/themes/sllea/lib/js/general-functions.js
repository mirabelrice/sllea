window.onload = function() {
	var textExpandableDiv = document.getElementsByClassName("text expandable");
	var numSections = textExpandableDiv.length;

	for(i = 0; i < numSections; i++) {
		var textContainer = textExpandableDiv[i].getElementsByClassName("text-wrap");
		var containerHeight = textContainer[0].clientHeight;
		var text = textContainer[0].getElementsByTagName("p");
		textHeight = text[0].clientHeight;
		if(textHeight > containerHeight) {
			textExpandableDiv[i].getElementsByClassName("overflow-link")[0].style.visibility = "visible";
		}
	}
}
