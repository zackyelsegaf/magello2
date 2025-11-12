<?php

// app/Http/Controllers/PermissionMatrixController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class PermissionMatrixController extends Controller
{
    private array $groups = [
        'Cashbook' => [
            'cashbook.create',
            'cashbook.view',
            'cashbook.edit',
            'cashbook.delete',
        ],
    
        'Cashbook Sidebar' => [
            'cashbooksidebar.view'
        ],

        'Menu Sidebar' => [
            'menusidebar.view'
        ],
    ];

    public function index()
    {
        $permissions_data = [
            'Master Data' => [
                'Umum' => [
                    'Mata Uang' => ['matauang.view','matauang.create','matauang.edit','matauang.delete'],
                    'Cabang'    => ['cabang.view','cabang.create','cabang.edit','cabang.delete'],
                    'Status Pelanggan' => [
                        'statuspelanggan.view',
                        'statuspelanggan.create',
                        'statuspelanggan.edit',
                        'statuspelanggan.delete',
                    ],

                    'Tipe Pelanggan' => [
                        'tipepelanggan.view',
                        'tipepelanggan.create',
                        'tipepelanggan.edit',
                        'tipepelanggan.delete',
                    ],

                    'Pelanggan' => [
                        'pelanggan.view',
                        'pelanggan.create',
                        'pelanggan.edit',
                        'pelanggan.delete',
                    ],

                    'Pegawai' => [
                        'pegawai.view',
                        'pegawai.create',
                        'pegawai.edit',
                        'pegawai.delete',
                    ],

                    'Pemasok' => [
                        'pemasok.view',
                        'pemasok.create',
                        'pemasok.edit',
                        'pemasok.delete',
                    ],

                    'Distributor/Penjual' => [
                        'distributor.view',
                        'distributor.create',
                        'distributor.edit',
                        'distributor.delete',
                    ],

                    'Departemen' => [
                        'departemen.view',
                        'departemen.create',
                        'departemen.edit',
                        'departemen.delete',
                    ],

                    'Syarat' => [
                        'syaratpembayaran.view',
                        'syaratpembayaran.create',
                        'syaratpembayaran.edit',
                        'syaratpembayaran.delete',
                    ],

                    'Pajak' => [
                        'pajak.view',
                        'pajak.create',
                        'pajak.edit',
                        'pajak.delete',
                    ],
                ],
            ],
            'Marketing' => [
                'Prospek' => [
                    'Data Prospek' => [
                        'prospek.view',
                        'prospek.create',
                        'prospek.edit',
                        'prospek.delete',
                    ],
                    'Data Konsumen' => [
                        'konsumen.view',
                        'konsumen.create',
                        'konsumen.edit',
                        'konsumen.delete',
                    ],
                ],
                
                'Perumahan' => [
                    'Site Plan' => [
                        'siteplan.view',
                        // 'siteplan.create',
                        // 'siteplan.edit',
                        // 'siteplan.delete',
                    ],

                    'Kluster' => [
                        'kluster.view',
                        'kluster.create',
                        'kluster.edit',
                        'kluster.delete',
                    ],

                    'Kavling' => [
                        'kavling.view',
                        'kavling.create',
                        'kavling.edit',
                        'kavling.delete',
                    ],

                    'Fasum' => [
                        'fasum.view',
                        'fasum.create',
                        'fasum.edit',
                        'fasum.delete',
                    ],

                    'Fasos' => [
                        'fasos.view',
                        'fasos.create',
                        'fasos.edit',
                        'fasos.delete',
                    ],
                ],

                'Booking' => [
                    'Data Booking' => [
                        'booking.view',
                        'booking.create',
                        'booking.edit',
                        'booking.delete',
                    ],
                ],
            ],

            'Keuangan' => [
                'Transaksi Booking' => [
                    'Pembayaran Konsumen' => [
                        'pembayaran-booking.view',
                        'pembayaran-booking.create',
                        'pembayaran-booking.edit',
                        'pembayaran-booking.delete',
                    ],
                ],
            ],
            'Buku Kas' => [
                'Cashbook' => [
                    'Menu Cashbook' => [
                        'cashbook.create',
                        'cashbook.view',
                        'cashbook.edit',
                        'cashbook.delete',
                    ],
                ],
            ],

            'Pengaturan' => [
                'Pengaturan' => [
                    'Menu Pengaturan' => [
                        'pengaturan.view',
                    ],

                    'Sidebar Utama' => [
                        'menusidebar.view'
                    ],

                    'Sidebar Bukukas' => [
                        'cashbooksidebar.view'
                    ],

                    'Data Pengguna' => [
                        'user.view',
                        'user.create',
                        'user.edit',
                        'user.delete',
                    ],

                    'Peran/Role' => [
                        'role.view',
                        'role.create',
                        // 'role.edit',
                        'role.delete',
                    ],

                    'Izin/Permission' => [
                        'permission.view',
                        'permission.create',
                        // 'permission.edit',
                        // 'permission.delete',
                    ],
                ],
            ],
        ];

        // $permissions_data = [
        // 'Master Data' => [
        //     'Mata Uang' => ['matauang.view','matauang.create','matauang.edit','matauang.delete'],
        //     'Cabang'    => ['cabang.view','cabang.create','cabang.edit','cabang.delete'],
        // ],

        // 'Marketing' => [
        //     'Perumahan / Mata Uang' => ['matauang.view','matauang.create','matauang.edit','matauang.delete'],
        //     'Perumahan / Cabang'    => ['cabang.view','cabang.create','cabang.edit','cabang.delete'],
        //     'Perumahan / Pajak'     => ['pajak.view','pajak.create','pajak.edit','pajak.delete'],
        // ],
        // ];

        // $permissions_data = [
        //     'Master Data' => [
        //         'Mata Uang' => [
        //             'matauang.view', 
        //             'matauang.create', 
        //             'matauang.edit', 
        //             'matauang.delete'
        //         ],
                
        //         'Cabang' => [
        //             'cabang.view',
        //             'cabang.create',
        //             'cabang.edit',
        //             'cabang.delete',
        //         ],

        //         'Status Pelanggan' => [
        //             'statuspelanggan.view',
        //             'statuspelanggan.create',
        //             'statuspelanggan.edit',
        //             'statuspelanggan.delete',
        //         ],

        //         'Tipe Pelanggan' => [
        //             'tipepelanggan.view',
        //             'tipepelanggan.create',
        //             'tipepelanggan.edit',
        //             'tipepelanggan.delete',
        //         ],

        //         'Pelanggan' => [
        //             'pelanggan.view',
        //             'pelanggan.create',
        //             'pelanggan.edit',
        //             'pelanggan.delete',
        //         ],

        //         'Pegawai' => [
        //             'pegawai.view',
        //             'pegawai.create',
        //             'pegawai.edit',
        //             'pegawai.delete',
        //         ],

        //         'Pemasok' => [
        //             'pemasok.view',
        //             'pemasok.create',
        //             'pemasok.edit',
        //             'pemasok.delete',
        //         ],

        //         'Distributor/Penjual' => [
        //             'distributor.view',
        //             'distributor.create',
        //             'distributor.edit',
        //             'distributor.delete',
        //         ],

        //         'Departemen' => [
        //             'departemen.view',
        //             'departemen.create',
        //             'departemen.edit',
        //             'departemen.delete',
        //         ],

        //         'Syarat' => [
        //             'syaratpembayaran.view',
        //             'syaratpembayaran.create',
        //             'syaratpembayaran.edit',
        //             'syaratpembayaran.delete',
        //         ],

        //         'Pajak' => [
        //             'pajak.view',
        //             'pajak.create',
        //             'pajak.edit',
        //             'pajak.delete',
        //         ],
        //     ],

        //     'Marketing' => [
        //         'Perumahan' => [
        //             'Mata Uang' => [
        //                 'matauang.view', 
        //                 'matauang.create', 
        //                 'matauang.edit', 
        //                 'matauang.delete'
        //             ],
                    
        //             'Cabang' => [
        //                 'cabang.view',
        //                 'cabang.create',
        //                 'cabang.edit',
        //                 'cabang.delete',
        //             ],

        //             'Status Pelanggan' => [
        //                 'statuspelanggan.view',
        //                 'statuspelanggan.create',
        //                 'statuspelanggan.edit',
        //                 'statuspelanggan.delete',
        //             ],

        //             'Tipe Pelanggan' => [
        //                 'tipepelanggan.view',
        //                 'tipepelanggan.create',
        //                 'tipepelanggan.edit',
        //                 'tipepelanggan.delete',
        //             ],

        //             'Pelanggan' => [
        //                 'pelanggan.view',
        //                 'pelanggan.create',
        //                 'pelanggan.edit',
        //                 'pelanggan.delete',
        //             ],

        //             'Pegawai' => [
        //                 'pegawai.view',
        //                 'pegawai.create',
        //                 'pegawai.edit',
        //                 'pegawai.delete',
        //             ],

        //             'Pemasok' => [
        //                 'pemasok.view',
        //                 'pemasok.create',
        //                 'pemasok.edit',
        //                 'pemasok.delete',
        //             ],

        //             'Distributor/Penjual' => [
        //                 'distributor.view',
        //                 'distributor.create',
        //                 'distributor.edit',
        //                 'distributor.delete',
        //             ],

        //             'Departemen' => [
        //                 'departemen.view',
        //                 'departemen.create',
        //                 'departemen.edit',
        //                 'departemen.delete',
        //             ],

        //             'Syarat' => [
        //                 'syaratpembayaran.view',
        //                 'syaratpembayaran.create',
        //                 'syaratpembayaran.edit',
        //                 'syaratpembayaran.delete',
        //             ],

        //             'Pajak' => [
        //                 'pajak.view',
        //                 'pajak.create',
        //                 'pajak.edit',
        //                 'pajak.delete',
        //             ],
        //         ],
        //     ],
        // ];

        foreach ($this->groups as $perms) {
            foreach ($perms as $p) Permission::firstOrCreate(['name' => $p]);
        }

        $roles = Role::orderBy('name')->get();
        $permissions = Permission::orderBy('name')->get()->keyBy('name');

        return view('usermanagement.dataizin', [
            'roles' => $roles,
            'groups' => $this->groups,
            'permissions' => $permissions,
            'permissions_data' => $permissions_data
        ]);
    }

    public function update(Request $r)
    {
        $validated = $r->validate([
            'matrix'       => 'nullable|array',
            'matrix.*'     => 'array',
            'matrix.*.*'   => 'string',
        ]);

        $matrix = $validated['matrix'] ?? [];

        DB::beginTransaction();
        try {
            $roles = Role::pluck('id', 'id');

            foreach ($roles as $roleId) {
                $permNames = $matrix[$roleId] ?? [];
                $role = Role::find($roleId);
                if (!$role) continue;

                if ($role->name === 'SuperAdmin') {
                    $role->syncPermissions(Permission::all());
                    continue;
                }

                $role->syncPermissions($permNames);
            }

            Artisan::call('permission:cache-reset');
            Artisan::call('roles:sync-legacy'); 

            DB::commit();
            sweetalert()->success('Update izin role berhasil :)');
            return redirect()->back();

        } catch (\Throwable $e) {
            DB::rollBack();
            sweetalert()->error('Tambah Role gagal :('. $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

}
