<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Adjustable Dumbbell Set (20kg)', 'sku' => 'TF-DUMB-001', 'category' => 'Free Weights', 'quantity' => 13, 'reorder_level' => 5, 'unit_price' => 149.99, 'supplier' => 'Titan Fitness'],
            ['name' => 'Non-Slip Yoga Mat (6mm)', 'sku' => 'TF-MAT-002', 'category' => 'Accessories', 'quantity' => 45, 'reorder_level' => 10, 'unit_price' => 29.50, 'supplier' => 'EcoFlex Supply'],
            ['name' => 'Pro Treadmill Pro-Run 5000', 'sku' => 'TF-TREAD-003', 'category' => 'Cardio', 'quantity' => 4, 'reorder_level' => 5, 'unit_price' => 899.00, 'supplier' => 'NordicTech'],
            ['name' => 'Resistance Band Set (5 Levels)', 'sku' => 'TF-BAND-004', 'category' => 'Accessories', 'quantity' => 6, 'reorder_level' => 10, 'unit_price' => 19.99, 'supplier' => 'FlexGear Ltd'],
            ['name' => 'Multi-Angle Weight Bench', 'sku' => 'TF-BENCH-005', 'category' => 'Strength', 'quantity' => 26, 'reorder_level' => 5, 'unit_price' => 199.99, 'supplier' => 'IronGrip Gym Hardware'],
            ['name' => 'Heavy Duty Power Rack', 'sku' => 'TF-RACK-007', 'category' => 'Strength', 'quantity' => 4, 'reorder_level' => 5, 'unit_price' => 650.00, 'supplier' => 'IronGrip Gym Hardware']
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}   
