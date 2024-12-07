<?php

namespace Database\Seeders\Order;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("order_item_states")->insert([
            "name" => "Čaká na výrobu",
            "identifier" => "awaiting_production",
        ]);

        DB::table("order_item_states")->insert([
            "name" => "Vo výrobe",
            "identifier" => "in_production",
        ]);

        DB::table("order_item_states")->insert([
            "name" => "Čaká na kontrolu výroby",
            "identifier" => "awaiting_review",
        ]);

        DB::table("order_item_states")->insert([
            "name" => "Dokončené",
            "identifier" => "completed",
        ]);
    }
}
