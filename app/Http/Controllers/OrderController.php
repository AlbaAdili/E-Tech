<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function index()
    {
        $userOrders = Order::where('user_id', auth()->user()->id)->with('orderItems')->get();

        return view('orders', compact('userOrders'));
    }
}
