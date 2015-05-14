/*
|--------------------------------------------------------------------------
| Follow Button
|--------------------------------------------------------------------------
|
|
*/

// Follow & Unfollow User Ajax Button

$('[data-follows]').submit(function (e)
{
	e.preventDefault();

	var $form 	= $(this);
	var $formAction = $form.attr('action');
	var $formSubmit = $form.find('button[type=submit]');
	var $ovalue = $formSubmit.html();

	// Change button
	$formSubmit.html('<i class="fa fa-refresh fa-spin"></i> Loading');
	$formSubmit.attr('disabled','disabled');

	$.ajax({
		url: $form.attr('action'),
		type: "POST",
		data: $form.serialize(),
		dataType: "json"
	})
	.done(function(data)
	{
		resetForm();

		if(data.success == true)
		{
			$form.html(data.output);
		}
		else
		{
			alert('<p>There was an error. Please try again.</p>');
		}
	})
	.fail(function(data)
	{
		var response = JSON.parse(data);
		alert('There was an error, try again. ' + response);
		resetForm();
	});

	// Reset form function
	function resetForm()
	{
		$formSubmit.html($ovalue);
		$formSubmit.removeAttr('disabled');
	}
});