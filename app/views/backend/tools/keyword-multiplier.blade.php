@extends('backend.template.master')

{{-- Page title --}}
@section('title')
	Keyword Multiplier
@stop

{{-- Page content --}}
@section('content')
	<div class="row">
		<div class="col-md-8">
			<section class="panel panel-default">
				<header class="panel-heading font-bold">
					Keyword Multiplier
				</header>
				<div class="panel-body">
					<form action="{{ route('tools/keyword-multiplier') }}" method="POST">

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="group_a">Group A</label>
									<textarea class="form-control" name="group_a" rows="10" placeholder="Enter keywords, one per line to combine with the other list(s)">{{ Input::old('group_a') }}</textarea>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="group_b">Group B</label>
									<textarea class="form-control" name="group_b" rows="10" placeholder="Enter keywords, one per line to combine with the other list(s)">{{ Input::old('group_b') }}</textarea>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label" for="group_c">Group C</label>
									<textarea class="form-control" name="group_c" rows="10" placeholder="Enter keywords, one per line to combine with the other list(s)">{{ Input::old('group_c') }}</textarea>
								</div>
							</div>
						</div>

						<div class="form-group">
							{{ Form::token() }}
							<button type="submit" class="btn btn-primary">Multiply Keywords</button>
						</div>
					</form>
				</div>
			</section>
		</div>
		<div class="col-md-4">
			<section class="panel panel-default">
				<header class="panel-heading font-bold">
					Keywords
				</header>
				<div class="panel-body">
					@if(isset($keywords) && ! empty($keywords))
						<ul>
							@foreach($keywords as $keyword)
								<li>{{ $keyword }}</li>
							@endforeach
						</ul>
					@endif
				</div>
			</section>
		</div>
	</div>
@stop