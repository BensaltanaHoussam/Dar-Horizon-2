<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('listings')->insert([
            [
                'owner_id' => 1,
                'title' => 'Cozy 2 Bedroom Apartment in Downtown',
                'description' => 'A comfortable and spacious 2 bedroom apartment located in the heart of the city.',
                'location' => '123 Main St, Downtown',
                'price' => 1200,
                'available_from' => Carbon::parse('2025-03-10'),
                'available_until' => Carbon::parse('2025-06-10'),
                'country' => 'USA',
                'image' => 'apartment1.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'owner_id' => 2,
                'title' => 'Luxury Beachfront Villa',
                'description' => 'Experience luxury at this stunning beachfront villa with panoramic ocean views.',
                'location' => '456 Beach Ave, Malibu',
                'price' => 5000,
                'available_from' => Carbon::parse('2025-05-01'),
                'available_until' => Carbon::parse('2025-09-01'),
                'country' => 'USA',
                'image' => 'beachvilla.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'owner_id' => 3,
                'title' => 'Charming Cottage in the Countryside',
                'description' => 'A peaceful getaway in the countryside with beautiful views and fresh air.',
                'location' => '789 Country Rd, Vermont',
                'price' => 800,
                'available_from' => Carbon::parse('2025-04-15'),
                'available_until' => Carbon::parse('2025-08-15'),
                'country' => 'USA',
                'image' => 'cottage.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

