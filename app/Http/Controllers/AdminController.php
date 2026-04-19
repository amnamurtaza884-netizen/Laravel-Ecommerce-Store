<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;

class AdminController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->get();
        $orders = Order::with('user')->latest()->get();
        $products = Product::latest()->get();
        $users = User::with('orders')->latest()->get();
        $cartItems = Cart::with('user', 'product')->latest()->get();

        return view('admin.dashboard', compact(
            'customers',
            'orders',
            'products',
            'users',
            'cartItems'
        ));
    }
}