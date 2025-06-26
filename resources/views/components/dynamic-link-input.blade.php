<div id="{{ $id ?? 'dynamic-link-component' }}" class="dynamic-link-wrapper">
    <div class="d-flex justify-content-end mb-2">
        <button type="button" class="btn btn-primary btn-sm" onclick="addLinkItem('{{ $id ?? 'dynamic-link-component' }}')">
            Tambah Link
        </button>
    </div>
    
    <div class="link-items mb-3">
        <!-- Dynamic items will be inserted here -->
    </div>
</div>


<template id="link-item-template">
    <div class="form-row align-items-center link-item mb-2">
        <div class="col-auto">
            <label class="col-form-label dynamic-link-label" >File</label>
        </div>
        <div class="col">
            <input type="url" name="{{ $name ?? 'links' }}[][url]" class="form-control" placeholder="your document link" required>
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-danger btn-sm" onclick="removeLinkItem(this)">Hapus</button>
        </div>
    </div>
</template>

<script>
    function addLinkItem(wrapperId) {
        const wrapper = document.getElementById(wrapperId);
        const template = document.getElementById('link-item-template');
        const container = wrapper.querySelector('.link-items');
        const clone = template.content.cloneNode(true);
        container.appendChild(clone);
        updateLinkLabels(container);
    }

    function removeLinkItem(button) {
        const wrapper = button.closest('.dynamic-link-wrapper');
        const container = wrapper.querySelector('.link-items');
        const item = button.closest('.link-item');
        if (item) item.remove();
        updateLinkLabels(container);
    }

    function updateLinkLabels(container) {
        const items = container.querySelectorAll('.link-item');
        items.forEach((item, index) => {
            const label = item.querySelector('.dynamic-link-label');
            if (label) {
                label.textContent = `Link ${index + 1}`;
            }
        });
    }

    // Auto add one field on load
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.dynamic-link-wrapper').forEach(wrapper => {
            const id = wrapper.id;
            addLinkItem(id);
        });
    });
</script>
