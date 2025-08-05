@extends('laporan.semua')
@section('menu_laporan')
    <form method="post" target="_blank">
        @csrf
        <div class="tab-content profile-tab-cont">
            <div class="profile-menu">
                <ul class="nav nav-tabs nav-tabs-solid">
                    <li class="nav-item"> 
                        <a class="nav-link active" data-toggle="tab" href="#filter_param">Filter & Parameters</a> 
                    </li>
                </ul>
            </div>
            <div id="filter_param" class="tab-pane fade show active">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" class="h6">From</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="date" name="from" id="" class="form-control @error('from') is-invalid @enderror" value="{{ old('from') }}">
                                    @foreach ($errors->get('from') as $err)
                                        <div class="invalid-feedback">{{ $err }}</div>
                                    @endforeach
                                </div>
                            </div> 
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="" class="h6">To</label>
                                </div>
                                <div class="col-md-10">
                                    <input type="date" name="to" id="" class="form-control @error('to') is-invalid @enderror" value="{{ old('to') }}">
                                    @foreach ($errors->get('to') as $err)
                                        <div class="invalid-feedback">{{ $err }}</div>
                                    @endforeach
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
                        <button type="submit" class="btn btn-primary buttonedit"><i class="fa fa-check mr-2"></i>Simpan</button>
                        <a href="{{ url()->previous() }}" class="btn btn-primary float-left veiwbutton ml-3"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection