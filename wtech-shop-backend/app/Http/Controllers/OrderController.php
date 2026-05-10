<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login')->withErrors(['auth' => 'Pre dokončenie objednávky sa prosím prihláste.']);
        }

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'email' => 'required|email|max:255',
            'delivery_method' => 'required|in:kurier,zasielkovna,osobny',
            'payment_method' => 'required|in:card-online,cod',
        ]);

        // Získaj košík
        if (Auth::check()) {
            $cart = Cart::with('items.product')->where('user_id', Auth::id())->first();
        } else {
            $cart = Cart::with('items.product')->where('session_id', session()->getId())->first();
        }

        if (!$cart || $cart->items->isEmpty()) {
            return redirect('/cart')->withErrors(['cart' => 'Košík je prázdny.']);
        }

        $total = $cart->items->sum(fn($i) => $i->product->price * $i->quantity);

        // Ulož adresu
        $address = Address::create([
            'user_id' => Auth::id(),
            'street' => $request->street,
            'house_number' => '',
            'zip' => $request->zip,
            'city' => $request->city,
            'is_default' => false,
        ]);

        // Vytvor objednávku
        $order = Order::create([
            'user_id' => Auth::id(),
            'delivery_address_id' => $address->id,
            'delivery_method' => $request->delivery_method,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'total_price' => $total,
        ]);

        // Ulož položky
        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'unit_price' => $item->product->price,
            ]);
        }

        // Vymaž košík
        $cart->items()->delete();
        $cart->delete();

        return redirect()->route('order.confirmation', $order->id);
    }

    public function confirmation($id)
    {
        $order = Order::with('items.product', 'address')->findOrFail($id);
        return view('order-confirmation', compact('order'));
    }
}
