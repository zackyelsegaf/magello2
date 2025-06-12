import Example from './components/Hello.svelte';
import { mount } from 'svelte';

// Mount komponen ke elemen HTML
mount(Example, {
	target: document.getElementById('svelte-app'),
	props: {
		// kirim props jika perlu, contoh:
		name: "cek"
	}
});
