<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
let storeValue = ".all";
let serverValue = ".all";
jQuery(".store-type").change(function(e) {
	var $this = jQuery(this);
	var inputValue = $this.val();	
	jQuery(".stores").hide();
	if ($this.prop("checked")) {
		storeValue += ", ."+inputValue;
	}
	else{
		storeValue= storeValue.replace(", ."+inputValue, "");
	}
	toggleStoreType();
}
							);
function toggleStoreType(){
	if (storeValue == ".all"){
		jQuery(".stores").show();
	}else{
		jQuery(storeValue).show();
	}
}

jQuery(".store-service").change(function(e) {
	var $this = jQuery(this);
	var inputValue = $this.val();	
	jQuery(".store-services").hide();
	if ($this.prop("checked")) {
		serverValue += ", ."+inputValue;
	}
	else{
		serverValue= serverValue.replace(", ."+inputValue, "");
	}
	toggleServiceType();
}
								);
								
function toggleServiceType(){
	if (serverValue == ".all"){
		jQuery(".store-services").show();
	}else{
		jQuery(serverValue).show();
	}
}</script>
<!-- end Simple Custom CSS and JS -->
