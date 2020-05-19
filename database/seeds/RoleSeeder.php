<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add user role
        DB::table('roles')->insert([
            'name' => 'user'
        ]);

        //add user ADMIN
        DB::table('roles')->insert([
            'name' => 'admin'
        ]);

        //create relationship
        $user =\App\User::find(1);
        $user->roles()->attach([1,2]);
    }
}
