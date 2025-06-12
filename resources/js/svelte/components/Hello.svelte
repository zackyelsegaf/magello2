<script>
    import Button from '../../$lib/components/ui/button/button.svelte'; // sesuaikan path relatif

    export let name = "Svelte";

    function greet() {
        alert('Welcome to Svelte!');
    }
</script>

<!-- Gunakan komponen Button dari shadcn-svelte -->
<Button on:click={greet}>
    <div >Click Me</div>
</Button>

<h1>Hello {name}!</h1>

<style>
    h1 {
        font-size: 2em;
        margin-top: 1em;
    }
</style>