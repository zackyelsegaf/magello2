<script>
	let { showModal = $bindable(), header, children } = $props();
	let dialog = $state(); // HTMLDialogElement
	let visible = $state(false);

	$effect(() => {
		if (showModal) {
			dialog.showModal();
			setTimeout(() => (visible = true), 10); // fade in
		} else if (dialog.open) {
			visible = false; // start fade out
			setTimeout(() => dialog.close(), 300); // match with CSS transition duration
		}
	});
</script>

<!-- svelte-ignore a11y_click_events_have_key_events, a11y_no_noninteractive_element_interactions -->
<dialog
    bind:this={dialog}
    onclose={() => (showModal = false)}
    onclick={(e) => {
        if (e.target === dialog) dialog.close();
    }}
>
    <div>
        {@render header?.()}
        <hr />
        {@render children?.()}
        <hr />
        <!-- svelte-ignore a11y_autofocus -->
        <button autofocus onclick={() => dialog.close()}>close modal</button>
    </div>
</dialog>

<style>
    dialog {
        position: fixed !important; /* Override default */
        top: 50% !important;
        left: 50% !important;
        transform: translate(-50%, -50%) !important;
        max-width: 32em;
        width: 90%;
        border-radius: 0.5em;
        border: none;
        padding: 0;
        margin: 0;
        background: white;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        z-index: 1000;
    }
    dialog::backdrop {
        background: rgba(0, 0, 0, 0.3);
    }
    dialog > div {
        padding: 1em;
    }
    dialog[open] {
        animation: zoom 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    @keyframes zoom {
        from {
            transform: scale(0.95);
        }
        to {
            transform: scale(1);
        }
    }
    dialog[open]::backdrop {
        animation: fade 0.2s ease-out;
    }
    @keyframes fade {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    button {
        display: block;
    }
</style>
