@props([
    'id' => 'select-' . uniqid(),
    'name',
    'placeholder' => 'Pilih opsi...',
    'options' => [],
    'url' => null,
    'value' => '',
])
<div class="form-group">
    <select id="{{ $id }}" name="{{ $name }}" class="form-control">
        @if (!$url)
            <option value="">{{ $placeholder }}</option>
            @foreach ($options as $option)
                <option value="{{ $option['value'] }}" @selected($option['value'] == $value)>
                    {{ $option['label'] }}
                </option>
            @endforeach
        @endif
    </select>
</div>

@pushOnce('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById(@json($id));

            const config = {
                placeholder: @json($placeholder),
                valueField: 'value',
                labelField: 'label',
                searchField: 'label',
                preload: true,
                loadThrottle: 250,
            };

            @if ($url)
                config.load = function(query, callback) {
                    fetch(@json($url) + '?q=' + encodeURIComponent(query))
                        .then(response => response.json())
                        .then(data => callback(data))
                        .catch(() => callback([]));
                };
            @endif

            new TomSelect(select, config);
        });
    </script>
@endpushOnce
