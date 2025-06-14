@props([
    'id' => 'autocomplete-input',
    'placeholder' => 'Type to search...',
    'url' => null,
    'data' => [],
    'name' => 'selected_id',
    'size' => '',
    'autofill' => [] // contoh: ['alamat' => 'alamat-input', 'telepon' => 'telp-input']
])

<div class="form-group position-relative" style="position: relative;">
    <div style="position: relative;">
        <input type="text"
               id="{{ $id }}"
               class="form-control {{ $size ? 'form-control-' . $size : '' }}"
               placeholder="{{ $placeholder }}"
               autocomplete="off"
               data-url="{{ $url }}"
               data-local='@json($data)'
               data-hidden-id="{{ $id . '-hidden' }}"
               style="padding-right: 2rem;">

        <!-- Tombol clear -->
        <span id="{{ $id . '-clear' }}"
              style="position: absolute;
                     right: 10px;
                     top: 50%;
                     transform: translateY(-50%);
                     cursor: pointer;
                     display: none;
                     color: #999;
                     font-size: 18px;">&times;</span>
    </div>

    <!-- Hidden input untuk simpan ID -->
    <input type="hidden" name="{{ $name }}" id="{{ $id . '-hidden' }}">

    <!-- Box suggestions -->
    <div class="autocomplete-suggestions" style="
        border: 1px solid #ddd;
        border-top: none;
        max-height: 200px;
        overflow-y: auto;
        position: absolute;
        background: white;
        width: 100%;
        z-index: 1000;
        display: none;
        margin-top: 4px;"></div>
</div>

<script>
(function () {
    const input = document.getElementById(@json($id));
    const hiddenInput = document.getElementById(input.dataset.hiddenId);
    const suggestionsBox = input.closest('.form-group').querySelector('.autocomplete-suggestions');
    const clearButton = document.getElementById(@json($id . '-clear'));
    const autofillMap = @json($autofill);

    function updateClearButton() {
        clearButton.style.display = input.value ? 'block' : 'none';
    }

    clearButton.addEventListener('click', () => {
        input.value = '';
        hiddenInput.value = '';
        suggestionsBox.innerHTML = '';
        suggestionsBox.style.display = 'none';
        updateClearButton();

        // Kosongkan autofill input
        Object.values(autofillMap).forEach(id => {
            const el = document.getElementById(id);
            if (el) el.value = '';
        });
    });

    async function showSuggestions(query = '') {
        suggestionsBox.innerHTML = '';
        let suggestions = [];

        const url = input.dataset.url;
        let localDataRaw = JSON.parse(input.dataset.local || '[]');
        let localData = Array.isArray(localDataRaw)
            ? localDataRaw
            : Object.entries(localDataRaw).map(([id, name]) => ({ id, name }));

        if (url) {
            try {
                const res = await fetch(`${url}?q=${encodeURIComponent(query)}`);
                suggestions = await res.json();
            } catch (e) {
                console.error('Fetch error:', e);
            }
        } else {
            suggestions = localData.filter(item =>
                item.name.toLowerCase().includes(query.toLowerCase())
            );
        }

        if (suggestions.length === 0) {
            suggestionsBox.style.display = 'none';
            return;
        }

        suggestions.forEach(item => {
            const div = document.createElement('div');
            div.textContent = item.name;
            div.style.padding = '8px';
            div.style.cursor = 'pointer';
            div.addEventListener('mouseover', () => div.style.backgroundColor = '#f0f0f0');
            div.addEventListener('mouseout', () => div.style.backgroundColor = '');
            div.addEventListener('click', () => {
                input.value = item.name;
                hiddenInput.value = item.id;
                suggestionsBox.innerHTML = '';
                suggestionsBox.style.display = 'none';
                updateClearButton();

                // Isi input autofill
                Object.entries(autofillMap).forEach(([fieldKey, fieldId]) => {
                    const field = document.getElementById(fieldId);
                    if (field && item[fieldKey] !== undefined) {
                        field.value = item[fieldKey];
                    }
                });
            });
            suggestionsBox.appendChild(div);
        });

        suggestionsBox.style.display = 'block';
    }

    input.addEventListener('input', () => {
        hiddenInput.value = '';
        showSuggestions(input.value.trim());
        updateClearButton();
    });

    input.addEventListener('focus', () => {
        showSuggestions(input.value.trim());
        updateClearButton();
    });

    input.addEventListener('click', () => {
        showSuggestions(input.value.trim());
    });

    document.addEventListener('click', e => {
        if (!input.contains(e.target) &&
            !suggestionsBox.contains(e.target) &&
            e.target !== clearButton) {
            suggestionsBox.innerHTML = '';
            suggestionsBox.style.display = 'none';
        }
    });

    updateClearButton();
})();
</script>
