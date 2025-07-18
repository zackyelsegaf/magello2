import Example from './components/Hello.svelte';
import { mount } from 'svelte';


// Mount ke elemen HTML yang ada di Blade
// Mount komponen ke elemen HTML
mount(Example, {
	target: document.getElementById('svelte-app'),
	props: {
		// kirim props jika perlu, contoh:
		name: "cek"
	}
});

import AutoCompleteInput from './components/AutoCompleteInput.svelte';

const el = document.getElementById('autocomplete-component');

mount(Example, {
	target: el,
	props: {
		// kirim props jika perlu, contoh:
		name: "cek"
	}
});
