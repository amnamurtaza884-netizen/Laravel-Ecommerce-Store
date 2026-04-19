<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Premium Clutch',
                'price' => 1299,
                'description' => 'Elegant premium clutch with genuine leather finish. Perfect for evening outings and formal occasions. Features magnetic closure and internal pockets.',
                'image' => 'clutch.jpg'
            ],
            [
                'name' => 'USB-C Cable',
                'price' => 299,
                'description' => 'Fast charging USB-C cable with 60W power delivery support. 2-meter length with reinforced connectors for durability.',
                'image' => 'cabel.jpg'
            ],
            [
                'name' => 'Laptop Cooling Pad',
                'price' => 899,
                'description' => 'Laptop cooling pad with 2 USB fans and adjustable height. Reduces laptop temperature by up to 15 degrees.',
                'image' => 'cooling_pad.jpg'
            ],
            [
                'name' => 'Wireless Headphones',
                'price' => 2499,
                'description' => 'Premium wireless headphones with noise cancellation, 30-hour battery life, and premium sound quality. Perfect for music lovers and professionals.',
                'image' => 'headphones.jpg'
            ],
            [
                'name' => 'Mechanical Keyboard',
                'price' => 3499,
                'description' => 'RGB mechanical keyboard with 104 keys, customizable lighting, and aluminum construction. Perfect for gaming and typing.',
                'image' => 'keyboard.jpg'
            ],
            [
                'name' => 'Monitor Arm',
                'price' => 1299,
                'description' => 'Full-motion monitor arm supports 17-32 inch displays. VESA compatible with cable management system.',
                'image' => 'monitor_arm.jpg'
            ],
            [
                'name' => 'Wireless Mouse',
                'price' => 799,
                'description' => 'Ultra-precise wireless mouse with ergonomic design. 18-month battery life and works with any device.',
                'image' => 'mouse.jpg'
            ],
            [
                'name' => 'Luxury Perfume',
                'price' => 1899,
                'description' => 'Premium luxury perfume with long-lasting fragrance. Elegant scent perfect for special occasions and daily wear.',
                'image' => 'perfume.jpg'
            ],
            [
                'name' => 'Smart Watch',
                'price' => 3999,
                'description' => 'Advanced smart watch with fitness tracking, heart rate monitor, and smartphone notifications. Water-resistant and stylish design.',
                'image' => 'watch.jpg'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

