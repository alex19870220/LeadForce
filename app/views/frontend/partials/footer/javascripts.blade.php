<script type="text/javascript" src="{{ $project->present()->templateDirectory() }}/assets/js/application.js"></script>
<script type="text/javascript" src="/templates/assets/js/scripts.js"></script>

@if($project->getOption('monetization.type') == 'emailoptin' && $project->getOption('monetization.email_optin.design.exit_intent.enabled') === true)
<script type="text/javascript" src="/assets/js/ouibounce/ouibounce.min.js"></script>
<link rel="stylesheet" href="/assets/js/ouibounce/ouibounce.min.css">
<script type="text/javascript">
	// ouibounce(document.getElementById('ouibounce-modal'));
	ouibounce(document.getElementById('ouibounce-modal'), {
		aggressive: false,
		sitewide: true,
		timer: 0,
		cookieExpire: 1
	});

	$('body').on('click', function() {
		$('#ouibounce-modal').hide();
	});

	$('#ouibounce-modal .ouibounce-modal-footer').on('click', function() {
		$('#ouibounce-modal').hide();
	});

	$('#ouibounce-modal .modal').on('click', function(e) {
		e.stopPropagation();
	});
	</script>
@endif