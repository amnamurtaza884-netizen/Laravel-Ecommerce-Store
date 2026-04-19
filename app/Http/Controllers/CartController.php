<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Add product to cart
    public function add(Request $request, $product_id)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Please login first to add items to cart.');
        }

        $product = Product::findOrFail($product_id);
        $quantity = $request->quantity ?? 1;

        // Check if product already in cart
        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $product_id)
                        ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $quantity);
            $message = $product->name . ' quantity updated in cart!';
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
                'quantity' => $quantity
            ]);
            $message = $product->name . ' added to cart successfully!';
        }

        return back()->with('success', $message);
    }

    // View cart
    public function view()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        return view('cart', compact('cartItems'));
    }

    // Remove from cart
    public function remove($cart_id)
    {
        $cartItem = Cart::findOrFail($cart_id);
        $productName = $cartItem->product->name;
        $cartItem->delete();

        return back()->with('success', $productName . ' removed from cart!');
    }

    // Clear cart
    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();
        return back()->with('success', 'Cart cleared successfully!');
    }
}
