import Example from "./components/Hello.svelte";
import { mount } from "svelte";
import AutoCompleteInput from "./components/AutoCompleteInput.svelte";
import PilihBarang from "./components/PilihBarang.svelte";

// Mount ke elemen HTML yang ada di Blade
// Mount komponen ke elemen HTML

const svelteApp = document.getElementById("svelte-app");
const el = document.getElementById("autocomplete-component");
const modalBarang = document.getElementById('modalbarang-svelte');
const data = window.__APP_DATA__ || {};

if (svelteApp)
mount(Example, {
    target: svelteApp,
    props: {
        // kirim props jika perlu, contoh:
        name: data.name,
    },
});



if (el) {
    mount(AutoCompleteInput, {
        target: el,
        props: {
            // kirim props jika perlu, contoh:
            name: "cek",
        },
    });
}

if (el) {
    mount(PilihBarang, {
        target: modalBarang
    });
}
