<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'title' => 'Cover Korek Custom',
                'description' => 'Kecil, lucu, dan personal. Best seller!',
                'price' => 'Mulai Rp35.000',
                'image_url' => 'https://i.pinimg.com/1200x/47/f7/f6/47f7f65dbcce3d6e3fbbfdf31a91bbbf.jpg',
                'shopee_url' => 'https://shopee.co.id/ndouu',
                'display_order' => 0
            ],
            [
                'title' => 'Gantungan Kunci Clay',
                'description' => 'Estetik, awet, dan praktis dibawa kemana-mana.',
                'price' => 'Mulai Rp22.000',
                'image_url' => 'https://i.pinimg.com/1200x/93/4d/1a/934d1a42f3e96e64606857320852d000.jpg',
                'shopee_url' => 'https://shopee.co.id/ndouu',
                'display_order' => 1
            ],
            [
                'title' => 'Miniatur Karakter',
                'description' => 'Sesuai request dari foto referensi kamu.',
                'price' => 'Mulai Rp35.000',
                'image_url' => 'https://i.etsystatic.com/5250999/r/il/d920dd/4666346605/il_fullxfull.4666346605_djeu.jpg',
                'shopee_url' => 'https://shopee.co.id/ndouu',
                'display_order' => 2
            ],
            [
                'title' => 'Gift Custom Set',
                'description' => 'Sempurna untuk anniversary & ulang tahun.',
                'price' => 'Mulai Rp40.000',
                'image_url' => 'https://cdn.chus.vn/images/detailed/204/d90158ac693d205f7f0a78236ee1f55c_w767_h1105.jpg',
                'shopee_url' => 'https://shopee.co.id/ndouu',
                'display_order' => 3
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
