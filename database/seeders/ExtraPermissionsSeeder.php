<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class ExtraPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'list listings']);
        Permission::create(['name' => 'view listings']);
        Permission::create(['name' => 'create listings']);
        Permission::create(['name' => 'update listings']);
        Permission::create(['name' => 'delete listings']);
        
        Permission::create(['name' => 'list costings']);
        Permission::create(['name' => 'view costings']);
        Permission::create(['name' => 'create costings']);
        Permission::create(['name' => 'update costings']);
        Permission::create(['name' => 'delete costings']);

        Permission::create(['name' => 'list ebays']);
        Permission::create(['name' => 'view ebays']);
        Permission::create(['name' => 'create ebays']);
        Permission::create(['name' => 'update ebays']);
        Permission::create(['name' => 'delete ebays']);        

        Permission::create(['name' => 'list finalized']);
        Permission::create(['name' => 'view finalized']);
        Permission::create(['name' => 'create finalized']);
        Permission::create(['name' => 'update finalized']);
        Permission::create(['name' => 'delete finalized']);

        $listing = Role::create(['name' => 'Listing']);
        
        $listing->givePermissionTo('list appliances');
        $listing->givePermissionTo('view appliances');
        $listing->givePermissionTo('create appliances');
        $listing->givePermissionTo('update appliances');
        $listing->givePermissionTo('delete appliances');

        $listing->givePermissionTo('list listings');
        $listing->givePermissionTo('view listings');
        $listing->givePermissionTo('create listings');
        $listing->givePermissionTo('update listings');
        $listing->givePermissionTo('delete listings');

        $listing->givePermissionTo('list actions');
        $listing->givePermissionTo('view actions');
        $listing->givePermissionTo('create actions');
        $listing->givePermissionTo('update actions');
        $listing->givePermissionTo('delete actions');

        $costing = Role::create(['name' => 'Costing']);
        
        $costing->givePermissionTo('list appliances');
        $costing->givePermissionTo('view appliances');
        $costing->givePermissionTo('create appliances');
        $costing->givePermissionTo('update appliances');
        $costing->givePermissionTo('delete appliances');

        $costing->givePermissionTo('list costings');
        $costing->givePermissionTo('view costings');
        $costing->givePermissionTo('create costings');
        $costing->givePermissionTo('update costings');
        $costing->givePermissionTo('delete costings');

        $costing->givePermissionTo('list actions');
        $costing->givePermissionTo('view actions');
        $costing->givePermissionTo('create actions');
        $costing->givePermissionTo('update actions');
        $costing->givePermissionTo('delete actions');

        $ebay = Role::create(['name' => 'Ebay']);
        
        $ebay->givePermissionTo('list appliances');
        $ebay->givePermissionTo('view appliances');
        $ebay->givePermissionTo('create appliances');
        $ebay->givePermissionTo('update appliances');
        $ebay->givePermissionTo('delete appliances');

        $ebay->givePermissionTo('list ebays');
        $ebay->givePermissionTo('view ebays');
        $ebay->givePermissionTo('create ebays');
        $ebay->givePermissionTo('update ebays');
        $ebay->givePermissionTo('delete ebays');

        $ebay->givePermissionTo('list actions');
        $ebay->givePermissionTo('view actions');
        $ebay->givePermissionTo('create actions');
        $ebay->givePermissionTo('update actions');
        $ebay->givePermissionTo('delete actions');

        $finalized = Role::create(['name' => 'Finalized']);
        
        $finalized->givePermissionTo('list appliances');
        $finalized->givePermissionTo('view appliances');
        $finalized->givePermissionTo('create appliances');
        $finalized->givePermissionTo('update appliances');
        $finalized->givePermissionTo('delete appliances');

        $finalized->givePermissionTo('list finalized');
        $finalized->givePermissionTo('view finalized');
        $finalized->givePermissionTo('create finalized');
        $finalized->givePermissionTo('update finalized');
        $finalized->givePermissionTo('delete finalized');

        $finalized->givePermissionTo('list actions');
        $finalized->givePermissionTo('view actions');
        $finalized->givePermissionTo('create actions');
        $finalized->givePermissionTo('update actions');
        $finalized->givePermissionTo('delete actions');

        $allPermissions = Permission::all();
        $adminRole = Role::where('name', 'Admin')->first();
        $adminRole->givePermissionTo($allPermissions); 
        
        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
