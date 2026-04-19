<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // ================= CHECKOUT PAGE =================
    public function checkout($id)
    {
        $product = Product::findOrFail($id);
        $quantity = request('qty', 1); // Get quantity from URL parameter, default to 1
        return view('checkout', compact('product', 'quantity'));
    }

    // ================= STORE ORDER =================
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'address' => 'required|string',
            'phone' => 'required|string',
            'payment_method' => 'required|in:cod,card'
        ]);

        Order::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'product_name' => $request->product_name,
            'quantity' => $request->quantity,
            'status' => 'pending',
            'address' => $request->address,
            'phone' => $request->phone,
            'payment_method' => $request->payment_method
        ]);

        return redirect('/shop')->with('success', 'Order placed successfully! Thank you, please visit again.');
    }

    // ================= INDEX ORDERS =================
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    // ================= CREATE ORDER FORM =================
    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    // ================= UPDATE ORDER STATUS =================
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Order status updated!');
    }

    // ================= DELETE ORDER =================
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->back()->with('success', 'Order deleted!');
    }
}