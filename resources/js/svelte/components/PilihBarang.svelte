<script>
    export let databarang = [];

    let search_filter = "0";
    let filterNoBarang = "";
    let filterNamaBarang = "";
    let rowsPerPage = 10;
    let currentPage = 1;

    let selectedItems = new Set();
    let filteredData = [];

    $: filteredData = databarang.filter((item) => {
        return (
            item.no_barang
                .toLowerCase()
                .includes(filterNoBarang.toLowerCase()) &&
            item.nama_barang
                .toLowerCase()
                .includes(filterNamaBarang.toLowerCase())
        );
    });

    $: paginatedData = filteredData.slice(
        (currentPage - 1) * rowsPerPage,
        currentPage * rowsPerPage,
    );
    $: totalPages = Math.ceil(filteredData.length / rowsPerPage);

    function changePage(page) {
        currentPage = page;
    }

    function toggleAll(e) {
        if (e.target.checked) {
            filteredData.forEach((item) => selectedItems.add(item.id));
        } else {
            selectedItems.clear();
        }
    }

    function toggleItem(id) {
        if (selectedItems.has(id)) {
            selectedItems.delete(id);
        } else {
            selectedItems.add(id);
        }
    }

    function tambahBarangTerpilih() {
        const selected = databarang.filter((d) => selectedItems.has(d.id));
        console.log("Barang terpilih:", selected);
        // Emit event ke parent jika diperlukan
        // createEventDispatcher bisa digunakan
    }
</script>

<!-- Modal -->
<div
    class="modal fade show d-block"
    tabindex="-1"
    role="dialog"
    aria-labelledby="modalBarangLabel"
>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Barang</h5>
                <button
                    type="button"
                    class="close"
                    on:click={() =>
                        document.body.classList.remove("modal-open")}
                >
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <!-- Filter Radio -->
                <div class="form-inline mb-3">
                    <label class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            bind:group={search_filter}
                            value="0"
                        />
                        <span class="form-check-label">Semua</span>
                    </label>
                    <label class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            bind:group={search_filter}
                            value="1"
                        />
                        <span class="form-check-label">Kategori Barang</span>
                    </label>
                    <label class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            bind:group={search_filter}
                            value="2"
                        />
                        <span class="form-check-label">Tipe Persediaan</span>
                    </label>
                </div>

                <!-- Filter Input -->
                <div class="form-inline mb-3">
                    <input
                        type="text"
                        class="form-control form-control-sm mr-2"
                        placeholder="Cari No Barang"
                        bind:value={filterNoBarang}
                    />
                    <input
                        type="text"
                        class="form-control form-control-sm mr-2"
                        placeholder="Cari Nama Barang"
                        bind:value={filterNamaBarang}
                    />
                    <button
                        class="btn btn-sm btn-primary"
                        on:click={() => {
                            currentPage = 1;
                        }}>Filter</button
                    >
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table
                        class="table table-striped table-bordered table-hover table-center mb-0"
                    >
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center" style="width: 10%">
                                    <input
                                        type="checkbox"
                                        on:change={toggleAll}
                                    />
                                </th>
                                <th style="padding: 4px;">No. Barang</th>
                                <th style="padding: 4px;">Nama Barang</th>
                                <th style="padding: 4px;">Satuan</th>
                                <th style="padding: 4px;">Kuantitas</th>
                            </tr>
                        </thead>
                        <tbody>
                            {#each paginatedData as item}
                                <tr>
                                    <td class="text-center">
                                        <input
                                            type="checkbox"
                                            checked={selectedItems.has(item.id)}
                                            on:change={() =>
                                                toggleItem(item.id)}
                                        />
                                    </td>
                                    <td>{item.no_barang}</td>
                                    <td>{item.nama_barang}</td>
                                    <td>{item.satuan}</td>
                                    <td>{item.kuantitas_saldo_awal}</td>
                                </tr>
                            {/each}
                        </tbody>
                    </table>
                </div>

                <!-- Pagination & Limit -->
                <div
                    class="d-flex justify-content-between align-items-center mt-3"
                >
                    <div class="form-inline">
                        <label class="mr-2">Tampilkan</label>
                        <select
                            bind:value={rowsPerPage}
                            class="form-control form-control-sm"
                            on:change={() => (currentPage = 1)}
                        >
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <span class="ml-2">data per halaman</span>
                    </div>

                    <nav>
                        <ul class="pagination pagination-sm mb-0">
                            {#each Array(totalPages) as _, i}
                                <li
                                    class="page-item {i + 1 === currentPage
                                        ? 'active'
                                        : ''}"
                                >
                                    <a
                                        class="page-link"
                                        href="#"
                                        on:click|preventDefault={() =>
                                            changePage(i + 1)}>{i + 1}</a
                                    >
                                </li>
                            {/each}
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-success" on:click={tambahBarangTerpilih}
                    >Tambah ke Form</button
                >
            </div>
        </div>
    </div>
</div>

<style>
    .modal {
        background-color: rgb(255, 255, 255);
    }
</style>
