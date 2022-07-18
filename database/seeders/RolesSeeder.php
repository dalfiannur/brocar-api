<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Super Admin', 'Seller', 'Agent', 'Admin Sales', 'Admin Operational'];

        foreach ($roles as $name) {
            $role = new Role([
                'name' => $name
            ]);
            $role->save();
        }
    }
}
