<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            ['key' => 'logo_prefix', 'value' => 'eco.'],
            ['key' => 'logo_suffix', 'value' => 'clayart'],
            ['key' => 'hero_title', 'value' => 'Clay Art Custom Unik,'],
            ['key' => 'hero_highlight', 'value' => 'Sesuai Karaktermu'],
            ['key' => 'hero_description', 'value' => 'Hadiah handmade aesthetic untuk pasangan, sahabat, dan koleksi pribadi. Bisa custom nama, warna, dan desain favorit.'],
            ['key' => 'hero_button', 'value' => 'Custom Sekarang'],
            ['key' => 'hero_image', 'value' => 'https://i.pinimg.com/736x/5e/5f/70/5e5f70645a4403e6c16469fc71471df2.jpg'],
            ['key' => 'products_title', 'value' => '🌿 Produk Unggulan Kami'],
            ['key' => 'products_subtitle', 'value' => 'Klik tombol Shopee untuk langsung order di marketplace'],
            ['key' => 'custom_title', 'value' => '✏️ Custom Order'],
            ['key' => 'custom_subtitle', 'value' => 'Isi form di bawah untuk memesan produk sesuai keinginanmu. Kami akan konfirmasi via WhatsApp.'],
            ['key' => 'tracking_title', 'value' => '📦 Tracking Pesanan'],
            ['key' => 'tracking_subtitle', 'value' => 'Cek status pesanan kamu di sini'],
            ['key' => 'cta_title', 'value' => '🎁 Buat versi custom kamu sekarang!'],
            ['key' => 'cta_subtitle', 'value' => 'Konsultasi desain gratis via chat atau langsung order di Shopee.'],
            ['key' => 'shopee_url', 'value' => 'https://shopee.co.id/ndouu'],
            ['key' => 'tiktok_url', 'value' => 'https://www.tiktok.com/@loserboy_'],
            ['key' => 'whatsapp_number', 'value' => '6287745275007'],
            ['key' => 'whatsapp_text', 'value' => 'Halo eco.clayart, saya mau custom produk'],
            ['key' => 'footer_lines', 'value' => "© 2026 eco.clayart - Handmade Clay Art from Yogyakarta\nKarangsari, Wedomartani, Ngemplak, Sleman, DIY 55584\nSetiap produk dibuat dengan cinta dan estetika"],
            ['key' => 'chat_welcome', 'value' => '👋 Halo! Selamat datang di eco.clayart. Ada yang bisa kami bantu?'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
