<div @class(["form-group mb-2"])>
    <label for="{{ $name }}" @class([$labelClass, 'mb-0' => $labelClass])>{{ $label }}</label>

    <input type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}{{ $type === 'file' && $multiple ? '[]' : '' }}"
        @if ((old($name, $value) !== null) && $type!=='file') 
           value="{{ old($name, $value) }}"
        @endif
        {{ $attributes->merge(['class' => 'form-control'.($errors->has($name) ? ' is-invalid' : '')]) }}
        @if ($multiple)
            multiple
        @endif
    />


    @if ($errors->has($name))
        <span class="invalid-feedback">
            {{ $errors->first($name) }}
        </span>
    @endif
</div>
