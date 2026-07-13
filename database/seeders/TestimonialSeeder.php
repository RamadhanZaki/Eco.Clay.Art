<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run()
    {
        $testimonials = [
            [
                'quote' => 'Detailnya lucu banget dan sesuai request! Pengiriman cepat, packing aman. Bakal order lagi buat teman.',
                'author' => 'Dinda, Customer Shopee'
            ],
            [
                'quote' => 'Gantungan kuncinya bagus banget, awet dan nggak luntur. Makasih eco.clayart!',
                'author' => 'Rizky, Repeat Order'
            ]
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
