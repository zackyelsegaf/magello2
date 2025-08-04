@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Edit Mata Uang</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('matauang.update', $mataUang->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row formtype">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text"
                                        class="form-control form-control-sm  @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ $mataUang->nama }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nilai Tukar</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        @php
                                            $nilai = old('nilai_tukar', $mataUang->nilai_tukar);
                                        @endphp

                                        <input type="text"
                                            class="form-control form-control-sm @error('nilai_tukar') is-invalid @enderror"
                                            name="nilai_tukar" placeholder="contoh: 100.000.000"
                                            value="{{ is_numeric($nilai) ? number_format($nilai, 0, ',', '.') : $nilai }}">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary buttonedit">Update</button>
            </form>
        </div>
    </div>
@endsection
