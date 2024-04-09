<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        Role::insert([
            'name' => 'Xem Student',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Role::insert([
            'name' => 'Thêm Student',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Role::insert([
            'name' => 'Sửa Student',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Role::insert([
            'name' => 'Xóa Student',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Role::insert([
            'name' => 'Xem Teacher',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Role::insert([
            'name' => 'Thêm Teacher',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Role::insert([
            'name' => 'Sửa Teacher',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Role::insert([
            'name' => 'Xóa Teacher',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Role::insert([
            'name' => 'Xem Class',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Role::insert([
            'name' => 'Thêm Class',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Role::insert([
            'name' => 'Sửa Class',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Role::insert([
            'name' => 'Xóa Class',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Role::insert([
            'name' => 'Xem School',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Role::insert([
            'name' => 'Thêm School',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Role::insert([
            'name' => 'Sửa School',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Role::insert([
            'name' => 'Xóa School',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
    }
}
