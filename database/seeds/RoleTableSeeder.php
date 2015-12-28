<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Role;

class RoleTableSeeder extends Seeder{

    public function run()
    {

        // if (App::environment() === 'production') {
        //     exit('I just stopped you getting fired. Love, Amo.');
        // }

        // DB::table('roles')->truncate();

        Role::create([
            'id'            => 1,
            'name'          => 'Admin',
            'description'   => 'Use this account with extreme caution.'
        ]);

        Role::create([
            'id'            => 2,
            'name'          => 'Managerial',
            'description'   => 'Full access to view the reports.'
        ]);

        Role::create([
            'id'            => 3,
            'name'          => 'Petugas',
            'description'   => 'Ability to create master data.'
        ]);
    }

}
