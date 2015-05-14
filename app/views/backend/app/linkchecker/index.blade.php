@extends('backend.template.master')

{{-- Page title --}}
@section('title')
Bulk Link Checker
@stop

{{-- Accessory Buttons --}}
@section('buttons')

@stop

{{-- Page content --}}
@section('content')
		<p>Bulk URL metrics for PageRank, PA/DA, and Index checking. Keep in mind the more stats you check, the longer the check will take!</p>
		<div class="row">

			<div class="col-md-4">
				<section class="panel panel-default">
					<header class="panel-heading">Options</header>
					<section class="panel-body">
						<form class="" method="post" action="" data-async="" data-target="#tbody">
							<div class="form-group">
								<div class="checkbox">
									<label><input type="checkbox" name="check_pagerank" id="check_pagerank" value="1"{{ (Input::old('check_pagerank') == 1 ? ' checked="checked"' : '') }}> PageRank</label>
								</div>
								<div class="checkbox">
									<label><input type="checkbox" name="check_pada" id="check_pada" value="1"{{ (Input::old('check_pada') == 1 ? ' checked="checked"' : '') }}> Page Authority &amp; Domain Authority</label>
								</div>
								<div class="checkbox">
									<label><input type="checkbox" name="check_rdbl" id="check_rdbl" value="1"{{ (Input::old('check_rdbl') == 1 ? ' checked="checked"' : '') }}> Referring Domains &amp; Backlinks</label>
								</div>
								<div class="checkbox">
									<label><input type="checkbox" name="check_index" id="check_index" value="1"{{ (Input::old('check_index') == 1 ? ' checked="checked"' : '') }}> Google Index</label>
								</div>
								<div class="checkbox">
									<label><input type="checkbox" name="check_alexa" id="check_alexa" value="1"{{ (Input::old('check_alexa') == 1 ? ' checked="checked"' : '') }}> Alexa Rank</label>
								</div>
							</div>

							<div class="form-group {{ $errors->has('url') ? 'has-error' : '' }}">
								<label class="control-label" for="urls">URL</label>
								<textarea class="form-control" name="urls" id="urls" rows="15" placeholder="http://www.domain.com">{{ $metrics['urls'] or '' }}</textarea>
								<span class="help-block">Max 1,000 URL's, 1 per line</span>
								{{ $errors->first('url', '<span class="help-block">:message</span>') }}
							</div>

							<div class="form-group">
								<input type="hidden" name="action" value="checkwww">
								<button type="submit" class="btn btn-primary btn-block">Check SEO Metrics</button>
							</div>

						</form>
					</section>
				</section>
			</div> <!-- End Half Column -->

			<div class="col-md-8">
				<section class="panel panel-default">
					<header class="panel-heading">Results</header>
					<table class="table table-bordered" id="table">
						<thead>
							<tr>
								<th class="col-sm-5">URL</th>
								<th class="col-sm-1"><span class="block" data-toggle="tooltip" data-original-title="Google PageRank">PageRank</span></th>
								<th class="col-sm-1"><span class="block" data-toggle="tooltip" data-original-title="Page Authority">PA</span></th>
								<th class="col-sm-1"><span class="block" data-toggle="tooltip" data-original-title="Domain Authority">DA</span></th>
								<th class="col-sm-1"><span class="block" data-toggle="tooltip" data-original-title="Referring Domains">RD</span></th>
								<th class="col-sm-1"><span class="block" data-toggle="tooltip" data-original-title="Total Backlinks">BL</span></th>
								<th class="col-sm-1"><span class="block" data-toggle="tooltip" data-original-title="Google Index">Index</span></th>
								<th class="col-sm-1"><span class="block" data-toggle="tooltip" data-original-title="Alexa">Alexa</span></th>
							</tr>
						</thead>
						<tbody id="tbody">
							@if(isset($metrics))
								<tr>
									<td>{{ $metrics['url'] or '' }}</td>
									<td>{{ $metrics['pagerank'] or '' }}</td>
									<td>{{ $metrics['pa'] or '' }}</td>
									<td>{{ $metrics['da'] or '' }}</td>
									<td>{{ $metrics['referring_domains'] or '' }}</td>
									<td>{{ $metrics['backlinks'] or '' }}</td>
									<td>{{ $metrics['index'] or '' }}</td>
									<td>{{ $metrics['alexa'] or '' }}</td>
								</tr>
							@endif
						</tbody>
					</table>
				</section>
			</div> <!-- End Half Column -->
		</div> <!-- End Row -->
@stop