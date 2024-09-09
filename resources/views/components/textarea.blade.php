<div class="form-group mb-2">
    <label for="{{ $name }}">{{ $label }}</label>
    
    <textarea 
        name="{{ $name }}" 
        id="{{ $name }}"
        {{ $attributes->merge(['class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : '')]) }}
    >{{ old($name, $value) }}</textarea>

    @if ($errors->has($name))
        <span class="invalid-feedback">
            {{ $errors->first($name) }}
        </span>
    @endif
</div>