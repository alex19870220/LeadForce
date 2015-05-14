@extends('backend.template.master')

{{-- Page title --}}
@section('title')
	Niches Dashboard
@stop

{{-- Accessory Buttons --}}
@section('buttons')
	<a href="{{ route('create/niche') }}" class="btn btn-default"><i class="fa fa-plus"></i> Create Niche</a>
	@if(! empty(Input::get('parent')) && is_numeric(Input::get('parent')))
	<a href="{{ route('niches') }}" class="btn btn-primary m-l"><i class="fa fa-arrow-left"></i> View All Niches</a>
	@endif
@stop

{{-- Page content --}}
@section('content')
	@foreach ($niches as $niche)
		<section class="panel b-light" id="niche-{{ $niche->id }}">
			<header class="panel-heading bg-light text-right">
				<!-- Nav Tabs -->
				<ul class="nav nav-tabs">
					<li class="active"><a href="#main-{{ $niche->id }}" data-toggle="tab"><i class="fa fa-paper-plane fa-fw text-muted"></i> Niche</a></li>
					<li><a href="#content-{{ $niche->id }}" data-toggle="tab"><i class="fa fa-file-text-o fa-fw text-muted"></i> Content</a></li>
					<li><a href="{{ route('create/niche', ['parent' => $niche->id]) }}"><i class="fa fa-plus fa-fw text-success"></i> Add Child Niche</a></li>
					@if(isset($niche->project))
						<li class="hidden-sm pull-right">
							<a href="{{ route('edit/project', $niche->project->id) }}">
								<i class="fa fa-suitcase fa-fw text-muted"></i> {{ $niche->project->website_url }}
							</a>
						</li>
					@endif

				</ul>
			</header>
			<div class="panel-body">
				<div class="tab-content">
					<!-- Main Tab -->
					<div class="row tab-pane fade in active" id="main-{{ $niche->id }}">
						<table class="table table-condensed table-striped table-hover m-b-none">
							<thead>
								@include('backend.niches.partials.niche_header')
							</thead>
							<tbody>
								<!-- Niche Parent -->
								@include('backend.niches.partials.niche_row', ['niche' => $niche, 'isparent' => true])
								<!-- Loop through the Niche Children -->
								@foreach($niche->children as $child)
									@include('backend.niches.partials.niche_row', ['niche' => $child, 'ischild' => true])
								@endforeach
							</tbody>
						</table>
					</div>
					<!-- Content Pane -->
					<div class="tab-pane fade" id="content-{{ $niche->id }}">
						<div class="row">
							<div class="col-md-12">
								<div class="pull-left m-r-lg">
									<img src="/assets/img/construction.jpg" alt="Under Construction" />
								</div>
								<h2>Hey y'all</h2>
								<p class="h4">This urrea is unda construction</p>
							</div>
						</div>
					</div>
					<!-- Add Child Niche Pane -->
					<div class="tab-pane fade" id="addchild-{{ $niche->id }}">

					</div>
				</div>
			</div>
			<!-- <footer class="panel-footer no-padder">
				<div class="row text-center no-gutter">
					<div class="col-md-3 padder b-r">
						<span class="m-t block">&nbsp;</span>
						<span class="m-b block">&nbsp;</span>
					</div>
					<div class="col-md-3 padder b-r">
						<span class="m-t block">&nbsp;</span>
						<span class="m-b block">&nbsp;</span>
					</div>
					<div class="col-md-3 padder b-r">
						<span class="m-t block">&nbsp;</span>
						<span class="m-b block">&nbsp;</span>
					</div>
					<div class="col-md-3 padder">
						<span class="m-t block">&nbsp;</span>
						<span class="m-b block">&nbsp;</span>
					</div>
				</div>
			</footer> -->
		</section>
	@endforeach

@stop