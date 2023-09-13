<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Item;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $item = [
            [
                'uuid'      => 'a4f70d2e-a573-45b4-92b6-b6e27bb7a7f1',
                'item_name' => 'Seblak',
                'price'     => '5000'
            ],
            [
                'uuid'      => 'a4f70d2e-a573-45b4-92b6-b6e27bb7a7f2',
                'item_name' => 'Rujak Kangkung',
                'price'     => '5000'
            ],
            [
                'uuid'      => 'a4f70d2e-a573-45b4-92b6-b6e27bb7a7f3',
                'item_name' => 'Es Jeruk',
                'price'     => '5000'
            ],
        ];
        
        Item::insert($item);
    }
}
