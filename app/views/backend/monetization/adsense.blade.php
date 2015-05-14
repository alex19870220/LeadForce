@extends('backend.template.master')

{{-- Page title --}}
@section('title')
	Adsense Setup
@stop

@section('content')
<div class="row">
	<div class="col-md-8">

		<section class="panel panel-default" style="overflow: visible;">
			<header class="panel-heading font-bold">
				Your Adsense Channel Groups
			</header>
			<table class="table table-striped b-light">
				<thead class="l-h-2x">
					<tr>
						<th class="col-md-3">Label</th>
						<th class="col-md-4">Publisher ID</th>
						<th class="col-md-3">Ads</th>
						<th class="col-md-2">Actions</th>
					</tr>
				</thead>
				<tbody class="l-h-2x">
				@if($allAdsenseGroups)
					@foreach($allAdsenseGroups as $ad)
						@include('backend.monetization.partials.adsense_table', ['adsense' => $ad])
					@endforeach
				@endif
				</tbody>
			</table>
		</section>

	</div>
	<div class="col-md-4">

		<!-- Adsense -->
		<section class="panel panel-default b-a">
			<header class="panel-heading b-b font-bold">
				Adsense Setup
			</header>
			<div class="panel-body">
				<form method="post" action="{{ route('adsense/update-adsense') }}" autocomplete="off">
					<!-- Label -->
					<div class="form-group {{ $errors->has('label') ? 'has-error' : '' }}">
						<label class="control-label" for="label">Adsense Group Label</label>
						<input type="text" class="form-control" name="label" value="{{ Input::old('label', $adsenseForm->label) }}">
						{{ $errors->first('label', '<span class="help-block">:message</span>') }}
					</div>

					<!-- Publisher ID -->
					<div class="form-group {{ $errors->has('publisher_id') ? 'has-error' : '' }}">
						<label class="control-label" for="publisher_id">Adsense Publisher ID</label>
						<input type="text" class="form-control" name="publisher_id" value="{{ Input::old('publisher_id', $adsenseForm->publisher_id) }}" placeholer="ca-pub-9242070101010101">
						{{ $errors->first('publisher_id', '<span class="help-block">:message</span>') }}
					</div>

					@if($currentUser->has('adsense')->count() > 0)
						@foreach(AdsenseHelper::getAdTypes() as $adUnit => $adUnitData)
							<div class="form-group {{ $errors->has($adUnit) ? 'has-error' : '' }}">
								<label class="control-label" for="">{{ $adUnitData->w }}x{{ $adUnitData->h }} - {{ $adUnitData->label }} Ad ID</label>
								<input type="number" class="form-control" name="{{ $adUnit }}" value="{{ Input::old($adUnit, $adsenseForm->getAd(Str::slug($adUnitData->label)) ) }}">
								{{ $errors->first($adUnit, '<span class="help-block">:message</span>') }}
							</div>
						@endforeach
					@endif

					<!-- Save Adsense -->
					<div class="form-group">
						<!-- CSRF Token -->
						{{ Form::token() }}
						<button type="submit" class="btn btn-primary">Update Adsense Info</button>
					</div>
				</form>
			</div>
		</section>

	</div>
</div>
@stop