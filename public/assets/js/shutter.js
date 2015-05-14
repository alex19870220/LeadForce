/*
|--------------------------------------------------------------------------
| Plugins
|--------------------------------------------------------------------------
|
|
*/

$('.tokenfield').tokenfield();
$('.selectpicker').selectpicker();

/*
|--------------------------------------------------------------------------
| BootBox
|--------------------------------------------------------------------------
|
|
*/

$(function() {
	$(document).on("click", "a[data-confirm]", function(e) {
		e.preventDefault();
		// Get link data
		var item   = $(this);
		var prompt = $(item).data("prompt");
		// Default prompt
		if(prompt == null){
			var prompt = 'Are you sure you want to do this?';
		}
		bootbox.confirm(prompt, function(result) {
			if(result) {
				// Go to the intended URL
				window.location.href = $(item).attr('href');
			}
		});
	});
});

/*
|--------------------------------------------------------------------------
| Sortable - Widgets
|--------------------------------------------------------------------------
|
|
*/

$(function() {

	$(".sortable").sortable("refresh");

	var $widgetList = [];
	var $widgetUlList = $('ul.widgetList');

	// Bind update Widget order value on change
	$widgetUlList.bind('sortupdate', function(event, ui)
	{
		updateWidgetSortable();
	});

	// function Rebind() {
	// 	$widgetUlList.updateWidgetSortable();
	// }

	// Enable/Update Sortable
	function updateWidgetSortable()
	{
		$widgetUlList.sortable({
			opacity: 0.8,
			cursor: 'move'
		});

		// Grab all list items
		var $todoItemLi = $('ul.widgetList li');
		$widgetList.length = 0;
		var orderNum	 = 1;

		// Iterate over each list item
		$todoItemLi.each(function() {
			var id = $(this).data('id');
			$widgetList.push(id);
			$(this).find('span.widget-order').text(orderNum);
			orderNum = orderNum + 1;
		});
		// Create comma separated list of ID's
		$widgetList.join(',');
		$widgetUlList.next('.widget-ids').val($widgetList);
	}

	// Initialize
	updateWidgetSortable();

	// Remove widget
	$widgetUlList.on('click', 'a.widget-remove', function ()
	{
		$(this).closest('.widget-block').remove();
		updateWidgetSortable();
	});

	// Remove widget
	// $('a.widget-remove').click(function(e) {
	// 	e.preventDefault();
	// 	// var $widgetLi = $(this).closest('li');
	// 	// $widgetLi.remove();
	// 	$(this).parent('.widget-block').remove();
	// 	updateWidgetSortable();
	// });

	// Add widget
	$('.widget-add').submit(function (e)
	{
		e.preventDefault();
		var $addWidgetForm 	= $(this);
		// Send Ajax quest
		$.ajax({
			type: $addWidgetForm.attr('method'),
			url: $addWidgetForm.attr('action'),
			data: $addWidgetForm.serialize(),
			success: function (data) {
				// Append the returned Widget to the list
				$widgetUlList.append(data);
				updateWidgetSortable();
			}
		});
	});
});

/*
|--------------------------------------------------------------------------
| Ajax - Dynamic Data Grabber
|--------------------------------------------------------------------------
|
|
*/

// Watch for form submit
$('form[data-ajax-submit]').submit(function(e)
{
	e.preventDefault();

	var $form = $(this);
	var $formAction = $form.attr('action');
	var $formSubmit = $form.find('button[type=submit]');
	var $ovalue = $formSubmit.html();
	var $dataOutputTarget = $form.data('ajax-output');
	// var $dataOutputDiv = $('#' + $dataOutputTarget);

	// Change button
	$formSubmit.html('<i class="fa fa-refresh fa-spin"></i> Loading');
	$formSubmit.attr('disabled','disabled');

	// Ajax magic (c)
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
			$($dataOutputTarget).html(data.projectsTable);
			ajaxPiwikStats();
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

// Listen for change
$('select[data-submit-change]').submit(function(e)
{
	$form = $(this).find('form');
	$form.ajaxFormSubmit();
});
// ajaxFormSubmit();

/*
|--------------------------------------------------------------------------
| Ajax - Piwik Stats
|--------------------------------------------------------------------------
|
|
*/

// Display Piwik stats
function ajaxPiwikStats()
{
	$("span[data-piwik-stats]").each(function(index)
	{
		var $dataGrabber = $(this);
		$dataGrabber.html('<i class="fa fa-refresh fa-spin"></i>');

		var $dataUrl = $(this).data('url');
		var $dataSegment = $(this).data('segment');
		var $piwikDayRange = $('#piwikDayRange input[name="piwikDays"]:radio:checked').val();

		$.get($dataUrl, { segment: $dataSegment, dayRange: $piwikDayRange } )
		.done(function(data)
		{
			$dataGrabber.html(data);
		});
	});
}

// Watch for date change
$('#piwikDayRange input[name="piwikDays"]:radio').change(function()
{
	ajaxPiwikStats();
});

ajaxPiwikStats();


/*
|--------------------------------------------------------------------------
| Form Field Changer - Select
|--------------------------------------------------------------------------
|
|
*/

// $(function() {

// 	// data-select-changer		the select
// 	// data-show-div			the ID of the div to show
// 	// .changer-field			each div that gets hidden/shown

// 	// Set field to be shown/hidden
// 	function selectChangeFormField()
// 	{
// 		var $selectInput = $(this);
// 		var $optionSelected = $("option:selected", $selectInput);
// 		var $showDiv = $optionSelected.data('data-show-div');

// 		$selectInput.find('.changer-field').hide();
// 		$selectInput.find('#' + $showDiv).show();
// 	}

// 	$('[data-select-changer]').on('change', function (e) {
// 		selectChangeFormField();
// 	});

// 	selectChangeFormField();

// });

/*
|--------------------------------------------------------------------------
| Form Field Changer - Radio
|--------------------------------------------------------------------------
|
|
*/

$(function() {

	// data-select-changer		the select
	// data-show-div			the ID of the div to show
	// .changer-field			each div that gets hidden/shown

	// Set field to be shown/hidden
	function radioChangeFormField()
	{
		$('input[data-radio-changer]').each(function()
		{
			var $radioInput = $(this);
			var $showDiv = $radioInput.data('show-div');

			if($radioInput.is(':checked'))
			{
				// $radioInput.find('.changer-field').hide();
				$("#" + $showDiv).show("fast");
			}
			else
			{
				$("#" + $showDiv).hide("fast");
			}
		});
	}

	$('input[data-radio-changer]').on('change', function (e) {
		radioChangeFormField();
	});

	radioChangeFormField();

});

/*
|--------------------------------------------------------------------------
| Ajax - Piwik Stats
|--------------------------------------------------------------------------
|
|
*/

// Display Piwik stats
function ajaxAppInfo()
{
	$("[data-app-info]").each(function(index)
	{
		var $dataGrabber = $(this);
		$dataGrabber.html('<i class="fa fa-refresh fa-spin"></i>');

		var $dataUrl = $(this).data('url');
		var $dataSegment = $(this).data('segment');
		// var $piwikDayRange = $('#piwikDayRange input[name="piwikDays"]:radio:checked').val();

		$.get($dataUrl, { segment: $dataSegment } )
		.done(function(data)
		{
			$dataGrabber.html(data);
		});
	});

	$(document).on("click", "[data-app-info]", function(e)
	{
		ajaxAppInfo();
	});
}

ajaxAppInfo();

// function buildOrder() {
// 	var buffer = [];
// 	//Rebuild the sort order array.
// 	$("#theFields li").each(function(index){
// 		buffer.push($(this).text());
// 		console.log(buffer);
// 	});
// }
// $(document).ready(function(event){
// 	$("#addField").click(function(event){
// 		event.preventDefault();
// 		var fieldName = $("#fieldName").val();
// 		$("#theFields").append("<li><div class=\"form-group\"><label>"+fieldName+"</label><input type=\"text\" class=\"form-control\"></div></li>");
// 			buildOrder();
// 		$(".sortable").sortable().bind('sortupdate',function() {
// 			buildOrder();
// 		})
// 	});
// 	$("#formName").keyup(function(event){
// 		$("#formTitle").html($("#formName").val());
// 	});
// });