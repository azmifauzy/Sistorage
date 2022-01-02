<?php

namespace Database\Seeders;

use App\Models\Box;
use App\Models\Item;
use App\Models\Role;
use App\Models\User;
use App\Models\Status;
use App\Models\Category;
use App\Models\StatusBox;
use App\Models\Storage;
use Illuminate\Database\Seeder;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'Admin'],
            ['name' => 'Kasir']
        ];
        $StatusBox = [
            ['name' => 'Pending'],
            ['name' => 'Terkirim']
        ];
        $status = [
            ['name' => 'Active'],
            ['name' => 'Unactive']
        ];
        $users = [
            ['status_id' => 1, 'role_id' => 1, 'name' => 'Azmi', 'email' => 'azmi@gmail.com', 'password' => bcrypt('password')],
            ['status_id' => 2, 'role_id' => 2, 'name' => 'Alfatih', 'email' => 'alfatih@gmail.com', 'password' => bcrypt('password')]
        ];

        $categories = [
            ['name' => 'Makanan'],
            ['name' => 'Minuman'],
            ['name' => 'Elektronik'],
            ['name' => 'Fashion'],
            ['name' => 'Gadget'],
        ];

        // $box = [
        //     'id' => IdGenerator::generate(['table' => 'boxes', 'length' => 12, 'prefix' => "BOX-"]),
        //     'statusBox_id' => 1,
        //     'sender' => 'PT. Agensi',
        //     'receiver' => 'Muhammad Azmi Fauzi',
        //     'address' => 'Jl. Kemangun',
        //     'telepon' => '08881212123'
        // ];

        // $items = [
        //     ['user_id' => 1, 'category_id' => 1, 'box_id' => 'BOX-00000001', 'name' => 'Mie Sedap', 'price' => 3000, 'value' => 3],
        //     ['user_id' => 1, 'category_id' => 2, 'box_id' => 'BOX-00000001', 'name' => 'Coca Cola', 'price' => 5000, 'value' => 12],
        //     ['user_id' => 1, 'category_id' => 3, 'box_id' => 'BOX-00000001', 'name' => 'Televisi', 'price' => 5000000, 'value' => 1],
        // ];

        $storages = [
            ['user_id' => 1, 'category_id' => 1, 'name' => 'Mie Sedap', 'price' => 3000, 'value' => 60],
            ['user_id' => 1, 'category_id' => 1, 'name' => 'Chiki Jeki', 'price' => 1000, 'value' => 0],
            ['user_id' => 1, 'category_id' => 1, 'name' => 'Nabati', 'price' => 1000, 'value' => 0],
            ['user_id' => 1, 'category_id' => 2, 'name' => 'Teh Tarik', 'price' => 2000, 'value' => 24],
            ['user_id' => 1, 'category_id' => 2, 'name' => 'Bad Day Coffe', 'price' => 2000, 'value' => 24],
            ['user_id' => 1, 'category_id' => 3, 'name' => 'Televisi', 'price' => 10000000, 'value' => 6],
            ['user_id' => 1, 'category_id' => 3, 'name' => 'Radio', 'price' => 8000000, 'value' => 7],
            ['user_id' => 1, 'category_id' => 4, 'name' => 'Jam Tangan', 'price' => 50000000, 'value' => 5],
            ['user_id' => 1, 'category_id' => 4, 'name' => 'Sepatu Abibas', 'price' => 25000000, 'value' => 4],
            ['user_id' => 1, 'category_id' => 5, 'name' => 'Samsung A01', 'price' => 2500000, 'value' => 11],
        ];

        for ($i = 0; $i < count($roles); $i++) {
            Role::create($roles[$i]);
            Status::create($status[$i]);
            StatusBox::create($StatusBox[$i]);
            User::create($users[$i]);
        }

        for ($i = 0; $i < count($categories); $i++) {
            Category::create($categories[$i]);
        }

        for ($i = 0; $i < count($storages); $i++) {
            Storage::create($storages[$i]);
        }
    }
}
