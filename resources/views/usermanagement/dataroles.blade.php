@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mt-5">
                            <h4 class="card-title float-left mt-2">Data Pengguna</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Data Hak Akses</h5>
                            <button class="btn btn-teal" data-toggle="modal" data-target="#modalAdd">+ Tambah Hak
                                Akses</button>
                        </div>

                        <div class="card-body p-0">
                            <table class="table mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Hak Akses</th>
                                        <th>Departemen</th>
                                        <th class="text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($roles as $role)
                                        <tr>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->department ?? '' }}</td>
                                            <td class="text-right">
                                                <form class="d-inline" method="POST"
                                                    action="{{ route('pengaturan/roles/destroy', $role) }}">
                                                    @csrf
                                                    <button class="btn btn-sm btn-outline-danger"
                                                        {{ $role->name === 'SuperAdmin' ? 'disabled' : '' }}>Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">Belum ada role</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade" id="modalAdd" tabindex="-1">
                        <div class="modal-dialog">
                            <form class="modal-content" method="POST" action="{{ route('pengaturan/roles/store') }}">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Hak Akses</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Nama Role</label>
                                        <input name="name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Departemen (opsional)</label>
                                        <input name="department" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-dismiss="modal" type="button">Batal</button>
                                    <button class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="page-header">
                <div class="mb-15 row align-items-center">
                    <div class="col">
                        <div class="">
                            <a href="{{ route('users/add/new') }}" class="btn btn-primary float-left veiwbutton"><i class="fas fa-plus mr-2"></i>Tambah</a>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
