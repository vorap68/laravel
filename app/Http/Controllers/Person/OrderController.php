<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
     public function index()
    {
        $name = auth()->user()->name;
        $orders = Auth::user()->orders->all();
       // $orders = Order::all();
       return view('auth.person.index',compact('orders'));
    }
    
    public function show(Order $order) {
        //dd($order);
       return view('auth.person.show',compact('order'));
    }
}
