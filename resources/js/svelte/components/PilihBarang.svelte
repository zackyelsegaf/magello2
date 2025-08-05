<script>
	export let databarang = [];

	let showModal = false;
	let rowsPerPage = 10;
	let currentPage = 1;
	let filteredData = [...databarang];

	let filterNoBarang = '';
	let filterNamaBarang = '';

	function applyFilter() {
		filteredData = databarang.filter(item => {
			return item.no_barang.toLowerCase().includes(filterNoBarang.toLowerCase()) &&
				item.nama_barang.toLowerCase().includes(filterNamaBarang.toLowerCase());
		});
		currentPage = 1;
	}

	function renderTable(data) {
		const start = (currentPage - 1) * rowsPerPage;
		return data.slice(start, start + rowsPerPage);
	}

	function getPaginationPages(totalPages, currentPage, maxVisible = 5) {
		let pages = [];

		if (totalPages <= maxVisible + 4) {
			for (let i = 1; i <= totalPages; i++) pages.push(i);
			return pages;
		}

		pages.push(1);
		if (currentPage > 3) pages.push('...');

		let start = Math.max(2, currentPage - 1);
		let end = Math.min(totalPages - 1, currentPage + 1);

		for (let i = start; i <= end; i++) pages.push(i);

		if (currentPage < totalPages - 2) pages.push('...');

		pages.push(totalPages);

		return pages;
	}
</script>

<!-- Trigger Button -->
<button class="btn btn-primary mb-3" on:click={() => showModal = true}>
	Pilih Barang
</button>

<!-- Modal -->
{#if showModal}
	<div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Pilih Barang</h5>
					<button type="button" class="close" on:click={() => showModal = false}>
						<span>&times;</span>
					</button>
				</div>

				<div class="modal-body">
					<!-- Filter -->
					<div class="form-inline mb-3">
						<input bind:value={filterNoBarang} type="text" class="form-control form-control-sm mr-2" placeholder="Cari No Barang">
						<input bind:value={filterNamaBarang} type="text" class="form-control form-control-sm mr-2" placeholder="Cari Nama Barang">
						<button type="button" class="btn btn-sm btn-primary" on:click={applyFilter}>Filter</button>
					</div>

					<!-- Table -->
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover table-center mb-0">
							<thead class="thead-dark">
								<tr>
									<th class="text-center" style="width: 10%;">
										<input type="checkbox" id="checkAll">
									</th>
									<th style="padding: 4px;">No. Barang</th>
									<th style="padding: 4px;">Nama Barang</th>
									<th style="padding: 4px;">Satuan</th>
									<th style="padding: 4px;">Kuantitas</th>
								</tr>
							</thead>
							<tbody>
								{#each renderTable(filteredData) as item}
									<tr>
										<td class="text-center">
											<input
												type="checkbox"
												class="check-barang"
												data-id={item.id}
												data-nobarang={item.no_barang}
												data-nama={item.nama_barang}
												data-satuan={item.satuan}
												data-kuantitas={item.kuantitas_saldo_awal}
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

					<!-- Pagination -->
					<div class="d-flex justify-content-between align-items-center mt-3">
						<div class="form-inline">
							<label for="limitSelect" class="mr-2">Tampilkan</label>
							<select id="limitSelect" class="form-control form-control-sm" bind:value={rowsPerPage} on:change={() => currentPage = 1}>
								<option value="10">10</option>
								<option value="25">25</option>
								<option value="50">50</option>
								<option value="100">100</option>
							</select>
							<span class="ml-2">data per halaman</span>
						</div>

						<nav>
							<ul class="pagination pagination-sm mb-0">
								{#each getPaginationPages(Math.ceil(filteredData.length / rowsPerPage), currentPage) as page}
									{#if page === '...'}
										<li class="page-item disabled"><span class="page-link">...</span></li>
									{:else}
										<li class="page-item {page === currentPage ? 'active' : ''}">
											<a href="#" class="page-link" on:click|preventDefault={() => currentPage = page}>{page}</a>
										</li>
									{/if}
								{/each}
							</ul>
						</nav>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-success" on:click={() => showModal = false}>
						Tambah ke Form
					</button>
				</div>
			</div>
		</div>
	</div>
{/if}
