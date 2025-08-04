<script>
    import Button from '../../$lib/components/ui/button/button.svelte'; // sesuaikan path relatif

    export let name = "Svelte";

    function greet() {
        alert(name);
    }
</script>

<!-- Gunakan komponen Button dari shadcn-svelte -->
<Button>
    <div on:click={greet}>Click Me</div>
</Button>
<input type="text" name="field1" value="{name}" />
<style>
    h1 {
        font-size: 2em;
        margin-top: 1em;
    }
</style>