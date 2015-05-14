<script>
var frameId = "page-loader";
var popupLoaded = false;
function pageLoader(){
	jQuery("#overlay").show();
	jQuery("#"+frameId+"-loaderDiv").fadeOut(2500);
	jQuery("#popup").show();
	jQuery("#"+frameId+"-frame").fadeIn({animate:01500});
	popupLoaded = true;
}
</script>