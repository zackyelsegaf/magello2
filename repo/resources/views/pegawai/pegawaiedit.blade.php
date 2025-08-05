@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Edit Pegawai</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('pegawai/update', $Pegawai->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm my-rounded-2">
                            <div class="custom-header my-rounded">
                                <h6 class="my-padding font-weight-bold">Data Pribadi</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="text" class="form-control form-control-sm  @error('nik_pegawai') is-invalid @enderror" name="nik_pegawai" value="{{ $Pegawai->nik_pegawai }}">
                                     @error('nik_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" class="form-control form-control-sm  @error('nama_pegawai') is-invalid @enderror" name="nama_pegawai" value="{{ $Pegawai->nama_pegawai }}">
                                     @error('nama_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control form-control-sm  datetimepicker @error('tanggal_lahir_pegawai') is-invalid @enderror" name="tanggal_lahir_pegawai" value="{{ $Pegawai->tanggal_lahir_pegawai }}">
                                         @error('tanggal_lahir_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Kota Kelahiran</label>
                                    <select class="form-control form-control-sm  @error('tempat_lahir_pegawai') is-invalid @enderror"  name="tempat_lahir_pegawai">
                                        <option selected disabled {{ old('tempat_lahir_pegawai', $Pegawai->tempat_lahir_pegawai) ? '' : 'selected' }}> --Pilih Kota-- </option>
                                        @foreach ($kota as $items )
                                            <option value="{{ $items->nama }}" {{ old('tempat_lahir_pegawai', $Pegawai->tempat_lahir_pegawai) == $items->nama ? 'selected' : '' }}>
                                                {{ $items->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tempat_lahir_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control form-control-sm " name="jenis_kelamin_pegawai">
                                        <option selected disabled {{ old('jenis_kelamin_pegawai', $Pegawai->jenis_kelamin_pegawai) ? '' : 'selected' }}> --Pilih Jenis Kelamin-- </option>
                                        @foreach ($gender as $items)
                                            <option value="{{ $items->nama }}" {{ old('jenis_kelamin_pegawai', $Pegawai->jenis_kelamin_pegawai) == $items->nama ? 'selected' : '' }}>
                                                {{ $items->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jenis_kelamin_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Agama</label>
                                    <select class="form-control form-control-sm " name="agama_pegawai">
                                        <option selected disabled {{ old('agama_pegawai', $Pegawai->agama_pegawai) ? '' : 'selected' }}> --Pilih Agama-- </option>
                                        @foreach ($agama as $items)
                                            <option value="{{ $items->nama }}" {{ old('agama_pegawai', $Pegawai->agama_pegawai) == $items->nama ? 'selected' : '' }}>
                                                {{ $items->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('agama_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Status Pernikahan</label>
                                    <select class="form-control form-control-sm " name="status_pernikahan_pegawai">
                                        <option selected disabled {{ old('status_pernikahan_pegawai', $Pegawai->status_pernikahan_pegawai) ? '' : 'selected' }}> --Pilih Status Pernikahan-- </option>
                                        @foreach ($data as $items)
                                            <option value="{{ $items->nama }}" {{ old('status_pernikahan_pegawai', $Pegawai->status_pernikahan_pegawai) == $items->nama ? 'selected' : '' }}>
                                                {{ $items->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status_pernikahan_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Golongan Darah</label>
                                    <select class="form-control form-control-sm " name="golongan_darah_pegawai">
                                        <option selected disabled {{ old('golongan_darah_pegawai', $Pegawai->golongan_darah_pegawai) ? '' : 'selected' }}> --Pilih Golongan Darah-- </option>
                                        @foreach ($golongan_darah as $items)
                                            <option value="{{ $items->nama }}" {{ old('golongan_darah_pegawai', $Pegawai->golongan_darah_pegawai) == $items->nama ? 'selected' : '' }}>
                                                {{ $items->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('golongan_darah_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-sm my-rounded-2">
                            <div class="custom-header my-rounded">
                                <h6 class="my-padding font-weight-bold">Informasi Bank</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Bank</label>
                                    <input type="text" class="form-control form-control-sm  @error('nama_bank_pegawai') is-invalid @enderror" name="nama_bank_pegawai" value="{{ $Pegawai->nama_bank_pegawai }}">
                                     @error('nama_bank_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Nomor Rekening</label>
                                    <input type="text" class="form-control form-control-sm  @error('nomor_rekening_pegawai') is-invalid @enderror" name="nomor_rekening_pegawai" value="{{ $Pegawai->nomor_rekening_pegawai }}">
                                     @error('nomor_rekening_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Atas Nama No. Rekening</label>
                                    <input type="text" class="form-control form-control-sm  @error('atas_nama_pegawai') is-invalid @enderror" name="atas_nama_pegawai" value="{{ $Pegawai->atas_nama_pegawai }}">
                                     @error('atas_nama_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-sm my-rounded-2">
                            <div class="custom-header my-rounded">
                                <h6 class="my-padding font-weight-bold">Data Orangtua</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Ayah</label>
                                    <input type="text" class="form-control form-control-sm  @error('nama_ayah_pegawai') is-invalid @enderror" name="nama_ayah_pegawai" value="{{ $Pegawai->nama_ayah_pegawai }}">
                                     @error('nama_ayah_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Ibu</label>
                                    <input type="text" class="form-control form-control-sm  @error('nama_ibu_pegawai') is-invalid @enderror" name="nama_ibu_pegawai" value="{{ $Pegawai->nama_ibu_pegawai }}">
                                     @error('nama_ibu_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-sm my-rounded-2">
                            <div class="custom-header my-rounded">
                                <h6 class="my-padding font-weight-bold">Data Pekerjaan</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control form-control-sm  @error('status_pekerjaan_pegawai') is-invalid @enderror" name="status_pekerjaan_pegawai">
                                        <option selected disabled {{ old('status_pekerjaan_pegawai', $Pegawai->status_pekerjaan_pegawai) ? '' : 'selected' }}> --Pilih Status Pekerjaan-- </option>
                                        @foreach ($status_pekerjaan as $items)
                                            <option value="{{ $items->nama }}" {{ old('status_pekerjaan_pegawai', $Pegawai->status_pekerjaan_pegawai) == $items->nama ? 'selected' : '' }}>
                                                {{ $items->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status_pekerjaan_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Foto</label>
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" id="customFile" name="foto_pegawai" value="{{ old('foto_pegawai') }}">
                                         @error('foto_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        <label class="custom-file-label" for="customFile">Pilih Foto</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Terima</label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control form-control-sm  datetimepicker" name="tanggal_masuk_pegawai" value="{{ $Pegawai->tanggal_masuk_pegawai }}">
                                         @error('tanggal_masuk_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Keluar</label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control form-control-sm  datetimepicker" name="tanggal_keluar_pegawai" value="{{ $Pegawai->tanggal_keluar_pegawai }}">
                                         @error('tanggal_keluar_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm my-rounded-2">
                            <div class="custom-header my-rounded">
                                <h6 class="my-padding font-weight-bold">Kontak</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control form-control-sm  @error('email_pegawai') is-invalid @enderror" name="email_pegawai" value="{{ $Pegawai->email_pegawai }}">
                                     @error('email_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input type="text" class="form-control form-control-sm  @error('no_telp_pegawai') is-invalid @enderror" name="no_telp_pegawai" value="{{ $Pegawai->no_telp_pegawai }}">
                                     @error('no_telp_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-sm my-rounded-2">
                            <div class="custom-header my-rounded">
                                <h6 class="my-padding font-weight-bold">Data Alamat</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Provinsi</label>
                                    <select class="form-control form-control-sm  @error('provinsi') is-invalid @enderror" name="provinsi">
                                        <option selected disabled {{ old('provinsi', $Pegawai->provinsi) ? '' : 'selected' }}> --Pilih Provinsi-- </option>
                                        @foreach ($provinsi as $items )
                                            <option value="{{ $items->nama }}" {{ old('provinsi', $Pegawai->provinsi) == $items->nama ? 'selected' : '' }}>
                                                {{ $items->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('provinsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Kota</label>
                                    <select class="form-control form-control-sm  @error('kota') is-invalid @enderror"  name="kota">
                                        <option selected disabled {{ old('kota', $Pegawai->kota) ? '' : 'selected' }}> --Pilih Kota-- </option>
                                        @foreach ($kota as $items )
                                            <option value="{{ $items->nama }}" {{ old('kota', $Pegawai->kota) == $items->nama ? 'selected' : '' }}>
                                                {{ $items->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kota')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <input type="text" class="form-control form-control-sm  @error('kecamatan') is-invalid @enderror" name="kecamatan" value="{{ $Pegawai->kecamatan }}">
                                     @error('kecamatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Kelurahan</label>
                                    <input type="text" class="form-control form-control-sm  @error('kelurahan') is-invalid @enderror" name="kelurahan" value="{{ $Pegawai->kelurahan }}">
                                     @error('kelurahan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>RT</label>
                                    <input type="text" class="form-control form-control-sm  @error('rt_pegawai') is-invalid @enderror" name="rt_pegawai" value="{{ $Pegawai->rt_pegawai }}">
                                     @error('rt_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>RW</label>
                                    <input type="text" class="form-control form-control-sm  @error('rw_pegawai') is-invalid @enderror" name="rw_pegawai" value="{{ $Pegawai->rw_pegawai }}">
                                     @error('rw_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Jalan</label>
                                        <textarea class="form-control form-control-sm  @error('alamat_pegawai') is-invalid @enderror" name="alamat_pegawai">{{ old('memo', $Pegawai->alamat_pegawai) }}</textarea>
                                        @error('alamat_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-sm my-rounded-2">
                            <div class="custom-header my-rounded">
                                <h6 class="my-padding font-weight-bold">Nomor Identitas</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Jenis Identitas</label>
                                    <select class="form-control form-control-sm " name="jenis_identitas_pegawai">
                                        <option selected disabled {{ old('jenis_identitas_pegawai', $Pegawai->jenis_identitas_pegawai) ? '' : 'selected' }}> --Pilih Jenis Identitas-- </option>
                                        @foreach ($kartu_identitas as $items)
                                            <option value="{{ $items->nama }}" {{ old('jenis_identitas_pegawai', $Pegawai->jenis_identitas_pegawai) == $items->nama ? 'selected' : '' }}>
                                                {{ $items->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jenis_identitas_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Nomor Identitas</label>
                                    <input type="text" class="form-control form-control-sm  @error('nomor_identitas_pegawai') is-invalid @enderror" name="nomor_identitas_pegawai" value="{{ $Pegawai->nomor_identitas_pegawai }}">
                                     @error('nomor_identitas_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-sm my-rounded-2">
                            <div class="custom-header my-rounded">
                                <h6 class="my-padding font-weight-bold">Kontak Darurat</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control form-control-sm  @error('nama_kontak_darurat_pegawai') is-invalid @enderror" name="nama_kontak_darurat_pegawai" value="{{ $Pegawai->nama_kontak_darurat_pegawai }}">
                                     @error('nama_kontak_darurat_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input type="text" class="form-control form-control-sm  @error('no_telp_darurat_pegawai') is-invalid @enderror" name="no_telp_darurat_pegawai" value="{{ $Pegawai->no_telp_darurat_pegawai }}">
                                     @error('no_telp_darurat_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Hubungan</label>
                                    <select class="form-control form-control-sm " name="hubungan_pegawai">
                                        <option selected disabled {{ old('hubungan_pegawai', $Pegawai->hubungan_pegawai) ? '' : 'selected' }}> --Pilih Jenis Identitas-- </option>
                                        @foreach ($hubungan_pegawai as $items)
                                            <option value="{{ $items->nama }}" {{ old('hubungan_pegawai', $Pegawai->hubungan_pegawai) == $items->nama ? 'selected' : '' }}>
                                                {{ $items->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('hubungan_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-sm my-rounded-2">
                            <div class="custom-header my-rounded">
                                <h6 class="my-padding font-weight-bold">Sosial Media</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Twitter</label>
                                    <input type="text" class="form-control form-control-sm " name="twitter" value="{{ $Pegawai->twitter }}">
                                     @error('twitter')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Instagram</label>
                                    <input type="text" class="form-control form-control-sm " name="instagram" value="{{ $Pegawai->instagram }}">
                                     @error('instagram')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Youtube</label>
                                    <input type="text" class="form-control form-control-sm " name="youtube" value="{{ $Pegawai->youtube }}">
                                     @error('youtube')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input type="text" class="form-control form-control-sm " name="facebook" value="{{ $Pegawai->facebook }}">
                                     @error('facebook')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Linkedin</label>
                                    <input type="text" class="form-control form-control-sm " name="linkedin" value="{{ $Pegawai->linkedin }}">
                                     @error('linkedin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary buttonedit">Update</button>
            </form>
        </div>
    </div>
    @section('script')
        @if ($errors->any())
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Silakan periksa kembali form yang Anda isi.',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    @endsection
@endsection
