<script>
  export let id = 'autocomplete-input';
  export let label = '';
  export let placeholder = 'Type to search...';
  export let data = []; // Format: [{ id: 1, name: 'John Doe', alamat: '...' }]
  export let name = 'selected_id';
  export let size = '';
  export let autofill = {}; // Format: { alamat: 'alamat_input_id', ... }
  export let select = null; // Format: { id: 1, name: 'John Doe', alamat: '...' }

  let inputValue = select?.name || '';
  let hiddenValue = select?.id || '';
  let suggestions = [];
  let showSuggestions = false;

  function onInput(e) {
    inputValue = e.target.value;
    hiddenValue = '';
    updateSuggestions(inputValue);
  }

  function updateSuggestions(query) {
    if (!query) {
      suggestions = [];
      showSuggestions = false;
      return;
    }

    const q = query.toLowerCase();
    suggestions = data.filter(item => item.name.toLowerCase().includes(q));
    showSuggestions = suggestions.length > 0;
  }

  function selectSuggestion(item) {
    inputValue = item.name;
    hiddenValue = item.id;
    showSuggestions = false;
    suggestions = [];

    // Autofill
    for (const [key, elId] of Object.entries(autofill)) {
      const field = document.getElementById(elId);
      if (field && item[key] !== undefined) {
        field.value = item[key];
      }
    }
  }

  function clearInput() {
    inputValue = '';
    hiddenValue = '';
    suggestions = [];
    showSuggestions = false;

    for (const elId of Object.values(autofill)) {
      const field = document.getElementById(elId);
      if (field) field.value = '';
    }
  }

  function handleClickOutside(event) {
    if (!event.target.closest(`#${id}-container`)) {
      showSuggestions = false;
    }
  }

  // Register outside click handler
  onMount(() => {
    document.addEventListener('click', handleClickOutside);
    return () => document.removeEventListener('click', handleClickOutside);
  });
</script>

<div class="form-group position-relative" id="{id}-container" style="position: relative;">
  {#if label}
    <label class="font-weight-bold" for={name}>{label}</label>
  {/if}
  <div style="position: relative;">
    <input
      type="text"
      id={id}
      class="form-control {size ? `form-control-${size}` : ''}"
      placeholder={placeholder}
      bind:value={inputValue}
      on:input={onInput}
      on:focus={() => updateSuggestions(inputValue)}
      autocomplete="off"
      style="padding-right: 2rem;"
    />

    {#if inputValue}
      <span
        on:click={clearInput}
        style="
          position: absolute;
          right: 14px;
          top: 0;
          bottom: {label ? '-12px' : '0'};
          margin: auto 0;
          height: {label ? '0.5em' : '1.5em'};
          display: block;
          cursor: pointer;
          color: #999;
          font-size: 18px;
          z-index: 2;
        "
      >
        &times;
      </span>
    {/if}
  </div>

  <!-- Hidden input -->
  <input type="hidden" name={name} value={hiddenValue} />

  <!-- Suggestion box -->
  {#if showSuggestions}
    <div
      class="autocomplete-suggestions"
      style="
        border: 1px solid #ddd;
        border-top: none;
        max-height: 200px;
        overflow-y: auto;
        position: absolute;
        background: white;
        width: 100%;
        z-index: 1000;
        margin-top: 4px;"
    >
      {#each suggestions as item}
        <div
          on:click={() => selectSuggestion(item)}
          style="padding: 8px; cursor: pointer;"
          on:mouseover={(e) => e.currentTarget.style.backgroundColor = '#f0f0f0'}
          on:mouseout={(e) => e.currentTarget.style.backgroundColor = ''}
        >
          {item.name}
        </div>
      {/each}
    </div>
  {/if}
</div>
