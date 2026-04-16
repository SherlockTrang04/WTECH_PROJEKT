<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function show()
    {
        if (Auth::check()) {
            $cart = Cart::with('items.product.images')
                ->where('user_id', Auth::id())->first();
        } else {
            $sessionId = session()->getId();
            $cart = \App\Models\Cart::with('items.product.images')
                ->where('session_id', $sessionId)->first();
        }

        $items = $cart ? $cart->items : collect();
        $total = $items->sum(fn($item) => $item->product->price * $item->quantity);

        return view('cart', compact('items', 'total'));
    }

    public function update(Request $request, $itemId)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        CartItem::findOrFail($itemId)->update(['quantity' => $request->quantity]);
        return back();
    }

    public function remove($itemId)
    {
        CartItem::findOrFail($itemId)->delete();
        return back();
    }

    public function addToCart(Request $request) {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        //najst alebo vytvorit kosik
        if(Auth::check()) {
            $cart = \App\Models\Cart::firstOrCreate(['user_id' => Auth::id()]);
        } else {
            $sessionId = session()->getId();
            $cart = \App\Models\Cart::firstOrCreate(['session_id' => $sessionId]);
        }

        //pridat alebo update item
        $item = $cart->items()->where('product_id', $request->product_id)->first();
        if($item) {
            $item->increment('quantity', $request->quantity);
        } else {
            $cart->items()->create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->route('product.show', ['product' => $request->product_id])->with('success', 'Produkt bol pridaný do košíka!');
    }
}
