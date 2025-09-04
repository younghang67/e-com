@props([
    'name',
    'label',
    'values',
    'displayColumn' => 'name',
    'oldValue' => null,
    'multiple' => false,
    'useChoices' => true, // enables Choices.js by default
])

@php
    $selectClasses = 'form-control';
    if ($multiple && $useChoices) {
        $selectClasses .= ' choices-multiple';
    }
@endphp
<style>
    .choices__inner,
    .choices__input,
    .choices__list--dropdown,
    .choices__list[aria-expanded] {
        background-color: #343a40;
    }
</style>
<div {{ $attributes->merge(['class' => 'form-group mt-3']) }}>
    <label for="{{ $name }}">{{ $label }}</label>

    <select required name="{{ $multiple ? $name . '[]' : $name }}" id="{{ $name }}"
        @if ($multiple) multiple @endif class="{{ $selectClasses }}">
        @if (!$multiple)
            <option value="" selected disabled>Select...</option>
        @endif

        {{ $slot }}

        @forelse ($values as $value)
            <option value="{{ $value['id'] }}"
                @if ($multiple && in_array($value['id'], (array) old($name, $oldValue))) selected
                    @elseif (!$multiple && $value['id'] == old($name, $oldValue)) selected @endif>
                {{ $value[$displayColumn] }}
            </option>
        @empty
        @endforelse
    </select>

    @if ($errors->has($name))
        <div id="defaultFormControlHelp" class="form-text text-danger">
            {{ $errors->first($name) }}
        </div>
    @endif
</div>
