@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Edit Penyesuaian Barang</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('penyesuaian/update', $penyesuaianBarang->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h5 class="card-title">Change Password</h5> --}}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row formtype">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No. Penyesuaian</label>
                                                <input type="text" class="form-control form-control-sm" id="no_penyesuaian" name="no_penyesuaian" value="{{ $penyesuaianBarang->no_penyesuaian }}">
                                                <input type="hidden" name="penyesuaian_barang_id" value="{{ $penyesuaianBarang->detail->id ?? '' }}">
                                            </div>
                                            <div class="form-group" style="display: none">
                                                <label>Pengguna</label>
                                                <input type="text" class="form-control form-control-sm" name="pengguna_penyesuaian" value="{{ $penyesuaianBarang->pengguna_penyesuaian }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Penyesuaian</label>
                                                <div class="cal-icon">
                                                    <input type="text" class="form-control form-control-sm datetimepicker @error('tgl_penyesuaian') is-invalid @enderror" name="tgl_penyesuaian" value="{{ $penyesuaianBarang->tgl_penyesuaian }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>No Akun Penyesuaian</label>
                                                <select class="form-control form-control-sm" id="noAkunSelect" name="no_akun_penyesuaian">
                                                    <option disabled {{ old('no_akun_penyesuaian', $penyesuaianBarang->akun_penyesuaian) ? '' : 'selected' }}>-- Pilih Akun --</option>
                                                    @foreach ($nama_akun as $items)
                                                        <option value="{{ $items->no_akun }}" data-nama="{{ $items->nama_akun_indonesia }}" {{ old('no_akun_penyesuaian', $penyesuaianBarang->no_akun_penyesuaian) == $items->no_akun ? 'selected' : '' }}>
                                                            {{ $items->no_akun }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Akun Penyesuaian</label>
                                                <select class="form-control form-control-sm" id="namaAkunSelect" name="akun_penyesuaian">
                                                    <option disabled {{ old('akun_penyesuaian', $penyesuaianBarang->akun_penyesuaian) ? '' : 'selected' }}>-- Pilih Nama Akun --</option>
                                                    @foreach ($nama_akun as $items)
                                                        <option value="{{ $items->nama_akun_indonesia }}" data-no="{{ $items->no_akun }}" {{ old('akun_penyesuaian', $penyesuaianBarang->akun_penyesuaian) == $items->nama_akun_indonesia ? 'selected' : '' }}>
                                                            {{ $items->nama_akun_indonesia }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi') }}">{{ old('deskripsi', $penyesuaianBarang->deskripsi) }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <div class="dd"></div>
                                                <div class="checkbox-wrapper-4">
                                                    <input type="hidden" name="nilai_penyesuaian" value="Penyesuaian Nilai">
                                                    <input type="hidden" name="nilai_penyesuaian_check" value="0">
                                                    <input class="inp-cbx" name="nilai_penyesuaian_check" id="nilai_penyesuaian_check" type="checkbox" value="1" {{ old('nilai_penyesuaian_check', $penyesuaianBarang->nilai_penyesuaian_check) ? 'checked' : '' }}>
                                                    <label class="cbx" for="nilai_penyesuaian_check">
                                                        <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                        <span>Nilai Penyesuaian</span>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content profile-tab-cont">
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item">
                                <a class="nav-link active font-weight-bold" data-toggle="tab" href="#detail">Rincian</a>
                            </li>
                        </ul>
                    </div>
                    <div id="detail" class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-center mb-0" id="DataBarangAddSatuan">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No. Barang</th>
                                                <th>Deskripsi</th>
                                                <th>Perbedaan KTS</th>
                                                <th>Perbedaan Nilai</th>
                                                <th class="kolom-nilai" style="display: none;">Nilai Saat Ini</th>
                                                <th class="kolom-nilai" style="display: none;">Nilai Baru</th>
                                                <th>Departemen</th>
                                                <th>Proyek</th>
                                                <th>Gudang</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select id="namaBarangSelect" style="width: 150px;" class="form-control form-control-sm @error('no_barang') is-invalid @enderror" name="no_barang">
                                                        <option disabled {{ old('no_barang', $penyesuaianBarang->detail->no_barang) ? '' : 'selected' }}></option>
                                                        @foreach ($nama_barang as $items)
                                                            <option value="{{ $items->no_barang }}"
                                                                data-nama="{{ $items->nama_barang }}"
                                                                data-departemen="{{ $items->departemen }}"
                                                                data-proyek="{{ $items->proyek }}"
                                                                data-gudang="{{ $items->gudang }}"
                                                                data-ktssaatini="{{ $items->kuantitas_saldo_awal }}"
                                                                data-nilaisaatini="{{ $items->total_saldo_awal }}"
                                                                {{ old('no_barang', $penyesuaianBarang->detail->no_barang) == $items->no_barang ? 'selected' : '' }}>
                                                                {{ $items->no_barang }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input style="width: 150px;" id="deskripsiBarangInput" class="form-control form-control-sm" name="deskripsi_barang" value="{{ $penyesuaianBarang->detail->deskripsi_barang }}" readonly>
                                                </td>
                                                <td>
                                                    <input style="width: 150px;"type="text" class="form-control form-control-sm" name="kts_saat_ini" value="{{  $penyesuaianBarang->detail->selisih_kts ?? '' }}" readonly>
                                                </td>
                                                <td>
                                                    <input style="width: 150px;" type="text" class="form-control form-control-sm" name="kts_baru" value="{{ old('kts_baru', $penyesuaianBarang->detail->selisih_nilai) }}">
                                                </td>
                                                <td class="kolom-nilai" style="display: none;">
                                                    <input style="width: 150px;" id="nilaiSaatIniInput" type="text" class="form-control form-control-sm" name="nilai_saat_ini" value="{{ old('nilai_saat_ini', $penyesuaianBarang->detail->nilai_saat_ini) }}" readonly>
                                                </td>
                                                <td class="kolom-nilai" style="display: none;">
                                                    <input style="width: 150px;" type="text" class="form-control form-control-sm" name="nilai_baru" value="{{ old('nilai_baru', $penyesuaianBarang->detail->nilai_baru) }}">
                                                </td>
                                                <td>
                                                    <select id="departemenSelect" style="width: 150px;" class="form-control form-control-sm @error('departemen') is-invalid @enderror" name="departemen">
                                                        <option {{ old('departemen', $penyesuaianBarang->detail->departemen) ? '' : 'selected' }} disabled></option>
                                                        @foreach ($departemen as $items)
                                                            <option value="{{ $items->nama_departemen }}" {{ old('departemen', $penyesuaianBarang->detail->departemen) == $items->nama_departemen ? 'selected' : '' }}>{{ $items->nama_departemen }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="proyekSelect" style="width: 150px;" class="form-control form-control-sm @error('proyek') is-invalid @enderror" name="proyek">
                                                        <option {{ old('proyek', $penyesuaianBarang->detail->proyek) ? '' : 'selected' }} disabled></option>
                                                        @foreach ($proyek as $items)
                                                            <option value="{{ $items->nama_proyek }}" {{ old('proyek', $penyesuaianBarang->detail->proyek) == $items->nama_proyek ? 'selected' : '' }}>{{ $items->nama_proyek }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="gudangSelect" style="width: 150px;" class="form-control form-control-sm @error('gudang') is-invalid @enderror" name="gudang">
                                                        <option {{ old('gudang', $penyesuaianBarang->detail->gudang) ? '' : 'selected' }} disabled></option>
                                                        @foreach ($gudang as $items)
                                                            <option value="{{ $items->nama_gudang }}" {{ old('gudang', $penyesuaianBarang->detail->gudang) == $items->nama_gudang ? 'selected' : '' }}>{{ $items->nama_gudang }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="page-header">
                                    <div class="row mt-2 float-right">
                                        <div class="form-group">
                                            <label>Total Penyesuaian</label>
                                            <input type="text" class="form-control form-control-sm" id="displayTotalPenyesuaian" value="{{"Rp " . number_format($penyesuaianBarang->total_nilai_penyesuaian ?? 0, 0, ',', '.') }}" readonly>
                                            <input type="hidden" name="total_nilai_penyesuaian" value="{{ $penyesuaianBarang->total_nilai_penyesuaian ?? 0 }}">
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
                                <a href="{{ route('penyesuaian/list/page') }}" class="btn btn-primary float-left veiwbutton mr-2">
                                    <i class="fas fa-chevron-left mr-2"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-primary buttonedit">
                                    <i class="fas fa-save mr-2"></i>Update
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @section('script')
    <script>
        function hitungPenyesuaian() {
            let ktsBaru = parseFloat(document.querySelector('input[name="kts_baru"]').value) || 0;
            let nilaiSaatIni = parseFloat(document.getElementById('nilaiSaatIniInput').value.replace(/\./g, '').replace(',', '.')) || 0;
            let ktsSaatIni = parseFloat(document.querySelector('input[name="kts_saat_ini"]').value) || 0;

            let hargaPerUnit = ktsSaatIni !== 0 ? nilaiSaatIni / ktsSaatIni : 0;
            let nilaiBaru = ktsBaru * hargaPerUnit;
            let totalPenyesuaian = nilaiBaru - nilaiSaatIni;

            const inputNilaiBaru = document.querySelector('input[name="nilai_baru"]');
            inputNilaiBaru.value = Math.round(nilaiBaru).toLocaleString('id-ID');

            document.getElementById('displayTotalPenyesuaian').value = formatRupiah(totalPenyesuaian);

            document.querySelector('input[name="total_nilai_penyesuaian"]').value = Math.round(totalPenyesuaian);
        }

        function formatRupiah(angka) {
            return angka.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            });
        }

        document.querySelector('input[name="kts_baru"]').addEventListener('input', hitungPenyesuaian);

        document.getElementById('namaBarangSelect').addEventListener('change', function () {
            let selectedOption = this.options[this.selectedIndex];
            document.getElementById('ktsSaatIniInput').value = selectedOption.getAttribute('data-ktssaatini');
            document.getElementById('nilaiSaatIniInput').value = selectedOption.getAttribute('data-nilaisaatini');
            document.getElementById('deskripsiBarangInput').value = selectedOption.getAttribute('data-nama');
            document.getElementById('departemenSelect').value = selectedOption.getAttribute('data-departemen');
            document.getElementById('proyekSelect').value = selectedOption.getAttribute('data-proyek');
            document.getElementById('gudangSelect').value = selectedOption.getAttribute('data-gudang');

            hitungPenyesuaian();
        });
    </script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('nilai_penyesuaian_check');
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
    </script>     --}}
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
