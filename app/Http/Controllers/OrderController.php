<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class OrderController extends Controller
{
    /**
     * Inisialisasi konfigurasi Midtrans (SANDBOX)
     */
    private function initMidtrans(): void
    {
        Config::$serverKey    = config('midtrans.server_key');       // ambil dari config/midtrans.php
        Config::$isProduction = config('midtrans.is_production');     // false = sandbox
        Config::$isSanitized  = config('midtrans.is_sanitized');
        Config::$is3ds        = config('midtrans.is_3ds');
    }

    /**
     * Halaman form checkout
     */
    public function checkoutForm()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang masih kosong.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('orders.checkout', compact('cart', 'total'));
    }

    /**
     * Simpan pesanan + generate Snap Token
     */
    public function store(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang masih kosong.');
        }

        $request->validate([
            'customer_name'    => 'required|string|max:255',
            'customer_phone'   => 'required|string|max:50',
            'customer_address' => 'required|string',
            'note'             => 'nullable|string',
        ]);

        // Hitung total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // 1. Simpan ORDER ke database
        $order = Order::create([
            'user_id'          => session('user_id'),
            'customer_name'    => $request->customer_name,
            'customer_phone'   => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'total_amount'     => $total,
            'status'           => 'pending', // enum kita
            'note'             => $request->note,
        ]);

        // 2. Simpan ITEM ORDER
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item['product_id'],
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);
        }

        // kosongkan cart
        session()->forget('cart');

        // 3. Inisialisasi Midtrans
        $this->initMidtrans();

        // order_id midtrans
        $midtransOrderId = 'ORDER-' . $order->id;

        // item_details untuk midtrans
        $itemDetails = [];
        foreach ($order->items as $item) {
            $itemDetails[] = [
                'id'       => (string) $item->product_id,
                'price'    => (int) $item->price,
                'quantity' => (int) $item->quantity,
                'name'     => $item->product->name ?? 'Produk',
            ];
        }

        // 4. Param Snap
        $params = [
            'transaction_details' => [
                'order_id'     => $midtransOrderId,
                'gross_amount' => (int) $total,
            ],
            'customer_details' => [
                'first_name' => $order->customer_name,
                'phone'      => $order->customer_phone,
                'shipping_address' => [
                    'first_name' => $order->customer_name,
                    'phone'      => $order->customer_phone,
                    'address'    => $order->customer_address,
                ],
            ],
            'item_details' => $itemDetails,
        ];

        // 5. Generate Snap Token
        $snapToken = Snap::getSnapToken($params);

        // 6. Kirim ke halaman pembayaran
        return view('orders.payment', [
            'snapToken' => $snapToken,
            'order'     => $order,
        ]);
    }

    /**
     * Daftar pesanan user
     */
    public function index()
    {
        $orders = Order::where('user_id', session('user_id'))
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Detail pesanan user
     */
    public function show($id)
    {
        $order = Order::with('items.product')
            ->where('user_id', session('user_id'))
            ->findOrFail($id);

        return view('orders.show', compact('order'));
    }

    /**
     * Callback Midtrans (Payment Notification)
     * Route: POST /midtrans/callback
     */
    public function callback(Request $request)
    {
        // inisialisasi config midtrans
        $this->initMidtrans();

        // VERIFY SIGNATURE
        $calculatedSignature = hash(
            'sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            Config::$serverKey
        );

        if ($calculatedSignature !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // order_id midtrans: "ORDER-{id}"
        $midtransOrderId = $request->order_id;
        $parts = explode('-', $midtransOrderId);
        $localOrderId = end($parts);

        $order = Order::find($localOrderId);
        if (! $order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $transactionStatus = $request->transaction_status;
        $fraudStatus       = $request->fraud_status ?? null;

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                $order->status = 'pending';
            } elseif ($fraudStatus == 'accept') {
                $order->status = 'completed';
            }
        } elseif ($transactionStatus == 'settlement') {
            $order->status = 'completed';
        } elseif ($transactionStatus == 'pending') {
            $order->status = 'pending';
        } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
            $order->status = 'cancelled';
        }

        $order->save();

        return response()->json(['message' => 'OK']);
    }
}
