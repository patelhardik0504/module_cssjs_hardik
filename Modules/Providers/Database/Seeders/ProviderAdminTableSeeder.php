<?php

namespace Modules\Providers\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Providers\Entities\Provider;
use Hash;
class ProviderAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Provider::create([
            'name' => 'Admin',
            'email' => 'hardik@admin.com',
            'password' => Hash::make('Admin@12345'),
        ]);

        // $this->call("OthersTableSeeder");
    }
}
