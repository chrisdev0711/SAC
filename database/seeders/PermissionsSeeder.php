<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        
        // Create default permissions
        Permission::create(['name' => 'list appliances']);
        Permission::create(['name' => 'view appliances']);
        Permission::create(['name' => 'create appliances']);
        Permission::create(['name' => 'update appliances']);
        Permission::create(['name' => 'delete appliances']);
        
        Permission::create(['name' => 'list actions']);
        Permission::create(['name' => 'view actions']);
        Permission::create(['name' => 'create actions']);
        Permission::create(['name' => 'update actions']);
        Permission::create(['name' => 'delete actions']);

        Permission::create(['name' => 'list checkins']);
        Permission::create(['name' => 'view checkins']);
        Permission::create(['name' => 'create checkins']);
        Permission::create(['name' => 'update checkins']);
        Permission::create(['name' => 'delete checkins']);

        Permission::create(['name' => 'list plugchecks']);
        Permission::create(['name' => 'view plugchecks']);
        Permission::create(['name' => 'create plugchecks']);
        Permission::create(['name' => 'update plugchecks']);
        Permission::create(['name' => 'delete plugchecks']);

        Permission::create(['name' => 'list faultdiagnoses']);
        Permission::create(['name' => 'view faultdiagnoses']);
        Permission::create(['name' => 'create faultdiagnoses']);
        Permission::create(['name' => 'update faultdiagnoses']);
        Permission::create(['name' => 'delete faultdiagnoses']);
        
        Permission::create(['name' => 'list cleanings']);
        Permission::create(['name' => 'view cleanings']);
        Permission::create(['name' => 'create cleanings']);
        Permission::create(['name' => 'update cleanings']);
        Permission::create(['name' => 'delete cleanings']);

        Permission::create(['name' => 'list qualitycontrols']);
        Permission::create(['name' => 'view qualitycontrols']);
        Permission::create(['name' => 'create qualitycontrols']);
        Permission::create(['name' => 'update qualitycontrols']);
        Permission::create(['name' => 'delete qualitycontrols']);


        $warehouse = Role::create(['name' => 'Warehouse']);
        
        $warehouse->givePermissionTo('list appliances');
        $warehouse->givePermissionTo('view appliances');
        $warehouse->givePermissionTo('create appliances');
        $warehouse->givePermissionTo('update appliances');
        $warehouse->givePermissionTo('delete appliances');

        $warehouse->givePermissionTo('list checkins');
        $warehouse->givePermissionTo('view checkins');
        $warehouse->givePermissionTo('create checkins');
        $warehouse->givePermissionTo('update checkins');
        $warehouse->givePermissionTo('delete checkins');

        $warehouse->givePermissionTo('list actions');
        $warehouse->givePermissionTo('view actions');
        $warehouse->givePermissionTo('create actions');
        $warehouse->givePermissionTo('update actions');
        $warehouse->givePermissionTo('delete actions');

        $engineering = Role::create(['name' => 'Engineering']);

        $engineering->givePermissionTo('list appliances');
        $engineering->givePermissionTo('view appliances');
        $engineering->givePermissionTo('create appliances');
        $engineering->givePermissionTo('update appliances');
        $engineering->givePermissionTo('delete appliances');

        $engineering->givePermissionTo('list plugchecks');
        $engineering->givePermissionTo('view plugchecks');
        $engineering->givePermissionTo('create plugchecks');
        $engineering->givePermissionTo('update plugchecks');
        $engineering->givePermissionTo('delete plugchecks');

        $engineering->givePermissionTo('list faultdiagnoses');
        $engineering->givePermissionTo('view faultdiagnoses');
        $engineering->givePermissionTo('create faultdiagnoses');
        $engineering->givePermissionTo('update faultdiagnoses');
        $engineering->givePermissionTo('delete faultdiagnoses');

        $engineering->givePermissionTo('list actions');
        $engineering->givePermissionTo('view actions');
        $engineering->givePermissionTo('create actions');
        $engineering->givePermissionTo('update actions');
        $engineering->givePermissionTo('delete actions');
        
        $cleaning = Role::create(['name' => 'Cleaning']);
        
        $cleaning->givePermissionTo('list appliances');
        $cleaning->givePermissionTo('view appliances');
        $cleaning->givePermissionTo('create appliances');
        $cleaning->givePermissionTo('update appliances');
        $cleaning->givePermissionTo('delete appliances');

        $cleaning->givePermissionTo('list cleanings');
        $cleaning->givePermissionTo('view cleanings');
        $cleaning->givePermissionTo('create cleanings');
        $cleaning->givePermissionTo('update cleanings');
        $cleaning->givePermissionTo('delete cleanings');

        $cleaning->givePermissionTo('list actions');
        $cleaning->givePermissionTo('view actions');
        $cleaning->givePermissionTo('create actions');
        $cleaning->givePermissionTo('update actions');
        $cleaning->givePermissionTo('delete actions');

        $qualityControl = Role::create(['name' => 'QualityControl']);
        
        $qualityControl->givePermissionTo('list appliances');
        $qualityControl->givePermissionTo('view appliances');
        $qualityControl->givePermissionTo('create appliances');
        $qualityControl->givePermissionTo('update appliances');
        $qualityControl->givePermissionTo('delete appliances');

        $qualityControl->givePermissionTo('list qualitycontrols');
        $qualityControl->givePermissionTo('view qualitycontrols');
        $qualityControl->givePermissionTo('create qualitycontrols');
        $qualityControl->givePermissionTo('update qualitycontrols');
        $qualityControl->givePermissionTo('delete qualitycontrols');

        $qualityControl->givePermissionTo('list actions');
        $qualityControl->givePermissionTo('view actions');
        $qualityControl->givePermissionTo('create actions');
        $qualityControl->givePermissionTo('update actions');
        $qualityControl->givePermissionTo('delete actions');

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'Admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
