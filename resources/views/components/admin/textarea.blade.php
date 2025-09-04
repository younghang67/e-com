<div class="mb-3">
    <label for="{{ $id ?? $name }}" class="form-label fw-bold">
        {{ $label ?? ucfirst($name) }}
    </label>
    <textarea
        class="form-control {{ $class ?? '' }}"
        name="{{ $name }}"
        id="{{ $id ?? $name }}"
        placeholder="{{ $placeholder ?? '' }}"
        rows="{{ $rows ?? 6 }}"
    >{{ old($name, $slot) }}</textarea>
</div>
