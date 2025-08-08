@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Kluster/ Perumahan</h3>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('prospek/list/page') }}">
                @csrf
                <!-- Section 1: Form Header -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="nama_kluster" class="form-label fw-bold">Nama Kluster</label>
                        <input type="text" id="nama_kluster" name="nama_kluster" class="form-control"
                            value="{{ old('nama_kluster') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="nomor_hp" class="form-label fw-bold">Nomor Hp</label>
                        <input type="number" id="nomor_hp" name="nomor_hp" class="form-control"
                            value="{{ old('nomor_hp') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label fw-bold">Luas Tanah Total (m2)</label>
                        <input type="luas_tanah_total" id="luas_tanah_total" name="luas_tanah_total" class="form-control"
                            value="{{ old('luas_tanah_total') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="ditugaskan_ke" class="form-label fw-bold">Provinsi</label>
                        <select class="form-control @error('ditugaskan_ke') is-invalid @enderror" name="ditugaskan_ke"
                            id="ditugaskan_ke">
                            <option value="">--Provinsi--</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="sumber_prospek" class="form-label fw-bold">Kota</label>
                        <select class="form-control @error('sumber_prospek') is-invalid @enderror" name="sumber_prospek"
                            id="sumber_prospek">
                            <option value="">--Kota--</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="kecamatan" class="form-label fw-bold">Kecamatan</label>
                        <input type="text" id="kecamatan" name="kecamatan" class="form-control"
                            value="{{ old('kecamatan') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="kelurahan" class="form-label fw-bold">Kelurahan</label>
                        <input type="text" id="kelurahan" name="kelurahan" class="form-control"
                            value="{{ old('kelurahan') }}">
                    </div>
                    <div class="col-12">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea id="alamat" class="form-control" rows="2"></textarea>
                    </div>
                </div>

                <div class="mb-15 row align-items-center">
                    <div class="col">
                        <div class="">
                            <button type="submit" class="btn btn-primary buttonedit">
                                <i class="fa fa-check mr-2"></i>Simpan
                            </button>
                            <a href="{{ route('klusterperumahan/list/page') }}"
                                class="btn btn-primary float-left veiwbutton ml-3">
                                <i class="fas fa-chevron-left mr-2"></i>Batal
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title mt-5">{{ isset($this->clusterId) ? 'Edit' : 'Tambah' }} Kluster/ Perumahan</h3>
                </div>
            </div>
        </div>

        <form wire:submit.prevent='save'>
            <!-- Section 1: Form Header -->
            <div class="row mb-3">
                <div class="col-md-4 mb-2">
                    <label>Nama Cluster</label>
                    <input type="text" class="form-control form-control-sm  @error('nama_cluster') is-invalid @enderror" wire:model="nama_cluster">
                    @foreach ($errors->get('nama_cluster') as $err)
                        <div class="invalid-feedback">{{ $err }}</div>
                    @endforeach
                </div>
                <div class="col-md-4 mb-2">
                    <label>No. HP</label>
                    <input type="text" class="form-control form-control-sm  @error('no_hp') is-invalid @enderror" wire:model="no_hp">
                    @foreach ($errors->get('no_hp') as $err)
                        <div class="invalid-feedback">{{ $err }}</div>
                    @endforeach
                </div>
                <div class="col-md-4 mb-2">
                    <label>Luas Tanah M2</label>
                    <input type="text" class="form-control form-control-sm  @error('luas_tanah') is-invalid @enderror" wire:model="luas_tanah">
                    @foreach ($errors->get('luas_tanah') as $err)
                        <div class="invalid-feedback">{{ $err }}</div>
                    @endforeach
                </div>
                <div class="col-md-4 mb-2">
                    <label>Total Unit</label>
                    <input type="text" class="form-control form-control-sm  @error('total_unit') is-invalid @enderror" wire:model="total_unit">
                    @foreach ($errors->get('total_unit') as $err)
                        <div class="invalid-feedback">{{ $err }}</div>
                    @endforeach
                </div>
                <div class="col-md-4 mb-2" wire:ignore>
                    <label>Provinsi</label>
                    <select class="form-control form-control-sm @error('provinsi') is-invalid @enderror" id="provinsi" wire:model="provinsi">
                        <option selected> --Pilih Provinsi-- </option>
                        @foreach ($data_provinsi as $items )
                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                        @endforeach
                    </select>
                    @foreach ($errors->get('provinsi') as $err)
                        <div class="invalid-feedback">{{ $err }}</div>
                    @endforeach
                </div>
                <div class="col-md-4 mb-2" wire:ignore>
                    <label>Kota</label>
                    <select class="form-control form-control-sm @error('kota') is-invalid @enderror" id="kota" wire:model="kota">
                        <option selected> --Pilih Kota-- </option>
                        @foreach ($data_kota as $items )
                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                        @endforeach
                    </select>
                    @foreach ($errors->get('kota') as $err)
                        <div class="invalid-feedback">{{ $err }}</div>
                    @endforeach
                </div>
                <div class="col-md-4 mb-2">
                    <label>Kecamatan</label>
                    <input type="text" class="form-control form-control-sm  @error('kecamatan') is-invalid @enderror" wire:model="kecamatan">
                    @foreach ($errors->get('kecamatan') as $err)
                        <div class="invalid-feedback">{{ $err }}</div>
                    @endforeach
                </div>
                <div class="col-md-4 mb-2">
                    <label>Kelurahan</label>
                    <input type="text" class="form-control form-control-sm  @error('kelurahan') is-invalid @enderror" wire:model="kelurahan">
                    @foreach ($errors->get('kalurahan') as $err)
                        <div class="invalid-feedback">{{ $err }}</div>
                    @endforeach
                </div>
                <div class="col-12">
                    <label>Alamat</label>
                    <textarea class="form-control @error('alamat_cluster') is-invalid @enderror" wire:model="alamat_cluster" cols="4"></textarea>
                    @foreach ($errors->get('alamat_cluster') as $err)
                        <div class="invalid-feedback">{{ $err }}</div>
                    @endforeach
                </div>
            </div>

            <div class="mb-15 row align-items-center">
                <div class="col">
                    <div class="">
                        <button type="submit" class="btn btn-primary buttonedit">
                            <i class="fa fa-check mr-2"></i>Simpan
                        </button>
                        <a href="{{ route('klusterperumahan/list/page') }}"
                            class="btn btn-primary float-left veiwbutton ml-3">
                            <i class="fas fa-chevron-left mr-2"></i>Batal
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#provinsi').select2();
            $('#kota').select2();

            $('#provinsi').on('change', function(e){
                var data = $(this).select2('val')
                @this.set('provinsi', data)
            });
            $('#kota').on('change', function(e){
                var data = $(this).select2('val')
                @this.set('kota', data)
            });
        });
    </script>
@endpush