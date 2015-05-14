<!-- Upload Logo -->
<section class="panel panel-default b-a">
	<header class="panel-heading b-b font-bold">
		Template &amp; Styling
	</header>
	<div class="panel-body">
		<!-- Website Template 	 -->
		<div class="form-group{{ $errors->has('template') ? ' has-error' : '' }}">
			<label class="col-md-3 control-label" for="template">Website Template</label>
			<div class="col-md-9">
				<select class="form-control" name="template" id="template">
					<option value="default">Default</option>
				</select>
				{{ $errors->first('template', '<span class="help-block">:message</span>') }}
			</div>
		</div>

		<h4 class="page-header">Header Options</h4>
		{{ HTML::optionSwitch('options[design.header.breadcrumbs_show]', 'Show Breadcrumbs', $project->getOption('design.header.breadcrumbs_show')) }}

		{{ HTML::optionSwitch('options[design.header.header_sticky]', 'Sticky Header', $project->getOption('design.header.header_sticky')) }}
	</div>
</section>

<!-- Upload Logo -->
<section class="panel panel-default b-a">
	<header class="panel-heading b-b font-bold">
		Logo
	</header>
	<div class="panel-body">

	</div>
</section>