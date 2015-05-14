@extends('backend.template.master')

{{-- Page title --}}
@section('title')
	Keyword Grouper
@stop

{{-- Accessory Buttons --}}
@section('buttons')
	<button type="button" class="btn btn-info" data-toggle="modal" data-target="#viewModal">
		<i class="fa fa-sort-alpha-asc"></i> Group Keywords
	</button>
@stop

{{-- Page content --}}
@section('content')
	@if(isset($keywordGroups) && ! empty($keywordGroups))
		<div class="row">
			@foreach($keywordGroups as $keywordGroup => $keywordGroupWords)
				<div class="col-sm-6 col-md-3">
					<section class="panel panel-default">
						<header class="panel-heading font-bold">
							{{ ucwords($keywordGroup) }}
						</header>
						<table class="table table-condensed table-striped">
							@for($x = 0;$x < $groupLimit;$x++)
								<tr>
									@if(isset($keywordGroupWords[$x]))
										<td>{{ str_replace($keywordGroup, '<u>' . $keywordGroup . '</u>', $keywordGroupWords[$x]) }}</td>
									@else
										<td>&nbsp;</td>
									@endif
								</tr>
							@endfor
						</table>
					</section>
				</div>
			@endforeach
		</div>
	@endif
@stop

{{-- Modal Title --}}
@section('modal-title')
	Group Keywords
@stop

{{-- Modal Button --}}
@section('modal-button')
	Group Keywords
@stop

{{-- Modal Content (in a form) --}}
@section('modal')
	<!-- Keywords -->
	<div class="form-group">
		<label class="col-sm-3 control-label" for="keywords">Keywords</label>
		<div class="col-md-9">
			<textarea class="form-control col-md-12" rows="10" name="keywords" id="keywords">{{ Input::old('keywords') }}</textarea>
			<span class="help-block">One keyword per line</span>
		</div>
	</div>

	<!-- Group Limit -->
	<div class="form-group">
		<label class="col-sm-3 control-label" for="group_limit">Group Limit</label>
		<div class="col-md-9">
			<select class="form-control" name="group_limit">
				<option value="5">5</option>
				<option value="10" selected>10</option>
				<option value="15">15</option>
				<option value="20">20</option>
				<option value="25">25</option>
			</select>
		</div>
	</div>
	<!-- CSRF Token -->
	{{ Form::token() }}
@stop