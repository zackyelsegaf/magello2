<x-layout.main>
    <x-slot:title>
        {{ $title }} Penjualan
    </x-slot>
    <form id="form">
        <div class="page-wrapper position-relative" style="padding-bottom: 80px;"> {{-- padding bawah agar konten tidak tertutup footer --}}

            <div class="content container-fluid">
                <div class="page-header mt-5">
                    <div class="d-flex justify-content-between align-items-start w-100">
                        {{-- Kolom kiri --}}
                        <div class="d-flex flex-column">
                            <h4 class="card-title mb-2">Data {{ $title }} Penjualan</h4>
                            <div id="svelte-app"></div>
                            <div id="autocomplete-component" data-pelanggan='@json($pelanggans)'
                                data-selected='@json(['id' => 1, 'name' => 'John Doe', 'alamat' => 'Jl. Merdeka'])'></div>
                            {{-- <x-combo-auto-fill size="sm" id="pelanggan" placeholder="Pilih pelanggan..."
                                :data="$pelanggans" name="pelanggan_id" :autofill="[
                                    'alamat' => 'alamat-input',
                                    'telepon' => 'telp-input',
                                ]" /> --}}
                        </div>
                        <div class="d-flex flex-column">
                            <div class="d-flex justify-content-end">
                                <div class="form-check me-3">
                                    <input type="checkbox" class="form-check-input" name="Pajak" value="Pajak"
                                        id="Pajak">
                                    <label class="form-check-label" for="Pajak">Pajak</label>
                                </div>
                                &nbsp;
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="inPajak" value="inPajak"
                                        id="inPajak">
                                    <label class="form-check-label" for="inPajak">Termasuk Pajak</label>
                                </div>
                                &nbsp;
                            </div>

                            <div class="d-flex justify-content-between gap-3">
                                {{-- Input 1 --}}
                                <div class="d-flex flex-column me-2" style="min-width: 0; flex: 1;">
                                    <label for="inputGmp1" class="form-label mb-1">No. {{ $title }}</label>
                                    <div class="input-group input-group-sm">
                                        <input value="{{ $no }}" id="no_penawaran" name="no_penawaran"
                                            type="text" class="form-control" placeholder="Ketik sesuatu..." readonly>
                                        <button class="btn btn-outline-secondary btn-sm" type="button"
                                            onclick="location.reload()">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                    </div>
                                </div>

                                &nbsp;
                                {{-- Input 2 --}}
                                <div class="d-flex flex-column" style="min-width: 0; flex: 1;">
                                    <label for="inputGmp2" class="form-label mb-1">Tanggal {{ $title }}</label>
                                    <div class="input-group input-group-sm">
                                        <input type="text"
                                            class="form-control datetimepicker @error('tgl_permintaan') is-invalid @enderror"
                                            name="tgl_permintaan">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div id="tableContainer" class="col-md-12" style="transition: width 0.3s;">

                        <div style="width: 100%;">
                            <div class="tab-content profile-tab-cont">
                                <div class="profile-menu">
                                    <ul class="nav nav-tabs nav-tabs-solid">
                                        <li class="nav-item">
                                            <a class="nav-link active font-weight-bold" data-toggle="tab"
                                                href="#rincian">Rincian</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#informasi">Informasi
                                                Lainnya</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#dokumen">Dokumen</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#ricape">Rincian Catatan
                                                Pemeriksaan</a>
                                        </li>
                                    </ul>
                                </div>
                                <div id="rincian" class="tab-pane fade show active">
                                    <div class="row float-right mr-0">
                                        <button type="button" class="btn btn-primary buttonedit mb-3"
                                            id="btnTambahBarang">Tambah</button>
                                    </div>
                                    <!-- Modal -->
                                    <x-form.modal-barang :databarang=$nama_barang />
                                    <div class="table-responsive"
                                        style="max-height: calc(100vh - 250px); overflow-y: auto; margin-bottom: 100px;">
                                        <table class="table table-striped table-bordered table-hover table-center mb-0"
                                            id="DataBarangAddSatuan">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th style="width: 250px;">Deskripsi Barang</th>
                                                    <th style="width: 100px;">Kuantitas</th>
                                                    <th style="width: 100px;">Satuan</th>
                                                    <th style="width: 150px;">Harga Satuan</th>
                                                    <th style="width: 100px;">Diskon %</th>
                                                    <th style="width: 100px;">Pajak</th>
                                                    <th style="width: 150px;">Jumlah</th>
                                                    <th style="width: 100px;">Kuantitas Dikirim</th>
                                                    <th style="width: 150px;">Departemen</th>
                                                    <th style="width: 150px;">Proyek</th>
                                                    <th style="width: 100px;">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody id="barangTableBody">
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div id="dokumen" class="tab-pane fade">

                                    <div class="row">
                                        <div class="col-lg-10">
                                            <x-dynamic-link-input id="file-input-1" name="files" />
                                        </div>
                                    </div>
                                </div>
                                <div id="ricape" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="dd"></div>
                                                        <div class="checkbox-wrapper-4">
                                                            <input type="hidden" name="tindak_lanjut_check"
                                                                value="0">
                                                            <input class="inp-cbx" name="tindak_lanjut_check"
                                                                id="tindak_lanjut_check" type="checkbox"
                                                                value="1"
                                                                {{ old('tindak_lanjut_check') ? 'checked' : '' }}>
                                                            <label class="cbx" for="tindak_lanjut_check">
                                                                <span><svg width="12px" height="10px">
                                                                        <use xlink:href="#check-4"></use>
                                                                    </svg></span>
                                                                <span><strong>Tindak Lanjut</strong></span>
                                                            </label>
                                                            <svg class="inline-svg">
                                                                <symbol id="check-4" viewbox="0 0 12 10">
                                                                    <polyline points="1.5 6 4.5 9 10.5 1">
                                                                    </polyline>
                                                                </symbol>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="dd"></div>
                                                        <div class="checkbox-wrapper-4">
                                                            <input type="hidden" name="urgent_check" value="0">
                                                            <input class="inp-cbx" name="urgent_check"
                                                                id="urgent_check" type="checkbox" value="1"
                                                                {{ old('urgent_check') ? 'checked' : '' }}>
                                                            <label class="cbx" for="urgent_check">
                                                                <span><svg width="12px" height="10px">
                                                                        <use xlink:href="#check-4"></use>
                                                                    </svg></span>
                                                                <span><strong>Urgent</strong></span>
                                                            </label>
                                                            <svg class="inline-svg">
                                                                <symbol id="check-4" viewbox="0 0 12 10">
                                                                    <polyline points="1.5 6 4.5 9 10.5 1">
                                                                    </polyline>
                                                                </symbol>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <textarea style="width: 300px; height:100px;" class="form-control" name="deskripsi_1" placeholder="Deskripsi">{{ old('deskripsi_1') }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="dd"></div>
                                                        <div class="checkbox-wrapper-4">
                                                            <input type="hidden" name="catatan_pemeriksaan_check"
                                                                value="0">
                                                            <input class="inp-cbx" name="catatan_pemeriksaan_check"
                                                                id="catatan_pemeriksaan_check" type="checkbox"
                                                                value="1"
                                                                {{ old('catatan_pemeriksaan_check') ? 'checked' : '' }}>
                                                            <label class="cbx" for="catatan_pemeriksaan_check">
                                                                <span><svg width="12px" height="10px">
                                                                        <use xlink:href="#check-4"></use>
                                                                    </svg></span>
                                                                <span><strong>Catatan Pemeriksaan</strong></span>
                                                            </label>
                                                            <svg class="inline-svg">
                                                                <symbol id="check-4" viewbox="0 0 12 10">
                                                                    <polyline points="1.5 6 4.5 9 10.5 1">
                                                                    </polyline>
                                                                </symbol>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea style="width: 300px; height:100px;" class="form-control" name="deskripsi_2"
                                                            value="{{ old('deskripsi_2') }}" placeholder="Deskripsi">{{ old('deskripsi_2') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="informasi" class="tab-pane fade">
                                    <div class="row mt-0 mb-0">
                                        <div class="col">
                                            <div class="row mb-0 mt-0">
                                                <div class="col">

                                                    <div class="form-group">
                                                        <label for="Informasi_address"><strong>Alamat</strong></label>
                                                        <textarea readonly class="form-control" name="address" id="alamat-input" rows="4"
                                                            placeholder="Alamat tujuan">{{ old('address') }}</textarea>
                                                    </div>

                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="Informasi_address"><strong>Alamat</strong></label>
                                                        <textarea readonly class="form-control" name="address" id="alamat-input" rows="4"
                                                            placeholder="Alamat tujuan">{{ old('address') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="font-bold" for="inputGmp2"
                                                            class="form-label mb-1">Tanggal
                                                            {{ $title }}</label>
                                                        <div class="input-group input-group-sm">
                                                            <input type="text"
                                                                class="form-control datetimepicker @error('tgl_permintaan') is-invalid @enderror"
                                                                name="tgl_permintaan">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <x-select2.search size="sm" placeholder="nilai tukar"
                                                            name="nilai_tukar" label="Nilai Tukar"
                                                            :options="$penjuals" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <x-form.select-basic placeholder="   " size="sm"
                                                            id="syarat_pembayaran" name="syarat_pembayaran"
                                                            :options="$syaratPembayaran" :isbold="true"
                                                            label="Syarat Pembayaran" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    &nbsp;
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <x-form.select-basic placeholder="   " size="sm"
                                                            id="ekspedisi" name="ekspedisi" :options="$syaratPembayaran"
                                                            :isbold="true" label="Kirim Melalui" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <x-select2.search size="sm" placeholder="Penjual"
                                                            name="penjual" label="Penjual" :options="$penjuals" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <x-form.select-basic placeholder="   " size="sm"
                                                            id="fob" name="fob" :options="$syaratPembayaran"
                                                            :isbold="true" label="FOB" />
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    &nbsp;
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            &nbsp;
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    &nbsp;
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <x-form.modul.penjualan.footer-action-add>
                <x-slot:action>
                    id="simpanTransaksi"
                </x-slot:action>
            </x-form.modul.penjualan.footer-action-add>
    </form>
    <x-slot:scripts>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const pajakCheckbox = document.getElementById('Pajak');
                const labelInPajak = document.getElementById('labelInPajak');
                const inPajakCheckbox = document.getElementById('inPajak');
                const pajakFields = document.getElementById('pajakFields');

                function togglePajakFields() {
                    if (pajakCheckbox.checked) {
                        pajakFields.style.display = 'block';
                    } else if (inPajakCheckbox.checked) {
                        labelInPajak.style.display = 'block';
                        pajakFields.style.display = 'none';
                    } else {
                        labelInPajak.style.display = 'none';
                        pajakFields.style.display = 'none';
                    }
                }

                // Pasang event listener
                pajakCheckbox.addEventListener('change', togglePajakFields);
                inPajakCheckbox.addEventListener('change', togglePajakFields);
                document.getElementById('inPajak').addEventListener('change', hitungGrandTotal);
                document.getElementById('pajak').addEventListener('change', hitungGrandTotal);

                // Jalankan saat awal
                togglePajakFields();
            });

            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('btnTambahBarang').addEventListener('click', function() {
                    // Ambil nilai input hidden yang menyimpan ID pelanggan
                    const pelangganId = document.querySelector('input[name="pelanggan_id"]')?.value;

                    if (!pelangganId) {
                        // Bisa pakai alert() atau Swal
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            text: 'Silahkan pilih pelanggan terlebih dahulu',
                        });
                        return;
                    }

                    // Jika pelanggan sudah dipilih, buka modal
                    $('#modalBarang').modal('show');
                });
            });
            $('#simpanTransaksi').click(async function() {
                const result = await saveTransaksi();

                if (result.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: result.message || 'Data berhasil disimpan!',
                    }).then(() => {
                        // Redirect setelah klik "OK"
                        window.location.href =
                            "{{ route('penjualan.penawaran.index') }}"; // Ganti dengan URL yang kamu inginkan
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ada Kendala',
                        text: result.message || 'Silahkan hubungi developer',
                    })
                }
            });

            document.getElementById('barangTableBody').addEventListener('input', function(e) {
                const target = e.target;

                if (
                    target.name === 'kts_permintaan[]' ||
                    target.name === 'harga_satuan[]' ||
                    target.name === 'diskon[]' ||
                    target.name === 'pajak[]'
                ) {
                    const row = target.closest('tr');

                    const qtyInput = row.querySelector('input[name="kts_permintaan[]"]');
                    const hargaInput = row.querySelector('input[name="harga_satuan[]"]');
                    const jumlahInput = row.querySelector('input[name="jumlah[]"]');
                    const diskonInput = row.querySelector('input[name="diskon[]"]');
                    const pajakInput = row.querySelector('input[name="pajak[]"]');

                    if (!qtyInput || !hargaInput || !jumlahInput) return;

                    // Ambil dan parse input dengan perlindungan
                    const qty = parseFloat((qtyInput.value || '0')) || 0;
                    const harga = parseRupiahToFloat(hargaInput.value || '0');
                    const diskon = parseFloat((diskonInput?.value || '0').replace(',', '.')) || 0;
                    const pajak = parseFloat((pajakInput?.value || '0').replace(',', '.')) || 0;

                    // Hitung total dasar
                    let total = qty * harga;

                    // Kurangi diskon
                    if (diskon > 0) {
                        total -= (total * diskon) / 100;
                    }

                    // Tambahkan pajak
                    if (pajak > 0) {
                        total += (total * pajak) / 100;
                    }

                    // Tampilkan hasil akhir dalam format Rupiah
                    jumlahInput.value = formatRupiah(total);

                    // Update subtotal keseluruhan
                    if (typeof updateSubtotal === 'function') {
                        updateSubtotal();
                    }
                }
            });


            function updateSubtotal() {
                let subtotal = 0;

                document.querySelectorAll('input[name="jumlah[]"]').forEach(input => {
                    subtotal += parseRupiahToFloat(input.value) || 0;
                });

                const subtotalInput = document.querySelector('input[name="subtotal"]');
                document.querySelector('input[name="cashdiscpc"]').addEventListener('input', hitungGrandTotal);
                if (subtotalInput) {
                    subtotalInput.value = formatRupiah(subtotal.toFixed(2));
                    hitungGrandTotal();
                }
            }

            function hitungGrandTotal() {
                const subtotalInput = document.querySelector('input[name="subtotal"]');
                const discPcInput = document.querySelector('input[name="cashdiscpc"]');
                const discNominalInput = document.querySelector('input[name="cashdiscount"]');
                const ppnInput = document.querySelector('input[name="ppn"]');
                const pajak2Input = document.querySelector('input[name="pajak2"]');
                const inPajakCheckbox = document.querySelector('input[name="inPajak"]');
                const totalInput = document.querySelector('input[name="total"]');

                const subtotal = parseRupiahToFloat(subtotalInput?.value) || 0;
                console.log(subtotal);
                const discPercent = parseFloat(discPcInput?.value) || 0;

                // Hitung diskon nominal
                const discNominal = subtotal * (discPercent / 100);
                if (discNominalInput) {
                    discNominalInput.value = discNominal.toFixed(2);
                }

                // Hitung nilai setelah diskon
                const afterDisc = subtotal - discNominal;

                // Hitung PPN 11%
                const ppn = afterDisc * 0.11;
                if (ppnInput) {
                    ppnInput.value = ppn.toFixed(2);
                }

                // Hitung Pajak 2% (jika perlu sesuaikan rate)
                const pajak2 = afterDisc * 0.02;
                if (pajak2Input) {
                    pajak2Input.value = pajak2.toFixed(2);
                }

                let grandTotal;

                if (inPajakCheckbox.checked) {
                    grandTotal = afterDisc;
                } else {
                    grandTotal = afterDisc + ppn + pajak2;
                }

                // Hitung total keseluruhan

                if (totalInput) {
                    totalInput.value = formatRupiah(grandTotal.toFixed(2));
                }


            }

            async function saveTransaksi() {
                const form = document.getElementById('form');
                const formData = new FormData(form);

                try {
                    const response = await fetch("{{ $storeRoute }}", {
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: formData
                    });

                    const result = await response.json(); // parse response JSON

                    // Cek nilai 'success' dari response JSON, bukan hanya HTTP status
                    return {
                        success: result.success,
                        message: result.message,
                        data: result.data || null
                    };

                } catch (error) {
                    console.error('Terjadi kesalahan:', error);
                    return {
                        success: false,
                        message: 'Gagal menyimpan transaksi.'
                    };
                }
            }

            $(document).ready(function() {
                $('#checkAll').click(function() {
                    $('.check-barang').prop('checked', this.checked);
                });

                $('#tambahBarangTerpilih').click(function() {
                    $('.check-barang:checked').each(function() {
                        let id = $(this).data('id');
                        let nobarang = $(this).data('nobarang');
                        let nama = $(this).data('nama');
                        let satuan = $(this).data('satuan');

                        // Cek jika row dengan ID sudah ada
                        if ($(`#row-barang-${id}`).length === 0) {
                            let newRow = `
<tr id="row-barang-${id}" class="barang-row" style="font-size: 12px; height: 26px;">
    <td style="height: 26px;">
        <input type="text" class="form-control" name="deskripsi_barang[]" value="${nama}" style="font-size:12px; height: 26px;">
    </td>
    <td style="height: 26px;">
        <input type="number" class="form-control" name="kts_permintaan[]" style="font-size:12px; height: 26px;">
    </td>
    <td style="height: 26px;">
        <input type="text" class="form-control" name="satuan[]" value="${satuan}" style="font-size:12px; height: 26px;">
    </td>
    <td style="height: 26px;">
        <input type="text" class="form-control input-rupiah" name="harga_satuan[]" style="font-size:12px; height: 26px;">
    </td>
    <td style="height: 26px;">
        <input type="text" class="form-control" name="diskon[]" style="font-size:12px; height: 26px;">
    </td>
    <td style="height: 26px;">
        <input type="text" class="form-control" name="pajak[]" style="font-size:12px; height: 26px;">
    </td>
    <td style="height: 26px;">
        <input type="text" class="form-control input-rupiah" name="jumlah[]" readonly style="font-size:12px; height: 26px;">
    </td>
    <td style="height: 26px;">
        <input type="number" class="form-control" name="kuantitas_dikirim[]" style="font-size:12px; height: 26px;">
    </td>
    <td style="height: 26px;">
        <input type="text" class="form-control" name="departemen[]" style="font-size:12px; height: 26px;">
    </td>
    <td style="height: 26px;">
        <input type="text" class="form-control" name="proyek[]" style="font-size:12px; height: 26px;">
    </td>
    <td style="height: 26px;">
        <button type="button" class="btn btn-danger btn-sm remove-row" style="font-size:12px; height: 26px;">
            <i class="fas fa-trash-alt"></i>
        </button>
    </td>
</tr>`;
                            $('#barangTableBody').append(newRow);
                            // Disable checkbox agar tidak dipilih ulang
                            $(this).prop('disabled', true).prop('checked', false);
                        } else {
                            // Optional: uncheck jika sudah ada agar tidak membingungkan
                            $(this).prop('checked', false);
                        }
                    });

                    $('#modalBarang').modal('hide');
                });

                $(document).on('click', '.remove-row', function() {
                    const row = $(this).closest('tr');
                    const id = row.attr('id')?.replace('row-barang-', '');
                    if (id) {
                        // Re-enable checkbox ketika baris dihapus
                        $(`.check-barang[data-id="${id}"]`).prop('disabled', false);
                    }
                    row.remove();
                });
            });
        </script>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const checkbox = document.getElementById('tindak_lanjut_check');
                const kolomNilai = document.querySelectorAll('.kolom-nilai');

                function toggleKolomNilai() {
                    const show = checkbox.checked;
                    kolomNilai.forEach(kolom => {
                        kolom.style.display = show ? '' : 'none';
                    });
                }

                toggleKolomNilai();
                checkbox.addEventListener('change', toggleKolomNilai);
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const checkbox = document.getElementById('urgent_check');
                const kolomNilai = document.querySelectorAll('.kolom-nilai');

                function toggleKolomNilai() {
                    const show = checkbox.checked;
                    kolomNilai.forEach(kolom => {
                        kolom.style.display = show ? '' : 'none';
                    });
                }

                toggleKolomNilai();
                checkbox.addEventListener('change', toggleKolomNilai);
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const checkbox = document.getElementById('catatan_pemeriksaan_check');
                const kolomNilai = document.querySelectorAll('.kolom-nilai');

                function toggleKolomNilai() {
                    const show = checkbox.checked;
                    kolomNilai.forEach(kolom => {
                        kolom.style.display = show ? '' : 'none';
                    });
                }

                toggleKolomNilai();
                checkbox.addEventListener('change', toggleKolomNilai);
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const namaBarangSelect = document.getElementById('namaBarangSelect');
                const deskripsiBarangInput = document.getElementById('deskripsiBarangInput');
                const kuantitasBarangInput = document.getElementById('kuantitasBarangInput');
                const satuanSelect = document.getElementById('satuanSelect');

                namaBarangSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    deskripsiBarangInput.value = selectedOption.getAttribute('data-nama') || '';
                    kuantitasBarangInput.value = selectedOption.getAttribute('data-kts') || '';
                    satuanSelect.value = selectedOption.getAttribute('data-satuan') || '';
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const noAkunSelect = document.getElementById('noAkunSelect');
                const namaAkunSelect = document.getElementById('namaAkunSelect');

                noAkunSelect.addEventListener('change', function() {
                    const selectedNo = this.value;
                    const nama = this.options[this.selectedIndex].getAttribute('data-nama');

                    for (let i = 0; i < namaAkunSelect.options.length; i++) {
                        if (namaAkunSelect.options[i].value === nama) {
                            namaAkunSelect.selectedIndex = i;
                            break;
                        }
                    }
                });

                namaAkunSelect.addEventListener('change', function() {
                    const selectedNama = this.value;
                    const no = this.options[this.selectedIndex].getAttribute('data-no');

                    for (let i = 0; i < noAkunSelect.options.length; i++) {
                        if (noAkunSelect.options[i].value === no) {
                            noAkunSelect.selectedIndex = i;
                            break;
                        }
                    }
                });
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const checkbox = document.getElementById("sub_barang_check");
                const tipeAkunForm = document.getElementById("tipe_barang_form");

                function toggleTipeAkunForm() {
                    if (checkbox.checked) {
                        tipeAkunForm.style.display = "block";
                    } else {
                        tipeAkunForm.style.display = "none";
                    }
                }

                toggleTipeAkunForm();

                checkbox.addEventListener("change", toggleTipeAkunForm);
            });
        </script>
        <script>
            $(function() {
                $('#datetimepicker3').datetimepicker({
                    format: 'LT'
                });
            });
        </script>
    </x-slot:scripts>
</x-layout.main>
