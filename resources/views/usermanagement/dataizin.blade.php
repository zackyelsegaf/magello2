@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            {{-- <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mt-5">
                            <h4 class="card-title float-left mt-2">Izin Pengguna</h4>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-sm-12 px-3 py-4">
                    <form method="POST" action="{{ route('pengaturan/perm/update') }}">
                        @csrf
                        <div class="my-rounded-2">
                            <div class="col-md-12 p-3 bg-white border my-rounded-2">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title mt-2">Izin Pengguna</h4>
                                        <h6 class="py-1 font-weight-bold">Pengaturan akses pengguna untuk setiap peran.</h6>
                                    </div>
                                    <div class="col jusitfy-content-between">
                                        <div class="float-right mr-0 p-0">
                                            <button type="submit" class="btn btn-primary buttonedit-sm mt-3">
                                                <strong><i class="fas fa-save mr-2 ml-1"></i>Simpan Perubahan</strong>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="stick-table" style="overflow-x:auto;">
                                    <div class="table-responsive pt-2">
                                        <table class="table table-borderless table-hover m-0 p-0 separates1 th-default" id="RoleList">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Hak Akses</th>
                                                    @foreach ($roles as $role)
                                                        <th class="text-center">{{ $role->name }}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody class="my-tbody-spacing">
                                                @foreach ($permissions_data as $kategoriUtama => $kelompokSub)
                                                    <tr class="bg-info">
                                                        <td colspan="{{ 1 + $roles->count() }}">
                                                            <h6 class="font-weight-bold text-white m-0">{{ $kategoriUtama }}</h6>
                                                        </td>
                                                    </tr>

                                                    @foreach ($kelompokSub as $subBagian => $fiturSet)
                                                        <tr class="bg-info-card">
                                                            <td colspan="{{ 1 + $roles->count() }}">
                                                                <h7 class="font-weight-bold text-info m-0 pl-3">{{ $subBagian }}</h7>
                                                            </td>
                                                        </tr>

                                                        @foreach ($fiturSet as $fiturName => $permList)
                                                            <tr class="bg-secondary-card">
                                                                <td colspan="{{ 1 + $roles->count() }}">
                                                                    <h8 class="font-weight-bold text-secondary m-0 pl-4">{{ $fiturName }}</h8>
                                                                </td>
                                                            </tr>

                                                            @foreach ($permList as $permName)
                                                                <tr>
                                                                    <td class="pl-5">{{ $permName }}</td>
                                                                    @foreach ($roles as $role)
                                                                        @php
                                                                            $checked = $role->hasPermissionTo($permName);
                                                                            $disabled = $role->name === 'SuperAdmin';
                                                                            $id = 'chk_' . $role->id . '_' . \Illuminate\Support\Str::slug($permName, '_');
                                                                        @endphp
                                                                        <td class="text-center">
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input type="checkbox" id="{{ $id }}" class="custom-control-input"
                                                                                    name="matrix[{{ $role->id }}][]" value="{{ $permName }}"
                                                                                    {{ $checked ? 'checked' : '' }} {{ $disabled ? 'disabled' : '' }}>
                                                                                <label class="custom-control-label" for="{{ $id }}"></label>
                                                                            </div>
                                                                        </td>
                                                                    @endforeach
                                                                </tr>
                                                            @endforeach
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            </tbody>

                                            {{-- <tbody class="my-tbody-spacing">
                                                @foreach ($permissions_data as $kategoriUtama => $subKelompok)
                                                    <tr class="bg-info"> 
                                                        <td colspan="{{ 1 + $roles->count() }}">
                                                            <h6 class="font-weight-bold text-white m-0">{{ $kategoriUtama }}</h6>
                                                        </td>
                                                    </tr>
                                                    @foreach ($subKelompok as $fiturName => $permList)
                                                        <tr class="bg-secondary-card">
                                                            <td colspan="{{ 1 + $roles->count() }}">
                                                                <h6 class="font-weight-bold text-dark m-0 pl-3">{{ $fiturName }}</h6> 
                                                            </td>
                                                        </tr>
                                                        @foreach ($permList as $permName)
                                                            <tr>
                                                                <td class="pl-5">{{ $permName }}</td> @foreach ($roles as $role)
                                                                    @php
                                                                        $checked = $role->hasPermissionTo($permName);
                                                                        $disabled = $role->name === 'SuperAdmin';
                                                                    @endphp
                                                                    <td class="text-center">
                                                                    @php
                                                                        $slug = Str::slug($permName, '_');
                                                                        $id = "chk_{$role->id}_{$slug}";
                                                                    @endphp
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" id="{{ $id }}" class="custom-control-input" name="matrix[{{ $role->id }}][]" value="{{ $permName }}"
                                                                                {{ $checked ? 'checked' : '' }} {{ $disabled ? 'disabled' : '' }}>
                                                                            <label class="custom-control-label" for="{{ $id }}"></label>
                                                                        </div>
                                                                    </td>
                                                                @endforeach
                                                            </tr>
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            </tbody> --}}
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
{{-- @section('script')
<script>
    window.onscroll = function() {myFunction()};

    var header = document.getElementById("myHeader");
    var sticky = header.offsetTop;

    function myFunction() {
    if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
    } else {
        header.classList.remove("sticky");
    }
    }
    </script>
@endsection --}}
@endsection