@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Kategori</h3>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('kategoritiketkostumer/list/page') }}">
                @csrf
                <!-- Section 1: Form Header -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="nama_kategori" class="form-label fw-bold">Nama Kategori</label>
                        <input type="text" id="nama_kategori" name="nama_kategori" class="form-control"
                            value="{{ old('nama_kategori') }}">
                    </div>
                </div>

                <div class="mb-15 row align-items-center">
                    <div class="col">
                        <div class="">
                            <button type="submit" class="btn btn-primary buttonedit">
                                <i class="fa fa-check mr-2"></i>Simpan
                            </button>
                            <a href="{{ route('kategoritiketkostumer/list/page') }}"
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
