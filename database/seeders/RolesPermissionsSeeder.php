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
      'admin' => 'admin',
    ];

    public array $userPermissions;

    public function __construct()
    {
        $this->userPermissions = [
            Permissions::CREATE_USER->value,
            Permissions::READ_USER->value,
            Permissions::UPDATE_USER->value,
            Permissions::DELETE_USER->value,
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createRoles($this->roles);
        $this->createPermissions($this->userPermissions);
        $this->assignPermissions($this->roles['admin'], $this->userPermissions);

        // Assigning the role admin to the admin
        $admin = User::where('name', 'admin')->first();
        $admin->assignRole($this->roles['admin']);
    }

    private function assignPermissions($role ,array ...$permissionLists)
    {
        foreach ($permissionLists as $permissionList) {
            $role = Role::where('name', $role)->first();
            $role->syncPermissions($permissionList);
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
