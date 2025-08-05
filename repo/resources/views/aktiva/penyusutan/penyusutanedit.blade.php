@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Edit Penyusutan</h3> 
                    </div>
                </div>
            </div>
            <form action="{{ route('penyusutan/update', $penyusutan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row formtype">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Penyusutan</label>
                                    <input type="text" class="form-control form-control-sm  @error('nama_penyusutan') is-invalid @enderror" name="nama_penyusutan" value="{{ $penyusutan->nama_penyusutan }}">
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2-tag').select2({
            tags: true,
            placeholder: 'Pilih atau ketik Gudang',
            allowClear: true,
            width: '100%'
            });
        });
    </script>
    @endsection
@endsection