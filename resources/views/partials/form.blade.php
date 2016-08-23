<div class="form-group">
	<label for="{{ $field }}">{{ $label }}</label>
	<input type="{{ $type }}" name="{{ $field }}" class="form-control" value="{{ old($field) }}">
		@if ($errors->has($field))
			{!! $errors->first($field, '<span class="help-block alert alert-warning">:message</span>') !!}
		@endif
</div>