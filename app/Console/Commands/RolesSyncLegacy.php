<?php

namespace App\Console\Commands;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class RolesSyncLegacy extends Command
{
    protected $signature = 'roles:sync-legacy';
    protected $description = 'Sync users.role_name -> Spatie roles (guard:web)';

    public function handle()
    {
        $labels = User::whereNotNull('role_name')->distinct()->pluck('role_name');

        foreach ($labels as $label) {
            $name = Str::of($label)->toString(); // "Marketing" -> "marketing"
            Role::findOrCreate($name, 'web');
        }

        User::whereNotNull('role_name')->chunkById(200, function ($users) {
            foreach ($users as $u) {
                $name = Str::of($u->role_name)->toString();
                $u->syncRoles([$name]);
            }
        });

        $this->info('Legacy roles synced to Spatie.');
        return 0;
    }
}
