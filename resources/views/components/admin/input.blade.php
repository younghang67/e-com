@props([
    'name',
    'type' => 'text',
    'placeholder' => null,
    'oldvalue' => null,
    'label' => null,
    'pattern' => null,
    'multiple' => false,
])

<div {{ $attributes->merge(['class' => 'mt-3']) }}>

    <label for="{{ $name }}" class="form-label">{{ $label }}</label>

    <input type="{{ $type }}" name="{{ $name }}" placeholder="{{ $placeholder }}" id="{{ $name }}"
        value="{{ old($name, $oldvalue) }}" @if ($multiple) multiple @endif class="form-control"
        aria-describedby="defaultFormControlHelp" />


    @if ($errors->has($name))
        <div id="defaultFormControlHelp" class="form-text text-danger">
            {{ $errors->first($name) }}
        </div>
    @endif
</div>
