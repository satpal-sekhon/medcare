<div class="form-group mb-2">
    <label for="{{ $name }}">{{ $label }}</label>

    <input type="{{ $type }}"
        name="{{ $name }}{{ $type === 'file' && $multiple ? '[]' : '' }}"
        @if ((old($name, $value) !== null) && $type!=='file') 
           value="{{ old($name, $value) }}"
        @endif
        {{ $attributes->merge(['class' => 'form-control'.($errors->has($name) ? ' is-invalid' : '')]) }}
        {{ $multiple ? 'multiple' : '' }}
    />


    @if ($errors->has($name))
        <span class="invalid-feedback">
            {{ $errors->first($name) }}
        </span>
    @endif
</div>
