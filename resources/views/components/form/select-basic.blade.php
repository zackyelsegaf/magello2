@props([
    'id',
    'name',
    'options' => [],
    'isbold' => false,
    'label' => '',
    'placeholder' => null,
    'size' => null, // Tambahan: ukuran select
])
 
<label for="{{ $id }}" class="{{ $isbold ? 'font-weight-bold' : '' }}">
    {{ $label }}
</label>
<select
    class="form-control {{ $size ? 'form-control-' . $size : '' }}"
    id="{{ $id }}"
    name="{{ $name }}"
>
    @if ($placeholder)
        <option value="" disabled selected>{{ $placeholder }}</option>
    @endif

    @foreach ($options as $value => $display)
        <option value="{{ $value }}">{{ $display }}</option>
    @endforeach
</select>
