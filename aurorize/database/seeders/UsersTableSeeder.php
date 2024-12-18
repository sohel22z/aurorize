<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projectname = strtolower(str_replace(" ", "", config('app.name')));
        User::firstOrCreate([
            'id' => 1,
        ], [
            'name' => "Admin",
            'email' => 'admin@' . $projectname . '.com',
            'password' => bcrypt('123456789'),
            'role_id' => "1",
            'is_active' => "1",
            'email_verified_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        User::firstOrCreate([
            'id' => 2,
        ], [
            'name' => "User",
            'email' => 'user@gmail.com',
            'password' => bcrypt('123456789'),
            'role_id' => 2,
            'is_active' => 1,
            'is_complete_profile' => 1,
            'email_verified_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
