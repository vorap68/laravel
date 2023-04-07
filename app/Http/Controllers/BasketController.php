<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller {

    public function basket() {
      $orderId = session('orderId');
      if(!is_null($orderId)){
     $order = Order::find($orderId);
      }else{
           $order = Order::create();
            session(['orderId'=>$order->id]);
      }
      return view('basket', compact('order'));
    }

    public function basketPlace() {
        $orderId = session('orderId');
        if(is_null($orderId)){
             return redirect()->route('index');
        }
        $order = Order::find($orderId);
        return view('order', compact('order'));
    }
    
    public function basketAdd($productId) {
              $orderId = session('orderId');
        //Если нет такой переменной в сессии то создаем новый объект $order
        if(is_null($orderId)){
           $order = Order::create();
           //dd($order);
            session(['orderId'=>$order->id]);        
        } 
        //Если уже есть заказ в данной сессии , Мы не создаем новый объект $order.Находим объект из БД   
        else { 
            $order = Order::find($orderId);
        }
        //Проверяем есть ли такой-же товар в корзине
        if($order->products->contains($productId)){
            $pivotRow = $order->products()->where('product_id',$productId)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
           // dd($pivotRow);
        } else {
            //Laravel должен знать о сущ pivot таблицы (есть метод products()) и по этой команде
        // в таблице pivot появл нов запись с order_id и product_id
        $order->products()->attach($productId);  
        }
        if(Auth::check()){
            $order->user_id = Auth::id();
            $order->save();
        }
          return redirect()->route('basket');
    }
    
      public function basketRemove($productId) {
        $orderId = session('orderId');

        //Если нет такой переменной в сессии возвращ на стр корзины
        if (is_null($orderId)) {
            return redirect()->route('basket');
        }
        //Если уже есть заказ в данной сессии , Мы не создаем новый объект $order.Находим объект из БД   

        $order = Order::find($orderId);
        if ($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            if ($pivotRow->count < 2) {
                $order->products()->detach($productId);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }
//Laravel должен знать о сущ pivot таблицы (есть метод products()) и по этой команде
        // в таблице pivot появл нов запись с order_id и product_id
        return redirect()->route('basket');
    }
    
    public function basketConfirm(Request $request) {
         $orderId = session('orderId');
        if(is_null($orderId)){
             return redirect()->route('index');
        }
        $order = Order::find($orderId);
      // dd($request->all());
        $result = $order->saveOrder($request->name, $request->phone);
         if($result){
             session()->flash('success','Заказ сохранен');
         }else{
              session()->flash('warning','Заказ НЕ сохранен');
         }
        return redirect()->route('index');
    }

}
