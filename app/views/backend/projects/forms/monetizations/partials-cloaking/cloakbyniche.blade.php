@if(isset($project) && isset($niche))
	<div class="form-group">
		<label class="col-md-3 control-label">{{ $niche->keyword_main }}</label>
		<div class="col-md-9">
			@if($project->getOption('monetization.cloaking.url_type') == 'custom')
				<input type="text" class="form-control" name="options[monetization.cloaking.cloak_by_niche_urls][{{ $niche->id }}]" placeholder="http://www.google.com" value="" />
			@elseif($project->getOption('monetization.cloaking.url_type') == 'homeadvisor_redirect')
				<select class="selectpicker" name="options[monetization.cloaking.cloak_by_niche_urls][{{ $niche->id }}]" />
					<option value=""></option>
					@for($x = 0;$x < 10;$x++)
						<option value="{{ $x }}">Test {{ $x }}</option>
					@endfor
				</select>
			@endif
		</div>
	</div>
@endif