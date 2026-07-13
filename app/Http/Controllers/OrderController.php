<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'product_name' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'custom_description' => 'nullable|string'
        ]);

        $order = Order::create([
            'order_id' => Order::generateOrderId(),
            'customer_name' => $validated['customer_name'],
            'phone' => $validated['phone'],
            'product_name' => $validated['product_name'],
            'quantity' => $validated['quantity'],
            'custom_description' => $validated['custom_description']
        ]);

        // Redirect ke WhatsApp
        $whatsappNumber = Setting::get('whatsapp_number', '6287745275007');

        $message = "*CUSTOM ORDER - eco.clayart*%0A%0A";
        $message .= "*Order ID:* {$order->order_id}%0A";
        $message .= "*Nama:* {$order->customer_name}%0A";
        $message .= "*Produk:* {$order->product_name}%0A";
        $message .= "*Jumlah:* {$order->quantity} pcs%0A";
        $message .= "*Deskripsi:* {$order->custom_description}%0A%0A";
        $message .= "_Pesan dari landing page eco.clayart_";

        return redirect("https://wa.me/{$whatsappNumber}?text={$message}");
    }

    public function track($orderId)
    {
        $order = Order::where('order_id', strtoupper($orderId))->first();

        if (!$order) {
            return response()->json(['error' => 'Order tidak ditemukan'], 404);
        }

        return response()->json($order);
    }
}
