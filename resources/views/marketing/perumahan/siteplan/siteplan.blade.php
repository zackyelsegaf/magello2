@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mt-5">
                            <h4 class="card-title float-left mt-2">Site Plan</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="card rounded-default p-3 filterBox text-white">
                        <form method="GET" action="{{ route('statuspemasok/list/page') }}">
                            <div class="form-group mb-1">
                                <label for="kluster_perumahan">Kluster/Perumahan</label>
                                <input type="text" name="kluster_perumahan" class="form-control form-control-sm"
                                    onchange="this.form.submit()" placeholder="luster/Perumahan"
                                    value="{{ request('kluster_perumahan') }}">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="page-header">
                        <div class="mb-15 row align-items-center">
                            <div class="col">
                                <button id="deleteSelected" class="btn btn-primary float-left veiwbutton"><i class="fas fa-search mr-2"></i></i>Reset Zoom</button>
                                <button id="deleteSelected" class="btn btn-primary float-left veiwbutton ml-3"><i class="fas fa-search-minus mr-2"></i>Zoom Out</button>
                            </div>
                        </div>
                    </div>
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="card rounded-default p-3 text-white">
                            <div class="card bg-white p-3 text-white">

                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
