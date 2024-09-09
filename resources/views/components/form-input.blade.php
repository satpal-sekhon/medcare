<div class="form-group mb-2">
    <label for="{{ $name }}">{{ $label }}</label>

    <input type="{{ $type }}"
        name="{{ $name }}"
        @if (old($name, $value) !== null) 
           value="{{ old($name, $value) }}"
        @endif
        {{ $attributes->merge(['class' => 'form-control'.($errors->has($name) ? ' is-invalid' : '')]) }}
    />


    @if ($errors->has($name))
        <span class="invalid-feedback">
            {{ $errors->first($name) }}
        </span>
    @endif
</div>
