<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Shipment;
use Illuminate\Support\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExportShopSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample Cool Bottles
        Product::create([
            'name' => 'Midnight Sapphire Gin',
            'description' => 'A handcrafted gin in a deep blue glass bottle with gold filigree.',
            'price' => 120.00,
            'image_path' => 'https://images.unsplash.com/photo-1551024709-8f23befc6f87?auto=format&fit=crop&q=80&w=800', // Glass bottle example
            'features' => ['Material' => 'Crystal Glass', 'Origin' => 'UK', 'Volume' => '700ml']
        ]);

        Product::create([
            'name' => 'Golden Elixir Olive Oil',
            'description' => 'Premium extra virgin olive oil in a sleek, weighted dark bottle.',
            'price' => 45.00,
            'image_path' => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?auto=format&fit=crop&q=80&w=800',
            'features' => ['Material' => 'Dark Glass', 'Origin' => 'Italy', 'Volume' => '500ml']
        ]);

        Product::create([
            'name' => 'Obsidian Perfume',
            'description' => 'A mysterious fragrance housed in a faceted matte black bottle.',
            'price' => 250.00,
            'image_path' => 'https://images.unsplash.com/photo-1523293182086-7651a899d37f?auto=format&fit=crop&q=80&w=800',
            'features' => ['Material' => 'Obsidian-styled Glass', 'Origin' => 'France', 'Volume' => '100ml']
        ]);

        // Sample Shipments for Tracking Simulation
        Shipment::create([
            'tracking_number' => 'EXP-2026-001',
            'customer_name' => 'John Doe',
            'customer_email' => 'john@example.com',
            'destination' => 'London, UK',
            'status' => 'Shipped',
            'shipped_at' => Carbon::now()->subDays(5),
        ]);

        Shipment::create([
            'tracking_number' => 'EXP-2026-002',
            'customer_name' => 'Jane Smith',
            'customer_email' => 'jane@example.com',
            'destination' => 'New York, USA',
            'status' => 'Processing',
            'shipped_at' => null,
        ]);
    }
}
