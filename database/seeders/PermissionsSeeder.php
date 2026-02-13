<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $entities = ['movie', 'cinema', 'hall', 'city', 'schedule'];
        $permissions = [];

        foreach ($entities as $entity) {
            $permissions[] = "view $entity";
            $permissions[] = "manage $entity";
        }

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        $adminRole->givePermissionTo(Permission::all());
        $userPermissions = array_filter($permissions, fn($p) => str_starts_with($p, 'view'));
        $userRole->givePermissionTo($userPermissions);

        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'admin',
                'password' => Hash::make('admin'),
            ]
        );
        $admin->assignRole('admin');

        $user = User::find(2);
        $user->assignRole('user');
    }
}
