@props([
    'label' => '',
    'name',
    'id' => null,
    'type' => 'text',
    'placeholder' => '',
    'value' => '',
    'size' => null, // sm, md, lg, atau null (default: custom 26px height)
])

@php
    $inputId = $id ?? $name;
    $sizeClass = match ($size) {
        'sm' => 'form-control-sm',
        'lg' => 'form-control-lg',
        default => '',
    };
    $defaultStyle = $size ? '' : 'height: 26px; font-size: 12px;';
@endphp

<div class="form-group">
    @if ($label)
        <label for="{{ $inputId }}" class="font-weight-bold">{{ $label }}</label>
    @endif

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $inputId }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        style="{{ $defaultStyle }}"
        {{ $attributes->class(['form-control', $sizeClass]) }}
    >
</div>
