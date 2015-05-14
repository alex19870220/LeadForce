/*
|--------------------------------------------------------------------------
| Forms - Async
|--------------------------------------------------------------------------
|
|
*/
$(function() {

	// Attach a submit handler to the form
	$('form[data-async]').submit(function(e) {
		e.preventDefault();

		var $form = $(this);
		var $formAction = $form.attr('action');
		var $formSubmit = $form.find('button[type=submit]');
		var $formType = $form.data('type');
		var $ovalue = $formSubmit.html();

		// Replace the button with the loading gif
		$formSubmit.html('<i class="fa fa-refresh fa-spin"></i> Please Wait...');
		// Disable the button
		$formSubmit.attr('disabled','disabled');

		// Ajax magic (c)
		$.ajax({
			url: $formAction,
			type: "POST",
			data: $form.serialize(),
			dataType: "json"
		})
		.done(function(data)
		{
			// var response = JSON.parse(data.responseText);
			if(data.success === true)
			{
				$form.html(data.message);
			}
			else
			{
				alert('<p>There was an error. Please try again.</p>');
				resetForm();
			}
		})
		.fail(function(data) {
			var response = JSON.parse(data.responseText);
			var errorString = '';
			$.each(response.errors, function(key, value) {
				errorString += value + '\n';
			});
			alert(errorString);
			resetForm();
		});


		// Reset form function
		function resetForm()
		{
			$formSubmit.html($ovalue);
			$formSubmit.removeAttr('disabled');
		}
	});

});