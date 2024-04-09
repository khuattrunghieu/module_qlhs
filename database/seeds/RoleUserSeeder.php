<?php

use Illuminate\Database\Seeder;
use App\Models\RoleUser;
use Carbon\Carbon;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoleUser::truncate();
        RoleUser::insert([
            'user_id' => 1,
            'role_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        RoleUser::insert([
            'user_id' => 1,
            'role_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        RoleUser::insert([
            'user_id' => 1,
            'role_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        RoleUser::insert([
            'user_id' => 1,
            'role_id' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        RoleUser::insert([
            'user_id' => 1,
            'role_id' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        RoleUser::insert([
            'user_id' => 1,
            'role_id' => 6,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        RoleUser::insert([
            'user_id' => 1,
            'role_id' => 7,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        RoleUser::insert([
            'user_id' => 1,
            'role_id' => 8,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        RoleUser::insert([
            'user_id' => 1,
            'role_id' => 9,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        RoleUser::insert([
            'user_id' => 1,
            'role_id' => 10,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        RoleUser::insert([
            'user_id' => 1,
            'role_id' => 11,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        RoleUser::insert([
            'user_id' => 1,
            'role_id' => 12,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        RoleUser::insert([
            'user_id' => 1,
            'role_id' => 13,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        RoleUser::insert([
            'user_id' => 1,
            'role_id' => 14,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        RoleUser::insert([
            'user_id' => 1,
            'role_id' => 15,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        RoleUser::insert([
            'user_id' => 1,
            'role_id' => 16,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        RoleUser::insert([
            'user_id' => 2,
            'role_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        RoleUser::insert([
            'user_id' => 2,
            'role_id' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        RoleUser::insert([
            'user_id' => 2,
            'role_id' => 9,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        RoleUser::insert([
            'user_id' => 2,
            'role_id' => 13,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
