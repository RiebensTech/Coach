<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
function displayTable() {
	var e, n = document.getElementById("gender-select").value,
		a = document.getElementById("topic-select").value;
	n && a ? (n = ".size-chart-" + n + "-" + a, a = jQuery(".size-guide-topic-title"), e = jQuery(".size-chart-table-container"), jQuery(".size-chart-container").show(), a.find("h2").hide(), a.find("h2" + n).show(), e.find("div:not(" + n + ") table").parent().hide(), e.find("div" + n + " table").parent().show()) : alert("Select Category!")
}
function genderSelect() {
	jQuery("#topic-select").val(""), jQuery(".conversion-list-select").val("us"), "women" == document.getElementById("topic-select").value ? jQuery("#topic-jewelry, #topic-dress").show() : jQuery("#topic-jewelry, #topic-dress").hide()
}
function topicSelect() {
	jQuery(".conversion-list-select").val("us"), jQuery(".footwear-select").val("eu")
}

jQuery(document).ready(function(){
  jQuery("bdi").hover(displayContent(jQuery("bdi").hover.value));
});


function displayContent(display){
	for (let element of document.getElementsByClassName("contents")){
		element.style.display="none";
	}
	var x = document.getElementById(display);
	if (x != null){
			x.style.display = "block";
	}
}
</script>
<!-- end Simple Custom CSS and JS -->
