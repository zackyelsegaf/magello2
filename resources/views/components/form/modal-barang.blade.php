@props([
    'databarang' => [],
])
<div>
    <div class="modal fade" id="modalBarang" tabindex="-1" role="dialog" aria-labelledby="modalBarangLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Barang</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-inline mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="search_filter" id="filterSemua"
                                value="0" checked>
                            <label class="form-check-label" for="filterSemua">Semua</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="search_filter" id="filterKategori"
                                value="1">
                            <label class="form-check-label" for="filterKategori">Kategori Barang</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="search_filter" id="filterTipe"
                                value="2">
                            <label class="form-check-label" for="filterTipe">Tipe
                                Persediaan</label>
                        </div>
                    </div>
                    <div class="form-inline mb-3">
                        <input type="text" id="filterNoBarang" class="form-control form-control-sm mr-2"
                            placeholder="Cari No Barang">
                        <input type="text" id="filterNamaBarang" class="form-control form-control-sm mr-2"
                            placeholder="Cari Nama Barang">
                        <button type="button" id="filterBtn" class="btn btn-sm btn-primary">Filter</button>
                    </div>
                    <div class="table-responsive">

                        <table class="table table-sm table-striped table-bordered mb-0"
                            style="width: 100%; table-layout: fixed;">
                            <thead class="thead-dark" style="display: table; width: 100%; table-layout: fixed;">
                                <tr>
                                    <th style="width: 5%; text-align: center;"><input type="checkbox" id="checkAll">
                                    </th>
                                    <th style="width: 20%;">No. Barang</th>
                                    <th style="width: 35%;">Nama Barang</th>
                                    <th style="width: 15%;">Satuan</th>
                                    <th style="width: 25%;">Kuantitas</th>
                                </tr>
                            </thead>
                        </table>

                        {{-- Table Body (scrollable) --}}
                        <div style="max-height: 200px; overflow-y: auto;">
                            <table class="table table-sm table-bordered mb-0" style="width: 100%; table-layout: fixed;">
                                <tbody id="barang-body" style="display: table; width: 100%; table-layout: fixed;">
                                    {{-- diisi via JS --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <!-- Limit Selector -->
                        <div class="form-inline">
                            <label for="limitSelect" class="mr-2">Tampilkan</label>
                            <select id="limitSelect" class="form-control form-control-sm">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <span class="ml-2">data per halaman</span>
                        </div>

                        <!-- Pagination -->
                        <nav>
                            <ul class="pagination pagination-sm mb-0" id="pagination-bar"></ul>
                        </nav>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="tambahBarangTerpilih">Tambah ke Form</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const allData = @json($databarang);
    let rowsPerPage = 10;
    let currentPage = 1;
    let filteredData = [...allData];

    function renderTable(data) {
        const tbody = document.getElementById('barang-body');
        tbody.innerHTML = '';

        const start = (currentPage - 1) * rowsPerPage;
        const paginatedItems = data.slice(start, start + rowsPerPage);

        paginatedItems.forEach(item => {
            const row = `
                <tr>
                    <td class="text-center">
                        <input type="checkbox"
                            class="check-barang"
                            data-id="${item.id}"
                            data-nobarang="${item.no_barang}"
                            data-nama="${item.nama_barang}"
                            data-satuan="${item.satuan}"
                            data-kuantitas="${item.kuantitas_saldo_awal}">
                    </td>
                    <td>${item.no_barang}</td>
                    <td>${item.nama_barang}</td>
                    <td>${item.satuan}</td>
                    <td>${item.kuantitas_saldo_awal}</td>
                </tr>
            `;
            tbody.insertAdjacentHTML('beforeend', row);
        });
    }

    function renderPagination(data) {
        const totalPages = Math.ceil(data.length / rowsPerPage);
        const pagination = document.getElementById('pagination-bar');
        pagination.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            const li = document.createElement('li');
            li.className = 'page-item' + (i === currentPage ? ' active' : '');
            li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
            li.addEventListener('click', function(e) {
                e.preventDefault();
                currentPage = i;
                renderTable(filteredData);
                renderPagination(filteredData);
            });
            pagination.appendChild(li);
        }
    }

    function applyFilter() {
        const noBarangVal = document.getElementById('filterNoBarang').value.toLowerCase();
        const namaBarangVal = document.getElementById('filterNamaBarang').value.toLowerCase();

        filteredData = allData.filter(item => {
            return item.no_barang.toLowerCase().includes(noBarangVal) &&
                item.nama_barang.toLowerCase().includes(namaBarangVal);
        });

        currentPage = 1;
        renderTable(filteredData);
        renderPagination(filteredData);
    }

    document.getElementById('filterBtn').addEventListener('click', function(e) {
        e.preventDefault(); // cegah submit form
        applyFilter(); // jalankan filter manual via JS
    });

    document.getElementById('limitSelect').addEventListener('change', function() {
        rowsPerPage = parseInt(this.value);
        currentPage = 1;
        renderTable(filteredData);
        renderPagination(filteredData);
    });

    // Inisialisasi
    renderTable(filteredData);
    renderPagination(filteredData);
</script>
