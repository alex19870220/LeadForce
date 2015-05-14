@extends('partials.modal')

@section('title')
{{ Config::get('app.appname') }} Shortcodes & Info
@stop

@section('body')
<section class="panel panel-default b-a">
	<header class="panel-heading b-b font-bold">
		Types of Shortcodes
	</header>
	<table class="table">
		<thead class="l-h-2x">
			<tr>
				<th>Code</th>
				<th>Label</th>
				<th>Example</th>
				<th>Rdm</th>
				<th>CS</th>
			</tr>
		</thead>
		<tbody class="l-h-2x">
			<tr>
				<td>[state]</td>
				<td>State</td>
				<td>North Carolina</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>[st]</td>
				<td>State</td>
				<td>NC</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>[city]</td>
				<td>City</td>
				<td>Wilmington</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>[zip]</td>
				<td>Zip Code</td>
				<td>28411</td>
				<td><i class="text-success fa fa-check"></i></td>
				<td></td>
			</tr>
			<tr>
				<td>[Mkw]</td>
				<td>Main Keyword</td>
				<td>Photography</td>
				<td></td>
				<td><i class="text-success fa fa-check"></i></td>
			</tr>
			<tr>
				<td>[Ckw]</td>
				<td>Content Keyword</td>
				<td>Wedding Photography</td>
				<td><i class="text-success fa fa-check"></i></td>
				<td><i class="text-success fa fa-check"></i></td>
			</tr>
			<tr>
				<td>[header group="4"]</td>
				<td>Header</td>
				<td>Our Latest [CKW] Tips</td>
				<td><i class="text-success fa fa-check"></i></td>
				<td></td>
			</tr>
			<tr>
				<td>[googlemap]</td>
				<td>Google Map</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>
</section>

<section class="panel panel-default b-a">
	<header class="panel-heading b-b font-bold">
		Shortcode Capitalization Options
	</header>
	<div class="panel-body">
		<p>You can customize the output of most of the shortcodes! This is great for using shortcodes in headers, content, beginning of sentences, etc. It may add more work to writing content, but it makes the content look "natural".</p>
	</div>
	<table class="table">
		<thead class="l-h-2x">
			<tr>
				<th>Code</th>
				<th>Output</th>
			</tr>
		</thead>
		<tbody class="l-h-2x">
			<tr>
				<td>[MKW]</td>
				<td><u>W</u>edding <u>P</u>hotography</td>
			</tr>
			<tr>
				<td>[Mkw]</td>
				<td><u>W</u>edding <u>p</u>hotography</td>
			</tr>
			<tr>
				<td>[mkw]</td>
				<td><u>w</u>edding <u>p</u>hotography</td>
			</tr>
		</tbody>
	</table>
</section>
@stop