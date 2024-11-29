<?php

namespace Database\Seeders\Order;

use App\Models\Order\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 50; $i++) {
            Order::create([
                'order_number' => 'ORD-' . Str::random(8),
                'customer_email' => fake()->unique()->safeEmail(),
                'customer_fullname' => fake()->name(),
                'total_cost' => fake()->randomFloat(2, 10, 500),
                'discount_amout' => fake()->randomFloat(2, 0, 100),
                'shipping' => fake()->randomElement(['standard', 'express', 'pickup']),
                'note' => fake()->optional()->sentence(),
                'status' => fake()->randomElement(['Vyplatená', 'Vo výrobe', 'Čaká na vygenerovanie', 'Odoslaná', 'Čaká na platbu']),
                'updated_at' => now(),
            ]);
        }
    }
}
