<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", (event) => {
	for (let element of document.getElementsByClassName("maindropdown")){
		element.addEventListener(
		"mouseenter",
		(event) => {
			let selection = element.getAttribute("data-selection");
			displayContent(selection)
		}
		,
		false,
	);
	}
}
						 );
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
