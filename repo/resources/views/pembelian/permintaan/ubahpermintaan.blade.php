@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Edit Permintaan Pembelian - <span id="statusBadge"></span></h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('pembelian/permintaan/update', $permintaanPembelian->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="row checkbox-row-mobile-horizontal">
                                <div class="col-md-4 p-2">
                                    <div class="form-group">
                                        <div class="dd"></div>
                                        <div class="checkbox-wrapper-4">
                                            <input type="hidden" name="disetujui_check" value="0">
                                            <input class="inp-cbx" name="disetujui_check" id="disetujui_check" type="checkbox" value="1" {{ old('disetujui_check', $permintaanPembelian->disetujui_check) ? 'checked' : '' }} disabled>
                                            <label class="cbx" for="disetujui_check">
                                                <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                <span><strong>Disetujui</strong></span>
                                            </label>
                                            <svg class="inline-svg">
                                                <symbol id="check-4" viewbox="0 0 12 10">
                                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                </symbol>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 p-2">
                                    <div class="form-group">
                                        <div class="dd"></div>
                                        <div class="checkbox-wrapper-4">
                                            <input type="hidden" name="tutup_check_all" value="0">
                                            <input class="inp-cbx" name="tutup_check_all" id="tutup_check_all" type="checkbox" value="1" {{ old('tutup_check_all', $permintaanPembelian->detail2->tutup_check_all) ? 'checked' : '' }}>
                                            <label class="cbx" for="tutup_check_all">
                                                <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                <span><strong>Tutup</strong></span>
                                            </label>
                                            <svg class="inline-svg">
                                                <symbol id="check-4" viewbox="0 0 12 10">
                                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                </symbol>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <h5 class="card-title">Change Password</h5> --}}
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No. Permintaan</label>
                                                <input type="text" class="form-control" id="no_permintaan" name="no_permintaan" value="{{ $permintaanPembelian->no_permintaan }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="persetujuan-field" style="display: none;">
                                            <div class="form-group">
                                                <label>No. Persetujuan</label>
                                                <input type="text" class="form-control" name="no_persetujuan" value="{{ $permintaanPembelian->no_persetujuan }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Permintaan</label>
                                                <div class="cal-icon">
                                                    <input type="text" class="form-control datetimepicker @error('tgl_permintaan') is-invalid @enderror" name="tgl_permintaan" value="{{ $permintaanPembelian->tgl_permintaan }}"> 
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" style="display: none">
                                            <label>Pengguna</label>
                                            <input type="text" class="form-control" name="pengguna_permintaan" value="{{ $permintaanPembelian->pengguna_permintaan }}">
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" style="display: none">
                                            <label>Status</label>
                                            <input type="text" class="form-control" name="status_permintaan" id="status_permintaan" value="Menunggu">
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Proyek</label>
                                                <select class="form-control" name="proyek">
                                                    <option disabled selected>Pilih Proyek</option>
                                                    @foreach ($proyek as $items)
                                                        <option value="{{ $items->nama_proyek }}" {{ old('proyek', $permintaanPembelian->proyek) == $items->nama_proyek ? 'selected' : '' }}>
                                                            {{ $items->proyek_id . ' - ' . $items->nama_proyek }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>                                    
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Gudang</label>
                                                <select class="form-control"  name="gudang">
                                                    <option disabled selected></option>
                                                    @foreach ($gudang as $items)
                                                    <option value="{{ $items->nama_gudang }}" {{ old('gudang', $permintaanPembelian->gudang) == $items->nama_gudang ? 'selected' : '' }}>{{ $items->nama_gudang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Catatan</label>
                                                <textarea class="form-control" name="deskripsi_permintaan" placeholder="Deskripsi">{{ old('deskripsi_permintaan', $permintaanPembelian->deskripsi_permintaan) }}</textarea> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Departemen</label>
                                                <select class="form-control"  name="departemen">
                                                    <option disabled selected></option>
                                                    @foreach ($departemen as $items )
                                                    <option value="{{ $items->nama_departemen }}" {{ old('departemen', $permintaanPembelian->departemen) == $items->nama_departemen ? 'selected' : '' }}>{{ $items->nama_departemen }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content profile-tab-cont">
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item"> 
                                <a class="nav-link active font-weight-bold" data-toggle="tab" href="#rincian">Rincian</a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#ricape">Rincian Catatan Pemeriksaan</a> 
                            </li>
                        </ul>
                    </div>
                    <div id="rincian" class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                {{-- <div class="row float-right mr-0">
                                    <button type="button" class="btn btn-primary buttonedit mb-3" id="tambahBarangBtn"><strong><i class="fas fa-cube mr-3 ml-1"></i>Tambah</strong></button>
                                </div> --}}
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-center mb-0" id="DataBarangAddSatuan">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No. Barang</th>
                                                <th>Deskripsi Barang</th>
                                                <th>Kts Permintaan</th>
                                                <th>Satuan</th>
                                                <th>Harga Satuan</th>
                                                <th>Jumlah</th>
                                                <th>Catatan</th>
                                                <th>Tgl. Diminta</th>
                                                <th>Kts Dipesan</th>
                                                <th>Kts Diterima</th>
                                                <th>Tutup</th>
                                            </tr>
                                        </thead>
                                        <tbody id="barangTableBody">
                                             <tbody id="barangTableBody">
                                                @foreach ($permintaanPembelian->detail as $index => $detail)
                                                <tr class="barang-row">
                                                    <td><input type="text" name="no_barang[]" class="form-control form-control-sm" style="width: 150px;" value="{{ $detail->no_barang }}" readonly></td>
                                                    <td><input type="text" name="deskripsi_barang[]" class="form-control form-control-sm" style="width: 150px;" value="{{ $detail->deskripsi_barang }}"></td>
                                                    <td><input type="text" name="kts_permintaan[]" class="form-control form-control-sm" style="width: 150px;" value="{{ $detail->kts_permintaan }}"></td>
                                                    <td><input type="text" name="satuan[]" class="form-control form-control-sm" style="width: 150px;" value="{{ $detail->satuan }}"></td>
                                                    <td><input type="text" name="harga_satuan[]" class="form-control form-control-sm" style="width: 150px;" value="{{ $detail->harga_satuan }}"></td>
                                                    <td><input type="text" name="jumlah_total_harga[]" class="form-control form-control-sm" style="width: 150px;" value="{{ $detail->jumlah_total_harga }}"></td>
                                                    <td><input type="text" name="catatan[]" class="form-control form-control-sm" style="width: 150px;" value="{{ $detail->catatan }}"></td>
                                                    <td><input type="date" name="tgl_diminta[]" class="form-control form-control-sm" style="width: 150px;" value="{{ $detail->tgl_diminta }}"></td>
                                                    <td><input type="text" name="kts_dipesan[]" class="form-control form-control-sm" style="width: 150px;" value="{{ $detail->kts_dipesan }}"></td>
                                                    <td><input type="text" name="kts_diterima[]" class="form-control form-control-sm" style="width: 150px;" value="{{ $detail->kts_diterima }}"></td>
                                                    <td>
                                                        <div class="checkbox-wrapper-4">
                                                            <input type="hidden" name="tutup_check_items[{{ $index }}]" value="0">
                                                            <input class="inp-cbx" name="tutup_check_items[{{ $index }}]" id="tutup_check_items_{{ $index }}" type="checkbox" value="1"
                                                                {{ old("tutup_check_items.$index", $detail->tutup_check_items) ? 'checked' : '' }}>
                                                            <label class="cbx" for="tutup_check_items_{{ $index }}">
                                                                <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                            </label>
                                                            <svg class="inline-svg">
                                                                <symbol id="check-4" viewbox="0 0 12 10">
                                                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                                </symbol>
                                                            </svg>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div id="ricape" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-10">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="dd"></div>
                                                    <div class="checkbox-wrapper-4">
                                                        <input type="hidden" name="tindak_lanjut_check" value="0">
                                                        <input class="inp-cbx" name="tindak_lanjut_check" id="tindak_lanjut_check" type="checkbox" value="1" {{ old('tindak_lanjut_check', $permintaanPembelian->tindak_lanjut_check) ? 'checked' : '' }}>
                                                        <label class="cbx" for="tindak_lanjut_check">
                                                            <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                            <span><strong>Tindak Lanjut</strong></span>
                                                        </label>
                                                        <svg class="inline-svg">
                                                            <symbol id="check-4" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
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
                                                        <input class="inp-cbx" name="urgent_check" id="urgent_check" type="checkbox" value="1" {{ old('urgent_check', $permintaanPembelian->urgent_check) ? 'checked' : '' }}>
                                                        <label class="cbx" for="urgent_check">
                                                            <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                            <span><strong>Urgent</strong></span>
                                                        </label>
                                                        <svg class="inline-svg">
                                                            <symbol id="check-4" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </symbol>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <textarea style="width: 300px; height:100px;" class="form-control" name="deskripsi_1" placeholder="Deskripsi">{{ old('deskripsi_1', $permintaanPembelian->deskripsi_1) }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <div class="dd"></div>
                                                    <div class="checkbox-wrapper-4">
                                                        <input type="hidden" name="catatan_pemeriksaan_check" value="0">
                                                        <input class="inp-cbx" name="catatan_pemeriksaan_check" id="catatan_pemeriksaan_check" type="checkbox" value="1" {{ old('catatan_pemeriksaan_check', $permintaanPembelian->catatan_pemeriksaan_check) ? 'checked' : '' }}>
                                                        <label class="cbx" for="catatan_pemeriksaan_check">
                                                            <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                            <span><strong>Catatan Pemeriksaan</strong></span>
                                                        </label>
                                                        <svg class="inline-svg">
                                                            <symbol id="check-4" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </symbol>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <textarea style="width: 300px; height:100px;" class="form-control" name="deskripsi_2" placeholder="Deskripsi">{{ old('deskripsi_2', $permintaanPembelian->deskripsi_2) }}
                                                    </textarea>                                                                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <div class="mb-15 row align-items-center">
                        <div class="col">
                            <div class="">
                                <button type="submit" class="btn btn-primary buttonedit">Update</button>
                                <a href="{{ route('pembelian/permintaan/list/page') }}" class="btn btn-primary float-left veiwbutton ml-3 mb-5"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.querySelector('input[name="disetujui_check"]');
            const persetujuanField = document.getElementById('persetujuan-field');

            function toggleField() {
                if (checkbox.checked) {
                    persetujuanField.style.display = 'block';
                } else {
                    persetujuanField.style.display = 'none';
                }
            }

            checkbox.addEventListener('change', toggleField);
            toggleField(); // Jalankan sekali waktu load
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const disetujuiCheck = document.getElementById("disetujui_check");
            const statusInput = document.getElementById("status_permintaan");
            const statusBadge = document.getElementById("statusBadge");
            const checkboxTutup = document.querySelectorAll('input[id^="tutup_check_items_"]');

            function updateStatus() {
                let jumlahCheckbox = checkboxTutup.length;
                let checkedCount = 0;
                let statusText = '';
                let badgeHTML = '';

                checkboxTutup.forEach(cb => {
                    if (cb.checked && cb.value === "1") {
                        checkedCount++;
                    }
                });

                if (disetujuiCheck.checked && disetujuiCheck.value === "1") {
                    statusText = 'Diterima';
                    badgeHTML = '<span class="badge bg-success"><i class="fas fa-check"> </i> Diterima</span>';
                } else if (checkedCount === jumlahCheckbox && jumlahCheckbox > 0) {
                    statusText = 'Diproses';
                    badgeHTML = '<span class="badge bg-info"><i class="fas fa-tasks"> </i> Diproses</span>';
                } else if (checkedCount > 0) {
                    statusText = 'Diproses';
                    badgeHTML = '<span class="badge bg-info"><i class="fas fa-tasks"> </i> Diproses</span>';
                } else {
                    statusText = 'Menunggu';
                    badgeHTML = '<span class="badge bg-warning"><i class="fas fa-spinner"> </i> Menunggu</span>';
                }

                statusInput.value = statusText;

                statusBadge.innerHTML = badgeHTML;
            }

            updateStatus();

            disetujuiCheck.addEventListener('change', updateStatus);
            checkboxTutup.forEach(cb => {
                cb.addEventListener('change', updateStatus);
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#tambahBarangBtn').click(function () {
                let row = $('.barang-row:first').clone();
    
                row.find('select').val('');
                row.find('input').val('');
                $('#barangTableBody').append(row);
            });
    
            $(document).on('change', '.no-barang-select', function () {
                let selected = $(this).find(':selected');
                let row = $(this).closest('tr');
    
                row.find('.deskripsi-barang-input').val(selected.data('nama'));
                row.find('select[name="satuan[]"]').val(selected.data('satuan'));

            });
    
            $(document).on('click', '.remove-row', function () {
                if ($('#barangTableBody .barang-row').length > 1) {
                    $(this).closest('tr').remove();
                } else {
                    alert("Minimal satu barang harus ada.");
                }
            });
        });
    </script>    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('tindak_lanjut_check');
            const statusText = document.getElementById('dihentikan-status');

            function updateStatusText() {
                statusText.textContent = checkbox.checked ? 'Ya' : 'Tidak';
            }
    
            updateStatusText();
    
            checkbox.addEventListener('change', updateStatusText);
        });
    </script>    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('disetujui_check');
            const statusText = document.getElementById('dihentikan-status');

            checkbox.disabled = false;

            function updateStatusText() {
                statusText.textContent = checkbox.checked ? 'Ya' : 'Tidak';
            }
    
            updateStatusText();
    
            checkbox.addEventListener('change', updateStatusText);
        });
    </script>    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('urgent_check');
            const statusText = document.getElementById('dihentikan-status');

            function updateStatusText() {
                statusText.textContent = checkbox.checked ? 'Ya' : 'Tidak';
            }
    
            updateStatusText();
    
            checkbox.addEventListener('change', updateStatusText);
        });
    </script>     
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('catatan_pemeriksaan_check');
            const statusText = document.getElementById('dihentikan-status');

            function updateStatusText() {
                statusText.textContent = checkbox.checked ? 'Ya' : 'Tidak';
            }
    
            updateStatusText();
    
            checkbox.addEventListener('change', updateStatusText);
        });
    </script> 
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('catatan_pemeriksaan_check_2');
            const statusText = document.getElementById('dihentikan-status');

            function updateStatusText() {
                statusText.textContent = checkbox.checked ? 'Ya' : 'Tidak';
            }
    
            updateStatusText();
    
            checkbox.addEventListener('change', updateStatusText);
        });
    </script>  
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('tutup_check_items');
            const statusText = document.getElementById('dihentikan-status');

            function updateStatusText() {
                statusText.textContent = checkbox.checked ? 'Ya' : 'Tidak';
            }
    
            updateStatusText();
    
            checkbox.addEventListener('change', updateStatusText);
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('tutup_check_all');
            const statusText = document.getElementById('dihentikan-status');

            function updateStatusText() {
                statusText.textContent = checkbox.checked ? 'Ya' : 'Tidak';
            }
    
            updateStatusText();
    
            checkbox.addEventListener('change', updateStatusText);
        });
    </script>      
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const namaBarangSelect = document.getElementById('namaBarangSelect');
            const deskripsiBarangInput = document.getElementById('deskripsiBarangInput');
            const departemenSelect = document.getElementById('departemenSelect');
            const proyekSelect = document.getElementById('proyekSelect');
            const gudangSelect = document.getElementById('gudangSelect');
            const ktsSaatIniInput = document.getElementById('ktsSaatIniInput');
            const nilaiSaatIniInput = document.getElementById('nilaiSaatIniInput');
        
        namaBarangSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            deskripsiBarangInput.value = selectedOption.getAttribute('data-nama') || '';
            departemenSelect.value = selectedOption.getAttribute('data-departemen') || '';
            proyekSelect.value = selectedOption.getAttribute('data-proyek') || '';
            gudangSelect.value = selectedOption.getAttribute('data-gudang') || '';
            ktsSaatIniInput.value = selectedOption.getAttribute('data-ktssaatini') || '';
            nilaiSaatIniInput.value = selectedOption.getAttribute('data-nilaisaatini') || '';
        });
    });
    </script>        
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const noAkunSelect = document.getElementById('noAkunSelect');
            const namaAkunSelect = document.getElementById('namaAkunSelect');
        
        noAkunSelect.addEventListener('change', function () {
            const selectedNo = this.value;
            const nama = this.options[this.selectedIndex].getAttribute('data-nama');
    
            for (let i = 0; i < namaAkunSelect.options.length; i++) {
                if (namaAkunSelect.options[i].value === nama) {
                    namaAkunSelect.selectedIndex = i;
                    break;
                }
            }
        });
    
        namaAkunSelect.addEventListener('change', function () {
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
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('nilaiSaatIniInput');
    
            input.addEventListener('input', () => {
                let angka = input.value.replace(/\D/g, '');
                input.value = formatRupiah(angka);
            });
    
            input.closest('form').addEventListener('submit', () => {
                input.value = input.value.replace(/\D/g, '');
            });
    
            function formatRupiah(angka, prefix = '') {
                return prefix + angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
        });
    </script> 
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('nilai_penyesuaian_check');
            const statusText = document.getElementById('persentase-komplet-check-status');

            function updateStatusText() {
                statusText.textContent = checkbox.checked ? 'Ya' : 'Tidak';
            }
    
            updateStatusText();
    
            checkbox.addEventListener('change', updateStatusText);
        });
    </script>  
    @endsection
@endsection