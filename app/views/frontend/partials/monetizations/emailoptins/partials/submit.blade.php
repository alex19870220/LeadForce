@if(! empty($emailOptin->form_data->button_text))
	<button type="submit" class="btn {{ $class or 'btn-primary' }}">{{ $emailOptin->form_data->button_text }}</button>
@else
	<button type="submit" class="btn {{ $class or 'btn-primary' }}">Subscribe!</button>
@endif