import Example from "./components/Hello.svelte";
import { mount } from "svelte";
import AutoCompleteInput from "./components/AutoCompleteInput.svelte";

// Mount ke elemen HTML yang ada di Blade
// Mount komponen ke elemen HTML

const svelteApp = document.getElementById("svelte-app");

if (svelteApp)
mount(Example, {
    target: svelteApp,
    props: {
        // kirim props jika perlu, contoh:
        name: "cek",
    },
});

const el = document.getElementById("autocomplete-component");

if (el) {
    mount(AutoCompleteInput, {
        target: el,
        props: {
            // kirim props jika perlu, contoh:
            name: "cek",
        },
    });
}
