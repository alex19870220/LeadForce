<form method="post" action="" autocomplete="off" enctype="multipart/form-data">

	<!-- CSRF Token -->
	{{ Form::token() }}

	<div class="row">
		<!-- Left Column -->
		<div class="col-md-8">

			<section class="panel panel-default">
				<header class="panel-heading">
					Main Niche Data
				</header>
				<section class="panel-body">

					<!-- Niche Label 	 -->
					<div class="form-group {{ $errors->has('label') ? 'has-error' : '' }}">
						<label for="label">Niche Label</label>
						@if(Route::currentRouteName() == 'edit/niche')
							<input class="form-control" type="text" name="label" id="label" value="{{ Input::old('label', $niche->label) }}" />
						@elseif(Route::currentRouteName() == 'create/niche')
							<input class="form-control" type="text" name="label" id="label" value="{{ Input::old('label') }}" />
						@endif
						{{ $errors->first('label', '<span class="help-block">:message</span>') }}
					</div>

					<!-- Website Template -->
					<div class="form-group {{ $errors->has('template') ? 'has-error' : '' }}">
						<label for="template">Website Template <span class="text-muted">(folder name)</span></label>
						@if(Route::currentRouteName() == 'edit/niche')
							<input class="form-control" type="text" name="template" id="template" value="{{ Input::old('template', $niche->template) }}">
						@elseif(Route::currentRouteName() == 'create/niche')
							<input class="form-control" type="text" name="template" id="template" value="{{ Input::old('template') }}">
						@endif
						{{ $errors->first('template', '<span class="help-block">:message</span>') }}
					</div>

				</section>
			</section>

			<section class="panel panel-default">
				<header class="panel-heading">
					Content Source
				</header>
				<section class="panel-body">
					<div class="row">
						<div class="col-md-6">

							<!-- Content ID -->
							<div class="form-group {{ $errors->has('content_id') ? 'has-error' : '' }}">
								<label for="content_id" class="sr-only">Content Source</label>
								@if(Route::currentRouteName() == 'edit/niche')
									<select class="form-control" name="content_id" id="content_id">
										<option selected>Select</option>
										<option value="1">Option 1</option>
										<option value="2">Option 2</option>
										<option value="3">Option 3</option>
										<option value="4">Option 4</option>
									</select>
								@elseif(Route::currentRouteName() == 'create/niche')
									<select class="form-control" name="content_id" id="content_id">
										<option selected>Select</option>
										<option value="1">Option 1</option>
										<option value="2">Option 2</option>
										<option value="3">Option 3</option>
										<option value="4">Option 4</option>
									</select>
								@endif
								{{ $errors->first('content_id', '<span class="help-block">:message</span>') }}
							</div>

						</div>
						<div class="col-md-6">
						</div>
					</div>
				</section>
			</section>

			<section class="panel panel-default">
				<header class="panel-heading">
					Niche Keywords
				</header>
				<section class="panel-body">

					<!-- Niche Keywords -->
					<div class="form-group {{ $errors->has('keywords') ? 'has-error' : '' }}">
						<label for="keywords" class="sr-only">Niche Keywords</label>
						@if(Route::currentRouteName() == 'edit/niche')
							<input class="form-control" type="text" name="keywords" id="keywords" value="{{ Input::old('keywords', $niche->keywords) }}">
						@elseif(Route::currentRouteName() == 'create/niche')
							<input class="form-control" type="text" name="keywords" id="keywords" value="{{ Input::old('keywords') }}">
						@endif
						{{ $errors->first('keywords', '<span class="help-block">:message</span>') }}
					</div>

				</section>
			</section>

		</div> <!-- End Left Column -->

		<!-- Right Column -->
		<div class="col-md-4">

			<section class="panel panel-default">
				<header class="panel-heading">
					Save Niche
				</header>
				<section class="panel-body">

					<!-- Form actions -->
					<div class="form-group m-b-none">
						<div class="controls">
							<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i>
								@if(Route::currentRouteName() == 'edit/niche')
									Save
								@elseif(Route::currentRouteName() == 'create/niche')
									Create
								@endif
							</button>
							<a class="btn btn-default" href="{{ route('niches') }}">Cancel</a>
						</div>
					</div>

				</section>
			</section>

			<section class="panel panel-default">
				<header class="panel-heading">
					Add Sub-Services
				</header>
				<section class="panel-body">

					<!-- Niche Sub-Services -->
					<div class="form-group {{ $errors->has('services') ? 'has-error' : '' }}">
						<label for="services">Sub-Services</label>
						@if(Route::currentRouteName() == 'edit/niche')
							<textarea class="form-control" name="services" id="services" rows="5" placeholder="One per line">{{ Input::old('services') }}</textarea>
						@elseif(Route::currentRouteName() == 'create/niche')
							<textarea class="form-control" name="services" id="services" rows="5" placeholder="One per line">{{ Input::old('services') }}</textarea>
						@endif
						{{ $errors->first('services', '<span class="help-block">:message</span>') }}
						<span class="help-block">E.G. wedding photography, fashion photography, family portraits, etc</span>
					</div>

				</section>
			</section>

		</div> <!-- End Right Column -->
	</div> <!-- End Row -->

</form>