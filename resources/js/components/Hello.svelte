<script>
    export let name = "Svelte";

    function greet() {
		alert('Welcome to Svelte!');
	}

    // let count = $state(0);

</script>

<button onclick={greet}>click me</button>

<!-- <button onclick={() => count++}>
	clicks: {count}
</button> -->

<style>
	button {
		font-size: 2em;
	}
</style>

<h1>Hello {name}!</h1>