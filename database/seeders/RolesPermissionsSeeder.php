<?php

namespace Database\Seeders;

use App\Enums\Permissions;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionsSeeder extends Seeder
{
    private array $roles = [
      'admin' => 'Super Admin',
    ];

    private array $userPermissions;

    private array $exercisePermissions;

    public function __construct()
    {
        $this->userPermissions = [
            Permissions::CREATE_USER->value,
            Permissions::READ_USER->value,
            Permissions::UPDATE_USER->value,
            Permissions::DELETE_USER->value,
        ];

        $this->exercisePermissions = [
            Permissions::UPDATE_EXERCISE->value,
            Permissions::DELETE_EXERCISE->value,
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create roles
        $this->createRoles($this->roles);

        // Create permissions
        $this->createPermissions($this->userPermissions, $this->exercisePermissions);

        // Assigning the role Super Admin to the admin
        $admin = User::where('name', 'admin')->first();
        $admin->assignRole($this->roles['admin']);
    }

    private function assignPermissions(string $role, array ...$permissionLists)
    {
        foreach ($permissionLists as $permissionList) {
            $role = Role::where('name', $role)->first();
            $role->givePermissionTo($permissionList);
        }
    }

    private function createPermissions(array ...$permissionLists)
    {
        foreach ($permissionLists as $permissionList) {
            foreach ($permissionList as $permission) {
                Permission::create([
                    'name' => $permission,
                ]);
            }
        }
    }

    private function createRoles(array $roles)
    {
        foreach ($roles as $role) {
            Role::create([
               'name' => $role
            ]);
        }
    }
}
