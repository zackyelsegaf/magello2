<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        //  permissions
        // Schema::create('permissions', function (Blueprint $t) {
        //     $t->bigIncrements('id');
        //     $t->string('name');
        //     $t->string('guard_name')->default('web');
        //     $t->timestamps();
        //     $t->unique(['name','guard_name']);
        // });

        //  roles (+ optional department kolom ringan)
        // Schema::create('roles', function (Blueprint $t) {
        //     $t->bigIncrements('id');
        //     $t->string('name');
        //     $t->string('guard_name')->default('web');
        //     $t->string('department')->nullable();  boleh hapus kalau nggak perlu
        //     $t->timestamps();
        //     $t->unique(['name','guard_name']);
        // });

        //  pivot: model_has_permissions
        // Schema::create('model_has_permissions', function (Blueprint $t) {
        //     $t->unsignedBigInteger('permission_id');
        //     $t->string('model_type');
        //     $t->unsignedBigInteger('model_id');

        //     $t->index(['model_id','model_type'], 'mhp_model_id_model_type_index');
        //     $t->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');

        //     $t->primary(['permission_id','model_id','model_type'], 'mhp_permission_model_type_primary');
        // });

        //  pivot: model_has_roles
        // Schema::create('model_has_roles', function (Blueprint $t) {
        //     $t->unsignedBigInteger('role_id');
        //     $t->string('model_type');
        //     $t->unsignedBigInteger('model_id');

        //     $t->index(['model_id','model_type'], 'mhr_model_id_model_type_index');
        //     $t->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

        //     $t->primary(['role_id','model_id','model_type'], 'mhr_role_model_type_primary');
        // });

        //  pivot: role_has_permissions
        // Schema::create('role_has_permissions', function (Blueprint $t) {
        //     $t->unsignedBigInteger('permission_id');
        //     $t->unsignedBigInteger('role_id');

        //     $t->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        //     $t->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

        //     $t->primary(['permission_id','role_id'], 'rhp_permission_id_role_id_primary');
        // });

        //  bersihkan cache permission kalau ada
        // cache()->forget(config('permission.cache.key', 'spatie.permission.cache'));
    }

    public function down(): void
    {
        Schema::dropIfExists('role_has_permissions');
        Schema::dropIfExists('model_has_roles');
        Schema::dropIfExists('model_has_permissions');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permissions');
    }
};
