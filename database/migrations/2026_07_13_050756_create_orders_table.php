<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->string('customer_name');
            $table->string('phone');
            $table->string('product_name');
            $table->integer('quantity')->default(1);
            $table->text('custom_description')->nullable();
            $table->enum('status', ['menunggu', 'dikonfirmasi', 'diproduksi', 'dikirim', 'selesai'])
                  ->default('menunggu');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
