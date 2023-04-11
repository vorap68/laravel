<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $name = auth()->user()->name;
        $order_name = Order::where('name',$name)->get();
        $orders = Order::all();
       return view('auth.orders.index',compact('orders'));
    }
    
    public function show(Order $order) {
        dd($order->products()->withTrashed()->get());
       return view('auth.orders.show',compact('order'));
    }
}
