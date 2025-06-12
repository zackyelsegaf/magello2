@props([
    'label' => '',
    'name' => '',
    'placeholder' => 'Ketik atau pilih...',
    'options' => [],
    'selected' => '',
    'url' => null,
    'size' => null, // null berarti pakai default custom style
])

<div x-data="selectInputComponent({{ json_encode($options) }}, '{{ $url }}', '{{ $selected }}')" class="form-group position-relative">
    @if ($label)
        <label class="font-weight-bold" for="{{ $name }}">{{ $label }}</label>
    @endif

    <input type="hidden" :name="'{{ $name }}'" x-model="selectedKey">

    <input type="text" placeholder="{{ $placeholder }}" autocomplete="off" x-model="inputValue" x-on:focus="open = true"
        x-on:blur="closeWithDelay" x-on:input="fetchIfNeeded"
        class="form-control {{ $size ? 'form-control-' . $size : '' }}"
        style="{{ $size ? '' : 'height: 26px; font-size: 12px;' }}" x-model="value">

    <ul class="list-group mt-1 position-absolute w-100 small" x-show="open && Object.keys(filteredOptions).length > 0"
        x-transition style="z-index: 1000; max-height: 200px; overflow-y: auto;">
        <template x-for="(label, key) in filteredOptions" :key="key">
            <li class="list-group-item list-group-item-action py-1 px-2" x-text="label" @click="select(label)"
                style="cursor: pointer;"></li>
        </template>
    </ul>
</div>

@once
    @push('scripts')
        <script>
            function selectInputComponent(initialOptions, fetchUrl = null, selectedKey = '') {
                return {
                    inputValue: initialOptions[selectedKey] ?? '', // tampilkan label
                    selectedKey: selectedKey,
                    open: false,
                    options: initialOptions ?? {},
                    fetched: false,
                    value: selectedKey,

                    get filteredOptions() {
                        const filter = this.inputValue.toLowerCase();
                        return Object.fromEntries(
                            Object.entries(this.options).filter(([k, v]) =>
                                v.toLowerCase().includes(filter)
                            )
                        );
                    },

                    select(label) {
                        this.inputValue = label;
                        this.value = Object.keys(this.options).find(key => this.options[key] === label);
                        this.selectedKey = this.value;
                        this.open = false;
                    },

                    closeWithDelay() {
                        setTimeout(() => this.open = false, 100);
                    },

                    fetchIfNeeded() {
                        if (!fetchUrl || this.fetched) return;

                        fetch(fetchUrl)
                            .then(res => res.json())
                            .then(data => {
                                this.options = data;
                                this.fetched = true;

                                if (selectedKey && data[selectedKey]) {
                                    this.inputValue = data[selectedKey];
                                }
                            });
                    }
                }
            }
        </script>
    @endpush
@endonce
