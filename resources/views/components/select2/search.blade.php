@props([
    'label' => 'Pilih Opsi',
    'name' => '',
    'placeholder' => 'Ketik atau pilih...',
    'options' => [],
    'selected' => '',
    'url' => null, // URL API (opsional)
])

<div x-data="selectInputComponent({{ json_encode($options) }}, '{{ $url }}')" class="form-group position-relative">
    <label for="{{ $name }}">{{ $label }}</label>

    <input type="text" class="form-control form-control-sm" name="{{ $name }}" x-model="inputValue"
        x-on:focus="open = true" x-on:blur="closeWithDelay" x-on:input="fetchIfNeeded" placeholder="{{ $placeholder }}"
        autocomplete="off">

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
            function selectInputComponent(initialOptions, fetchUrl = null) {
                return {
                    inputValue: '',
                    open: false,
                    options: initialOptions ?? {},
                    fetched: false,

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
                            });
                    }
                }
            }
        </script>
    @endpush
@endonce
