<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Artisan;

class RolePermSeeder extends Seeder
{
    public function run(): void
    {

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $perms = [
        
            'siteplan.view',
            'siteplan.create',
            'siteplan.edit',
            'siteplan.delete',

            'kluster.view',
            'kluster.create',
            'kluster.edit',
            'kluster.delete',

            'kavling.view',
            'kavling.create',
            'kavling.edit',
            'kavling.delete',

            'fasum.view',
            'fasum.create',
            'fasum.edit',
            'fasum.delete',

            'fasos.view',
            'fasos.create',
            'fasos.edit',
            'fasos.delete',

            'matauang.view',
            'matauang.create',
            'matauang.edit',
            'matauang.delete',

            'cabang.view',
            'cabang.create',
            'cabang.edit',
            'cabang.delete',

            'statuspelanggan.view',
            'statuspelanggan.create',
            'statuspelanggan.edit',
            'statuspelanggan.delete',

            'tipepelanggan.view',
            'tipepelanggan.create',
            'tipepelanggan.edit',
            'tipepelanggan.delete',


            'pelanggan.view',
            'pelanggan.create',
            'pelanggan.edit',
            'pelanggan.delete',

            'pegawai.view',
            'pegawai.create',
            'pegawai.edit',
            'pegawai.delete',

            'pemasok.view',
            'pemasok.create',
            'pemasok.edit',
            'pemasok.delete',

            'distributor.view',
            'distributor.create',
            'distributor.edit',
            'distributor.delete',

            'departemen.view',
            'departemen.create',
            'departemen.edit',
            'departemen.delete',

            'syaratpembayaran.view',
            'syaratpembayaran.create',
            'syaratpembayaran.edit',
            'syaratpembayaran.delete',

            'pajak.view',
            'pajak.create',
            'pajak.edit',
            'pajak.delete',

            'prospek.view',
            'prospek.create',
            'prospek.edit',
            'prospek.delete',

            'konsumen.view',
            'konsumen.create',
            'konsumen.edit',
            'konsumen.delete',

            'booking.view',
            'booking.create',
            'booking.edit',
            'booking.delete',

            'suratperintahpembangunan.view',
            'suratperintahpembangunan.create',
            'suratperintahpembangunan.edit',
            'suratperintahpembangunan.delete',

            'masterbiayalahan.view',
            'masterbiayalahan.create',
            'masterbiayalahan.edit',
            'masterbiayalahan.delete',

            'lahan.view',
            'lahan.create',
            'lahan.edit',
            'lahan.delete',

            'pembangunan.view',
            'pembangunan.create',
            'pembangunan.edit',
            'pembangunan.delete',

            'spk.view',
            'spk.create',
            'spk.edit',
            'spk.delete',

            'rab.view',
            'rab.create',
            'rab.edit',
            'rab.delete',

            'pbb.view',
            'pbb.create',
            'pbb.edit',
            'pbb.delete',

            'pbl.view',
            'pbl.create',
            'pbl.edit',
            'pbl.delete',

            'progress.view',
            'progress.create',
            'progress.delete',

            'pembayaran-booking.view',
            'pembayaran-booking.create',
            'pembayaran-booking.edit',
            'pembayaran-booking.delete',
    
            'pembelian.view',
            'pembelian.create',
            'pembelian.edit',
            'pembelian.delete',
        
            'permintaan.view',
            'permintaan.create',
            'permintaan.edit',
            'permintaan.delete',

            'pesanan.view',
            'pesanan.create',
            'pesanan.edit',
            'pesanan.delete',
        
            'penerimaan.view',
            'penerimaan.create',
            'penerimaan.edit',
            'penerimaan.delete',

            'faktur.view',
            'faktur.create',
            'faktur.edit',
            'faktur.delete',
        
            'pembayaran.view',
            'pembayaran.create',
            'pembayaran.edit',
            'pembayaran.delete',

            'returpembelian.view',
            'returpembelian.create',
            'returpembelian.edit',
            'returpembelian.delete',
    
            'penjualan.view',
            'penjualan.create',
            'penjualan.edit',
            'penjualan.delete',
        
            'persediaan.view',
            'persediaan.create',
            'persediaan.edit',
            'persediaan.delete',

            'satuan.view',
            'satuan.create',
            'satuan.edit',
            'satuan.delete',

            'gudang.view',
            'gudang.create',
            'gudang.edit',
            'gudang.delete',

            'kategori.view',
            'kategori.create',
            'kategori.edit',
            'kategori.delete',

            'barang.view',
            'barang.create',
            'barang.edit',
            'barang.delete',

            'penyesuaian.view',
            'penyesuaian.create',
            'penyesuaian.edit',
            'penyesuaian.delete',

            'pindahan.view',
            'pindahan.create',
            'pindahan.edit',
            'pindahan.delete',

            'barangpergudang.view',
            'barangpergudang.create',
            'barangpergudang.edit',
            'barangpergudang.delete',

            'aktiva.view',
            'aktiva.create',
            'aktiva.edit',
            'aktiva.delete',

            'laporan.view',

            'pengaturan.view',

            'user.create',
            'user.edit',
            'user.view',
            'user.delete',

            'role.create',
            'role.edit',
            'role.view',
            'role.delete',
            
            'permission.create',
            'permission.view',
            'permission.edit',
            'permission.delete',
        ];

         foreach ($perms as $p) {
            Permission::findOrCreate($p, 'web');
        }

        $super = Role::findOrCreate('SuperAdmin', 'web');

        $super->syncPermissions(Permission::all());

        Artisan::call('roles:sync-legacy'); 

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // $roles = [
        //     ['name' => 'SuperAdmin', 'department' => 'General'],
        //     ['name' => 'Customer', 'department' => null],
        //     ['name' => 'Marketing', 'department' => 'Marketing'],
        //     ['name' => 'Logistic', 'department' => 'Marketing'],
        //     ['name' => 'Purchasing', 'department' => null],
        //     ['name' => 'Project', 'department' => null],
        //     ['name' => 'Accounting', 'department' => null],
        //     ['name' => 'Direksi', 'department' => null],
        // ];

        // foreach ($roles as $r) {
        //     $role = Role::firstOrCreate(['name' => $r['name']]);
        //     if (isset($r['department'])) {
        //         $role->department = $r['department'];
        //         $role->save();
        //     }
        // }

        // $groups = [
        //     'Customer Booking' => ['booking.view'],
        //     'SPP'              => ['spp.view'],
        //     'Cluster'          => ['cluster.view'],
        //     'Kavling'          => ['kapling.view'],
        //     'Prospek'          => ['prospek.view','prospek.create','prospek.edit','prospek.delete'],
        //     'Siteplan'         => ['siteplan.view','siteplan.marketing'],
        // ];
        // foreach ($groups as $perms) {
        //     foreach ($perms as $p) Permission::firstOrCreate(['name' => $p]);
        // }

        // $map = [
        //     'Marketing'  => ['prospek.view','prospek.create','prospek.edit','siteplan.view','siteplan.marketing'],
        //     'Direksi'    => ['booking.view','spp.view','cluster.view','kapling.view','siteplan.view'],
        //     'Accounting' => ['booking.view'],
        //     'Project'    => ['siteplan.view'],
        //     'Logistic'   => [],
        //     'Purchasing' => [],
        //     'Customer'   => [],
        // ];

        // // SuperAdmin dapat semua
        // $super = Role::where('name','SuperAdmin')->first();
        // $super?->syncPermissions(Permission::all());

        // foreach ($map as $roleName => $permNames) {
        //     $role = Role::where('name',$roleName)->first();
        //     if ($role) $role->syncPermissions($permNames);
        // }
    }
}

