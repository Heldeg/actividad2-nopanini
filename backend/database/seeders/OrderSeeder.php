<?php

namespace Database\Seeders;

use App\Models\Contain;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Orders and order details
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $order = Order::create([
                'total' => rand(10, 50),
                'type' => ($i % 2 == 0) ? 'physical' : 'online', // Mapeo simple
                'client_id' => $i,
                'employee_id' => $i,
                'library_id' => $i,
            ]);

            Contain::create([
                'order_id' => $order->id,
                'isbn' => '978-' . sprintf('%04d', $i),
                'quantity' => rand(1, 3),
            ]);
        }
    }
}
