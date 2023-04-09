<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Order;

class BasketIsNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next){
//        session()->forget('get_full_sum');
//        session()->flush();
//        die();
            $orderId = session('orderId');
        if (!is_null($orderId) && Order::getFullSum() >0) {
       return $next($request);
         }
    session()->flash('warning','Корзина пуста');
        return redirect()->route('index');
    }
}
