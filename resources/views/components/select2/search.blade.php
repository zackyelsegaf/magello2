@props([
    'label' => 'Pilih Opsi',
    'name' => '',
    'options' => [],
    'selected' => null,
    'placeholder' => 'Ketik atau pilih...',
])

<div x-data="{ inputValue: '', open: true, options: {1:'A',2:'B'}, get filteredOptions() {
    return Object.fromEntries(Object.entries(this.options).filter(([k,v]) => v.toLowerCase().includes(this.inputValue.toLowerCase())))
}}">
    <input class="form-control" x-model="inputValue" x-on:focus="open=true">
    <ul x-show="open" class="list-group mt-1">
        <template x-for="(label, key) in filteredOptions" :key="key">
            <li x-text="label" class="list-group-item"></li>
        </template>
    </ul>
</div>

@once
    @push('scripts')
        <script>
            function selectInputComponent() {
                return {
                    inputValue: @json($selected ? $options[$selected] ?? '' : ''),
                    open: false,
                    options: @json($options),
                    get filteredOptions() {
                        const q = this.inputValue.toLowerCase();
                        return Object.fromEntries(
                            Object.entries(this.options).filter(([k, v]) =>
                                v.toLowerCase().includes(q)
                            )
                        );
                    },
                    select(label) {
                        this.inputValue = label;
                        this.open = false;
                    },
                    closeWithDelay() {
                        setTimeout(() => this.open = false, 100);
                    }
                }
            }
        </script>
    @endpush
@endonce
