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
                    <div class="table-responsive" style="width: 100%;">
                        <table class="table table-striped table-bordered table-hover table-center mb-0"
                            id="tabelPilihBarang" style="margin: 0; border-collapse: collapse; width: 100%;">
                            <thead class="thead-dark">
                                <tr style="padding: 0; margin: 0;">
                                    <th style="width: 10%" class="text-center">
                                        <input type="checkbox" id="checkAll">
                                    </th>
                                    <th style="padding: 4px;">No. Barang</th>
                                    <th style="padding: 4px;">Nama Barang</th>
                                    <th style="padding: 4px;">Satuan</th>
                                    <th style="padding: 4px;">Kuantitas</th>
                                </tr>
                            </thead>
                            <tbody id="barang-body"></tbody>
                        </table>
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
    let checkedItems = new Set();
    let rowsPerPage = 10;
    let currentPage = 1;
    let filteredData = [...allData];

    function renderTable(data) {
        const tbody = document.getElementById('barang-body');
        tbody.innerHTML = '';

        const start = (currentPage - 1) * rowsPerPage;
        const paginatedItems = data.slice(start, start + rowsPerPage);

        paginatedItems.forEach(item => {
            const isChecked = checkedItems.has(item.id) ? 'checked' : '';
            const row = `
            <tr>
                <td class="text-center">
                    <input type="checkbox"
                        class="check-barang"
                        data-id="${item.id}"
                        data-nobarang="${item.no_barang}"
                        data-nama="${item.nama_barang}"
                        data-satuan="${item.satuan}"
                        data-kuantitas="${item.kuantitas_saldo_awal}"
                        ${isChecked}>
                </td>
                <td>${item.no_barang}</td>
                <td>${item.nama_barang}</td>
                <td>${item.satuan}</td>
                <td>${item.kuantitas_saldo_awal}</td>
            </tr>
        `;
            tbody.insertAdjacentHTML('beforeend', row);
        });

        // Setelah render, pasang ulang event listener
        document.querySelectorAll('.check-barang').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const id = parseInt(this.dataset.id);
                if (this.checked) {
                    checkedItems.add(id);
                } else {
                    checkedItems.delete(id);
                }
            });
        });
        
        document.getElementById('checkAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.check-barang');
            checkboxes.forEach(cb => {
                cb.checked = this.checked;
                const id = parseInt(cb.dataset.id);
                if (this.checked) {
                    checkedItems.add(id);
                } else {
                    checkedItems.delete(id);
                }
            });
        });
    }

    function renderPagination(data) {
        const totalPages = Math.ceil(data.length / rowsPerPage);
        const pagination = document.getElementById('pagination-bar');
        pagination.innerHTML = '';

        function createPageItem(page) {
            const li = document.createElement('li');
            li.className = 'page-item' + (page === currentPage ? ' active' : '');
            li.innerHTML = `<a class="page-link" href="#">${page}</a>`;
            li.addEventListener('click', function(e) {
                e.preventDefault();
                currentPage = page;
                renderTable(filteredData);
                renderPagination(filteredData);
            });
            return li;
        }

        function createEllipsis() {
            const li = document.createElement('li');
            li.className = 'page-item disabled';
            li.innerHTML = `<span class="page-link">...</span>`;
            return li;
        }

        const maxPagesToShow = 5;
        const startPage = Math.max(currentPage - 2, 2);
        const endPage = Math.min(currentPage + 2, totalPages - 1);

        if (totalPages <= 1) return;

        // Always show first page
        pagination.appendChild(createPageItem(1));

        // Ellipsis before middle range
        if (startPage > 2) {
            pagination.appendChild(createEllipsis());
        }

        // Middle range
        for (let i = startPage; i <= endPage; i++) {
            pagination.appendChild(createPageItem(i));
        }

        // Ellipsis after middle range
        if (endPage < totalPages - 1) {
            pagination.appendChild(createEllipsis());
        }

        // Always show last page
        if (totalPages > 1) {
            pagination.appendChild(createPageItem(totalPages));
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
