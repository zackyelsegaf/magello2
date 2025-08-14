import { mount } from "svelte";
import Example from "./components/Hello.svelte";
import AutoCompleteInput from "./components/AutoCompleteInput.svelte";
import PilihBarang from "./components/PilihBarang.svelte";

// Ambil elemen dari DOM
const svelteApp = document.getElementById("svelte-app");
const el = document.getElementById("autocomplete-component");
const modalBarang = document.getElementById("modalbarang-svelte");
const data = window.__APP_DATA__ || {};

// Mount Example
if (svelteApp) {
    mount(Example, {
        target: svelteApp,
        props: {
            name: data.name,
        },
    });
}

// Mount AutoCompleteInput
if (modalBarang) {
    mount(PilihBarang, {
        target: modalBarang,
        props: {
            databarang: data.dataBarang,
        },
    });
}

if (el) {
    mount(AutoCompleteInput, {
        target: el,
        props: {
            name: "cek",
        },
    });
}
